@component('mail::message')
# @lang('emails.reset.title')

## @lang('emails.account') {{ $event->user['email'] }}

@lang('emails.reset.changed')


@lang('emails.reset.sign_in')

@component('mail::button', [
  'url' => config('app.client.url') . '/auth/login',
  'color' => 'green'
])
  @lang('emails.confirmation.connexion')
@endcomponent

@component('mail::panel')
  @lang('emails.contact_representative')
@endcomponent

@lang('emails.team')
@endcomponent
