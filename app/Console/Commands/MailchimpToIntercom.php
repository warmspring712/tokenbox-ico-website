<?php

namespace App\Console\Commands;

use App\Services\IntercomService;
use DrewM\MailChimp\MailChimp;
use Illuminate\Console\Command;
use Spatie\Newsletter\Newsletter;
use Spatie\Newsletter\NewsletterListCollection;

class MailchimpToIntercom extends Command
{
    const COUNT = 700;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export Mailchimp subscriber to Intercom users';

    /**
     * @var MailChimp
     */
    protected $mailchimp;
    protected $lists;
    protected $newsletter;
    protected $intercomService;


    /**
     * MailchimpToIntercom constructor.
     *
     * @param Newsletter      $newsletter
     * @param IntercomService $intercomService
     */
    public function __construct(Newsletter $newsletter, IntercomService $intercomService)
    {
        parent::__construct();

        $this->mailchimp       = new MailChimp(config('newsletter.apiKey'));
        $this->lists           = NewsletterListCollection::createFromConfig(config('newsletter'));
        $this->newsletter      = $newsletter;
        $this->intercomService = $intercomService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $emails = [];
        $cnt    = 0;
        foreach ($this->lists as $list) {
            $membersList = $this->newsletter->getMembers($list->getName(), [
                'status' => 'subscribed',
                'count'  => self::COUNT,
            ]);
            foreach (array_get($membersList, 'members') as $member) {
                $emails[$list->getName()][] = [
                    'email'   => array_get($member, 'email_address'),
                    'name'    => array_get($member, 'merge_fields.NAME'),
                    'phone'   => array_get($member, 'merge_fields.PHONE'),
                    'company' => array_get($member, 'merge_fields.COMPANY'),
                    'amount'  => array_get($member, 'merge_fields.AMOUNT'),
                    'status'  => array_get($member, 'status'),
                ];
                $cnt++;
            }
        }
        $this->output->progressStart($cnt);

        foreach ($emails as $listName => $members) {
            foreach ($members as $member) {
                $this->intercomService->userCreate(array_get($member, 'email'), [
                    'name'    => array_get($member, 'name'),
                    'phone'   => array_get($member, 'phone'),
                    'company' => array_get($member, 'company'),
                    'amount'  => array_get($member, 'amount'),
                    'tag'     => $listName,
                ]);
                $this->output->progressAdvance();
            }
        }

        $this->output->progressFinish();
    }
}
