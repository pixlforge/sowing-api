@component('mail::message')
# @lang('emails.verification.title')

## @lang('emails.verification.subtitle') {{ $event->user->email }}

@lang('emails.verification.confirm')

@component('mail::panel')
  @lang('emails.ignore')
@endcomponent

@component('mail::button', [
  'url' => config('app.client.url') . '/auth/verify?token=' . $event->user->confirmation_token,
  'color' => 'green'
])
  @lang('emails.verification.verify')
@endcomponent

<p class="small-link">
  <a href="{{ config('app.client.url') . '/auth/verify?token=' . $event->user->confirmation_token }}">
    {{ config('app.client.url') . '/auth/verify?token=' . $event->user->confirmation_token }}
  </a>
</p>

@lang('emails.team')
@endcomponent
