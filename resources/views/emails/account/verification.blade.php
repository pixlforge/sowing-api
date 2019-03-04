@component('mail::message')
<h1>@lang('emails.verification.title')</h1>
<h2>@lang('emails.verification.subtitle') {{ $event->user->email }}</h2>

<p>@lang('emails.verification.one_more_step')</p>

<p>@lang('emails.verification.confirm')</p>

@component('mail::panel')
  @lang('emails.ignore')
@endcomponent

@component('mail::button', [
  'url' => config('app.client.url') . '/' . App::getLocale() . '/account/verify?token=' . $event->user->confirmation_token,
  'color' => 'green'
])
  @lang('emails.verification.verify')
@endcomponent

<a href="{{ config('app.client.url') . '/' . App::getLocale() . '/account/verify?token=' . $event->user->confirmation_token }}">
  {{ config('app.client.url') . '/' . App::getLocale() . '/account/verify?token=' . $event->user->confirmation_token }}
</a>

<p>@lang('emails.team')</p>
@endcomponent
