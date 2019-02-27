@component('mail::message')
# Confirmation de création de votre compte {{ config('app.name') }}

Bienvenue, <strong>{{ $event->user->name }}</strong>!

Votre compte {{ config('app.name') }} a bien été créé et nous vous en remercions.

Nous espérons que vous vous sentirez comme chez vous chez {{ config('app.name') }} et que votre expérience sera des plus plaisante.

Vous allez bientôt recevoir un deuxième email vous demandant de confirmer que vous êtes bien le propriétaire de l'adresse e-mail qui a été entrée lors de la création de compte.

Vous pouvez ignorer ces messages si vous n'en êtes pas l'auteur.

@component('mail::button', [
  'url' => config('app.client.url') . '/' . App::getLocale() . '/search',
  'color' => 'green'
])
Connectez-vous à votre compte {{ config('app.name') }}
@endcomponent

Bien à vous,<br>
L'équipe de {{ config('app.name') }}.
@endcomponent
