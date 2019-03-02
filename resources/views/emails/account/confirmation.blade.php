@component('mail::message')
<h1>@lang('emails.confirmation.title')</h1>
<h2>@lang('emails.confirmation.welcome') {{ config('app.name') }}, {{ $event->user->name }}!</h2>

<p>@lang('emails.confirmation.thank_you')</p>
<p>@lang('emails.confirmation.have_fun')</p>
<p>@lang('emails.confirmation.second_email')</p>

@component('mail::panel')
  @lang('emails.confirmation.ignore')
@endcomponent

@component('mail::button', [
  'url' => config('app.client.url') . '/' . App::getLocale() . '/search',
  'color' => 'green'
])
  @lang('emails.confirmation.connexion')
@endcomponent

<p>@lang('emails.confirmation.team')</p>
@endcomponent
