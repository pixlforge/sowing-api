<?php

return [

    'account' => 'Conto',
    'contact_representative' => 'Contattate un rappresentante di Sowing se non siete responsabile di questa azione e ritenete che il vostro account sia stato violato.',
    'copyrights' => 'Tutti i diritti riservati.',
    'ignore' => 'Potete tranquillamente ignorare questa email se non siete il mittente.',
    'team' => 'La squadra di Sowing.',

    /**
     * Account creation confirmation email.
     */
    'confirmation' => [
        'subject' => 'Benvenuti su Sowing!',
        'title' => 'Confermazione di creazione dell\'account',
        'welcome' => 'Benvenuti su',
        'thank_you' => 'Grazie! Il vostro account Sowing è stato creato con successo.',
        'have_fun' => 'Speriamo che vi sentirete come a casa vostra da Sowing.',
        'second_email' => "Riceverete presto un'e-mail che vi chiederà di confermare che siete il proprietario dell'indirizzo email inserito durante la procedura di registrazione.",
        'connexion' => 'Accedete al vostro account',
    ],

    /**
     * Account creation verification email.
     */
    'verification' => [
        'subject' => 'Verifica del vostro indirizzo e-mail',
        'title' => 'Confermazione di creazione dell\'account',
        'subtitle' => 'Benvenuti da',
        'one_more_step' => 'Un ultimo passaggio per completare la creazione del vostro account.',
        'confirm' => "Confermate che siete il proprietario dell'indirizzo email inserito durante il processo di creazione del vostro account Sowing clicando sul pulsante in basso.",
        'verify' => 'Confermate il vostro indirizzo email',
        'failed' => 'Siamo spiacenti, il gettone di conferma non corrisponde. Vi preghiamo di riprovare o di contattare un rappresentante di Sowing.',
    ],

    /**
     * Forgot password email.
     */
    'forgot' => [
        'action' => 'Cliccate sul pulsante qui sotto per impostare una nuova password per il vostro account Sowing.',
        'button' => 'Reimposta la mia password',
        'intro' => 'Abbiamo ricevuto una richiesta di reimpostazione della password per il vostro account.',
        'subject' => 'Reimpostazione della password del vostro account Sowing',
        'title' => 'Password dimenticata',
    ],

    /**
     * Password reset confirmation email
     */
    'reset' => [
        'changed' => 'La password per il vostro account è stata aggiornata con successo.',
        'sign_in' => 'Potete accedere al vostro account facendo un clic sul pulsante qui sotto.',
        'subject' => 'La password per il vostro account Sowing è stata aggiornata',
        'title' => 'La password per il vostro account Sowing è stata aggiornata',
    ],

];
