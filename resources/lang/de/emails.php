<?php

return [

    'account' => 'Konto',
    'copyrights' => 'Alle Rechte vorbehalten.',
    'ignore' => 'Sie können diese E-Mail ignorieren, wenn Sie nicht der Absender sind.',
    'team' => 'Das Sowing Team.',

    /**
     * Account creation confirmation email.
     */
    'confirmation' => [
        'subject' => 'Herzlich willkommen bei Sowing!',
        'title' => 'Kontoerstellung Bestätigung',
        'welcome' => 'Herzlich willkommen bei',
        'thank_you' => 'Vielen Dank! Ihr Sowing-Konto wurde erfolgreich erstellt.',
        'have_fun' => 'Wir hoffen, dass Sie sich bei Sowing wie zu Hause fühlen werden.',
        'second_email' => 'Sie erhalten in Kürze eine E-Mail, in der Sie aufgefordert werden, zu bestätigen, dass Sie der Eigentümer der E-Mail-Adresse sind, die während des Registrierungsvorgangs eingegeben wurde.',
        'connexion' => 'Melden Sie sich bei Ihrem Konto an',
    ],

    /**
     * Account creation verification email.
     */
    'verification' => [
        'subject' => 'Überprüfung Ihrer E-Mail-Adresse',
        'title' => 'Kontoerstellung Bestätigung',
        'subtitle' => 'Herzlich willkommen bei',
        'one_more_step' => 'Ein letzter Schritt, um die Erstellung Ihres Kontos abzuschließen.',
        'confirm' => 'Helfen Sie uns zu bestätigen, dass Sie der Eigentümer der E-Mail-Adresse sind, die Sie beim Erstellen Ihres Sowing-Kontos eingegeben haben, indem Sie auf die Schaltfläche unten klicken.',
        'verify' => 'Bestätigen Sie Ihre E-Mail-Adresse',
        'failed' => 'Entschuldigung, das Bestätigungstoken stimmt nicht überein. Bitte versuchen Sie es erneut oder wenden Sie sich an einen Aussaat-Vertreter.',
    ],

    /**
     * Forgot password email.
     */
    'forgot' => [
        'action' => 'Klicken Sie auf die Schaltfläche unten, um ein neues Passwort für Ihr Sowing-Konto festzulegen.',
        'button' => 'Setze mein Passwort zurück',
        'intro' => 'Wir haben eine Anfrage zum Zurücksetzen des Passworts für Ihr Konto erhalten.',
        'subject' => 'Zurücksetzen des Passworts für Ihrem Sowing-Konto',
        'title' => 'Passwort vergessen',
    ],
    
];
