@component('mail::message')
<h1>@lang('auth.verification.title')</h1>
<h2>@lang('auth.verification.subtitle') {{ $event->user->email }}</h2>

<p>@lang('auth.verification.one_more_step')</p>

<p>@lang('auth.verification.confirm')</p>

@component('mail::panel')
  @lang('auth.ignore')
@endcomponent

@component('mail::button', [
  'url' => config('app.client.url') . '/' . App::getLocale() . '/account/verify?token=' . $event->user->confirmation_token,
  'color' => 'green'
])
  @lang('auth.verification.verify')
@endcomponent

<p class="text-center">
  <a href="{{ config('app.client.url') . '/' . App::getLocale() . '/account/verify?token=' . $event->user->confirmation_token }}">
    {{ config('app.client.url') . '/' . App::getLocale() . '/account/verify?token=' . $event->user->confirmation_token }}
  </a>
</p>

<p>@lang('auth.team')</p>
@endcomponent
