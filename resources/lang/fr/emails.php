<?php

return [

    'account' => 'Compte',
    'contact_representative' => "Contactez un représentant de Sowing si vous n'êtes pas à l'origine de cette action et que vous pensez que votre compte a été piraté.",
    'copyrights' => 'Tous droits réservés.',
    'ignore' => "Vous pouvez ignorer cet e-mail en toute sécurité si vous n'en êtes pas à l'origine.",
    'team' => "L'équipe de Sowing.",

    /**
     * Account creation confirmation email.
     */
    'confirmation' => [
        'subject' => 'Bienvenue sur Sowing!',
        'title' => 'Confirmation de création de compte',
        'welcome' => 'Bienvenue chez',
        'thank_you' => 'Merci! Votre compte Sowing a été créé avec succès.',
        'have_fun' => 'Nous espérons que vous vous sentirez comme chez vous chez Sowing.',
        'second_email' => "Vous allez bientôt recevoir un email vous demandant de confirmer que vous êtes bien le propriétaire de l'adresse e-mail qui a été entrée lors du processus d'inscription.",
        'connexion' => 'Connectez-vous à votre compte',
    ],

    /**
     * Account creation verification email.
     */
    'verification' => [
        'subject' => 'Vérification de votre adressse e-mail',
        'title' => 'Confirmez votre compte',
        'subtitle' => 'Vérification de votre adresse e-mail',
        'one_more_step' => "Plus qu'une étape pour terminer la création de votre compte.",
        'confirm' => "Aidez-nous à confirmer que vous êtes bien le propriétaire de l'adresse e-mail qui a été entrée lors de la création de votre compte Sowing en cliquant sur le bouton ci-dessous.",
        'verify' => 'Confirmer votre adresse e-mail',
        'failed' => 'Désolé, le jeton de confirmation ne correspond pas. Veuillez réessayer ou contacter un représentant de Sowing.',
    ],

    /**
     * Forgot password email.
     */
    'forgot' => [
        'action' => 'Cliquez sur le bouton ci-dessous pour définir un nouveau mot de passe pour votre compte Sowing.',
        'button' => 'Réinitialiser mon mot de passe',
        'intro' => 'Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.',
        'subject' => 'Réinitialisation du mot de passe de votre compte Sowing',
        'title' => 'Mot de passe oublié',
    ],

    /**
     * Password reset confirmation email
     */
    'reset' => [
        'changed' => 'Le mot de passe de votre compte a été mis à jour avec succès.',
        'sign_in' => 'Vous pouvez vous connecter à votre compte en cliquant sur le bouton ci-dessous.',
        'subject' => 'Le mot de passe de votre compte Sowing a été mis à jour',
        'title' => 'Le mot de passe de votre compte Sowing a été mis à jour',
    ],

    /**
     * Password update confirmation email
     */
    'password_update' => [
        'subject' => 'Le mot de passe de votre compte Sowing a été mis à jour'
    ]
    
];
