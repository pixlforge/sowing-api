@component('mail::message')
{{-- Greeting --}}
# @lang('Hello!')

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
@component('mail::button', ['url' => $actionUrl, 'color' => 'green'])
{{ $actionText }}
@endcomponent
@endisset

<p class="text-center">
<a href="{{ $actionUrl }}">
{{ $actionUrl }}
</a>
</p>

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
<p>@lang('emails.team')</p>
@endcomponent
