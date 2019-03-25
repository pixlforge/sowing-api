@component('mail::message')
# @lang('emails.confirmation.title')

## @lang('emails.confirmation.welcome') {{ config('app.name') }}, {{ $event->user->name }}!

@lang('emails.confirmation.thank_you')

@lang('emails.confirmation.have_fun')

@lang('emails.confirmation.second_email')

@component('mail::panel')
  @lang('emails.ignore')
@endcomponent

@component('mail::button', [
  'url' => config('app.client.url') . '/' . App::getLocale() . '/login',
  'color' => 'green'
])
  @lang('emails.confirmation.connexion')
@endcomponent

@lang('emails.team')
@endcomponent
