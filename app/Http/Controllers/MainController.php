<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotifyFormRequest;
use App\Http\Requests\NotifyFullFormRequest;
use App\Http\Requests\NotifyQueueFormRequest;
use App\Library\JsonResponseTrait;
use App\Services\IntercomService;
use Carbon\Carbon;

class MainController extends Controller
{
    use JsonResponseTrait;

    public function mainPage()
    {
        $icoDate = Carbon::createFromDate('2017', 11, 14);
        $days    = $icoDate->diffInDays(Carbon::now());

        $title = __('Tokenbox — Uniting Crypto');

        $desctiption = __('ᐅᐅᐅ Tokenbox is a №❶ ecosystem for crypto-investors, traders and funds. ᐅᐅᐅ TGE starts in ');
        $desctiption .= $days > 0 ? $days : '';
        $desctiption .= ($days == 1) ? __(' day!') : (($days == 0) ? __(' now!') : __(' days!'));

        $this->seo()
            ->setTitle($title)
            ->setDescription($desctiption);

        return view('welcome');
    }

    public function icoPage()
    {
        return view('ico');
    }

    /**
     * @param NotifyFormRequest $request
     * @param IntercomService   $intercomService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUser(NotifyFormRequest $request, IntercomService $intercomService)
    {
        try {
            $email = $request->input('EMAIL');

            $user = $intercomService->leadCreate($email, [
                'tag' => 'ICO Notification'//1301786
            ]);

            return $this->respondWithSuccess($user, 'Email added successfull');

        } catch (\Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * @param NotifyFullFormRequest $request
     * @param IntercomService       $intercomService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFullUser(NotifyFullFormRequest $request, IntercomService $intercomService)
    {
        try {
            $email   = $request->input('EMAIL');
            $name    = $request->input('NAME');
            $company = $request->input('COMPANY');

            $user = $intercomService->leadCreate($email, [
                'name'    => $name,
                'company' => $company,
                'tag'     => 'Partnership Request',//1294274
            ]);

            return $this->respondWithSuccess($user, 'Email added successfull');

        } catch (\Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

    public function addQueueUser(NotifyQueueFormRequest $request, IntercomService $intercomService)
    {
        try {
            $email  = $request->input('EMAIL');
            $name   = $request->input('NAME');
            $phone  = $request->input('PHONE');
            $amount = $request->input('AMOUNT');

            $user = $intercomService->leadCreate($email, [
                'name'   => $name,
                'phone'  => $phone,
                'amount' => $amount,
                'tag'    => 'Private Pre-Sale Queue',//1294270
            ]);

            return $this->respondWithSuccess($user, 'Email added successfull');

        } catch (\Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

}