@component('mail::message')
# Demande de réinitialisation de mot de passe

## Bonjour,

Vous receivez cet email car nous avons reçu votre demande de réinitialisation de mot de passe de votre compte

@component('mail::button', ['url' => $url])
Réinitialisation votre mot de passe
@endcomponent

Ce lien de réinitialisation de mot de passe va expirer dans 60 minutes.

Si vous n'avez demandé la réinitialisation de mot de passe, Aucune autre action est nécessaire.

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
<hr />