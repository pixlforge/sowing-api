@component('mail::message')
# @lang('emails.forgot.title')

## @lang('emails.account') {{ $user['email'] }}

@lang('emails.forgot.intro')


@lang('emails.forgot.action')

@component('mail::button', [
  'url' => config('app.client.url') . '/auth/reset?token=' . $token,
  'color' => 'green'
])
  @lang('emails.forgot.button')
@endcomponent

<p class="small-link">
  <a href="{{ config('app.client.url') . '/auth/reset?token=' . $token }}">
    {{ config('app.client.url') . '/auth/reset?token=' . $token }}
  </a>
</p>

@component('mail::panel')
  @lang('emails.ignore')
@endcomponent

@lang('emails.team')
@endcomponent
