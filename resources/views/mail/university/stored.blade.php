@component('mail::message')
# Enregistrement de l'université

## Bonjour,

Votre université <strong>{{ $university->name }}</strong> a été enregistrée dans nos bases de données avec succès.

Utilisez les idéntifiants donnés ci-dessous pour vous connecter afin que nous poussions verifier votre compte.
@component('mail::panel')
<small>
    Email: <em>{{ $university->email }}</em><br />
    Password: <em>{{ $rawPassword }}</email>
</small>
@endcomponent

@component('mail::button', ['url' => $url])
Vérifier votre compte
@endcomponent

<small><strong>Note:</strong> Après la vérification de votre compte vous aurez accès à la réinitialisation de votre mot de passe.</small>

Merci,<br>
{{ config('app.name') }}
@endcomponent