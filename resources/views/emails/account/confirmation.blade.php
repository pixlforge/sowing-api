@component('mail::message')
<h1>@lang('auth.confirmation.title')</h1>
<h2>@lang('auth.confirmation.welcome') {{ config('app.name') }}, {{ $event->user->name }}!</h2>

<p>@lang('auth.confirmation.thank_you')</p>

<p>@lang('auth.confirmation.have_fun')</p>

<p>@lang('auth.confirmation.second_email')</p>

@component('mail::panel')
  @lang('auth.ignore')
@endcomponent

@component('mail::button', [
  'url' => config('app.client.url') . '/' . App::getLocale() . '/login',
  'color' => 'green'
])
  @lang('auth.confirmation.connexion')
@endcomponent

<p>@lang('auth.team')</p>
@endcomponent
