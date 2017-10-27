@extends('shared/layout')

@section('content')
  <section class="topblock topblock-ico">
    <div class="topblock_bg"></div>

    @component('shared/header')
      @slot('mobile')
        <li><a href="/">{{__('Product')}}</a></li>
        <li><a href="#token-distribution">{{__('Token Distribution')}}</a></li>
        <li><a href="#join-crowdsale">{{__('How to Join')}}</a></li>
        <li><a href="#documentation">{{__('Docs')}}</a></li>
        <li><a href="#faq">{{__('FAQ')}}</a></li>
      @endslot

      <nav class="nav js-scroll-nav" role="navigation">
        <li><a href="/">{{__('Product')}}</a></li>
        <li><a href="#token-distribution">{{__('Token Distribution')}}</a></li>
        <li><a href="#join-crowdsale">{{__('How to Join')}}</a></li>
        <li><a href="#documentation">{{__('Docs')}}</a></li>
        <li><a href="#faq">{{__('FAQ')}}</a></li>
      </nav>

      <div class="header_social">
        <a href="https://bitcointalk.org/index.php?topic=2243307.0" class="icon-bitcointalk" target="_blank"></a>
        <a href="https://www.facebook.com/Tokenbox/" title="Facebook" class="link facebook" target="_blank"><i class="fa fa-facebook-square"></i></a>
        <a href="https://twitter.com/tokenbox" class="link twitter" title="Twitter" target="_blank"><i class="fa fa-twitter-square"></i></a>
        <a href="https://t.me/Tokenbox" class="link telegram" title="Telegram" target="_blank"><i class="fa fa-telegram"></i></a>
      </div>

      <ul class="nav">
        <li>@include('shared/langSwitcher')</li>
      </ul>
    @endcomponent

    <div class="wrapper">
      @if(app('request')->input('started'))
        <h1>{{__('Tokenbox TGE crowdsale now live!')}}</h1>
        <p style="opacity: 0;"">
          {{__('Time left')}}:
          <span class="inline-countdown">
            <span data-key="days"></span>{{__('d')}}
            <span data-key="hours"></span>{{__('h')}}
            <span data-key="minutes"></span>{{__('m')}}
            <span data-key="seconds"></span>{{__('s')}}
          </span>
        </p>

        <div class="progress">
          <div class="progress-current">
            9,163,974 USD
          </div>

          <div class="progress-bar"></div>

          <div class="progress-target">
            20,000,000 USD
          </div>
        </div>

        <div class="founded-money u-cf">
          <div class="founded-money-participants">2563 {{__('participants')}}</div>
          <div class="founded-money-usd">3,109,852</div>
          <div class="founded-money-btc">21.1560</div>
          <div class="founded-money-eth">2,357.0492</div>
        </div>
      @else
        @include('shared/countdown')
      @endif
      <div class="buttons">
        <a class="button" href="#join-crowdsale">{{__('Join Crowdsale!')}}</a><a class="button button-info" href="{{__('/docs/TBX-WhitePaper-Eng.pdf')}}">
          <i class="fa fa-file-pdf-o" style="margin-right: 6px;"></i>
          {{__('White Paper')}}
        </a>
      </div>
    </div>
  </section>


  <section class="section section-distribution" id="token-distribution">
    <div class="wrapper">
      <h1>{{__('Token Distribution')}}</h1>
      <p>{{__('No more than 31,000,000 TBX will be released')}}</p>

      <div class="distribution">
        <div class="distribution-item distribution-item-token">
          <span>75%</span>
          {{__('Token Generation Event')}}
        </div>
        <div class="distribution-pie">
          <div class="distribution-pie-icon">
          </div>
        </div>
        <div class="distribution-item distribution-item-bounty">
          <span>5%</span>
          {{__('Bounty')}}
        </div>
        <div class="distribution-item distribution-item-team">
          <span>20%</span>
          {{__('Team')}}
        </div>
      </div>

      <div class="distibution-desc">
        <a href="#faq">{{__('See detailed information')}}</a> {{__('in our FAQ section')}}.
      </div>
    </div>
  </section>

  <section class="section section-join-crowdsale" id="join-crowdsale">
    <div class="wrapper">
      <h1>{{__('How to Join the Crowdsale')}}</h1>
      <p>{{__('The process is simple and only takes ~5 minutes')}}</p>

      <h2>{{__('4 easy steps')}}</h2>

      <ol class="step-list">
        <li>
          <span><b>{{__('Make sure')}}</b> {{__('you comply with our')}} <a href="#terms" class="js-modal-link">{{__('Terms & Conditions')}}</a>.</span>
        </li><li>
          <span>
            <b>{{__('Create')}}</b>
            {{__('a Zerion account (opens on 14 Nov 2017 12:00 UTC)')}}.
          </span>
        </li><li>
          <span><b>{{__('Choose currency')}}</b> {{__('and the amount of Tokens you want to purchase')}}.</span>
        </li><li>
          <span><b>{{__('Send')}}</b> {{__('the required amount to the specified wallet address and wait for 6 confirmations')}}.</span>
        </li><li>
          <span><b>{{__('Congratulations!')}}</b><br>{{__("You've just purchased TBX Tokens.")}}</span>
        </li>
      </ol>

      <div class="button button-centred button-waiting" style="cursor: text">
        {{__('14 November')}}
      </div>
      <!--<a href="" class="button button-centred">{{__('Join the Crowdsale!')}}</a>

      <div class="button-details">
        {{__('Got questions? <a href="">See the detailed guide.')}}</a>
      </div>

      <p>{{__('If you decide to purchase more tokens, repeat steps 3-4 by signing-in to your <a href="#">dashboard</a>.')}}</p>-->
    </div>
  </section>

  <section>
    <div class="documentation" id="documentation">
      <h1>{{__('Documentation')}}</h1>

      <div class="documentation_list">
        <a href="{{__('/docs/TBX-WhitePaper-Eng.pdf')}}" target="_blank">
          <i class="fa fa-file-pdf-o"></i>{{__('White Paper')}}
        </a><a href="{{__('/docs/Tokenbox-LightPaper-En.pdf')}}" target="_blank">
          <i class="fa fa-file-pdf-o"></i>{{__('Light Paper')}}
        </a><a href="{{__('/docs/Tokenbox-Onepager-Eng.pdf')}}" target="_blank">
          <i class="fa fa-file-pdf-o"></i>{{__('One-Pager')}}
        </a><a href="{{__('/docs/Tokenbox-Overview-Eng.pdf')}}" target="_blank">
          <i class="fa fa-file-pdf-o"></i>{{__('Tokenbox Overview')}}
        </a><a href="{{__('/docs/Tokenbox-BusinessOverview-Eng.pdf')}}" target="_blank">
          <i class="fa fa-file-pdf-o"></i>{{__('Business Overview')}}
        </a><a href="{{__('/docs/Tokenbox-Presentation-Eng.pdf')}}" target="_blank">
          <i class="fa fa-file-pdf-o"></i>{{__('Product Presentation')}}
        </a>
      </div>
    </div>
  </section>

  @include('shared/faq')
  @include('shared/powered')
  @include('shared/roadmap')
  @include('shared/team')

@endsection

