<?php

return [

    'account' => 'Account',
    'contact_representative' => 'Contact a Sowing representative if you are not behind this action and you believe that your account has been hacked.',
    'copyrights' => 'All rights reserved.',
    'ignore' => 'You can safely ignore this email if you are not the originator.',
    'team' => 'The Sowing team.',

    /**
     * Account creation confirmation email.
     */
    'confirmation' => [
        'subject' => 'Welcome to Sowing!',
        'title' => 'Account creation confirmation',
        'welcome' => 'Welcome to',
        'thank_you' => 'Thank you! Your Sowing account has been created successfully.',
        'have_fun' => 'We hope you will feel at home at Sowing.',
        'second_email' => 'You will soon receive an email asking you to confirm that you are the owner of the email address that was entered during the registration process.',
        'connexion' => 'Sign in to your account',
    ],

    /**
     * Account creation verification email.
     */
    'verification' => [
        'subject' => 'Verification of your e-mail address',
        'title' => 'Account creation confirmation',
        'subtitle' => 'Welcome to',
        'one_more_step' => 'One last step to complete the creation of your account.',
        'confirm' => 'Help us confirm that you are the owner of the email address that was entered during the creation process of your Sowing account by clicking the button below.',
        'verify' => 'Confirm your email address',
        'failed' => 'Sorry, the confirmation token does not match. Please try again or contact a Sowing representative.',
    ],

    /**
     * Forgot password email.
     */
    'forgot' => [
        'action' => 'Click the button below to set a new password for your Sowing account.',
        'button' => 'Reset my password',
        'intro' => 'We have received a password reset request for your account.',
        'subject' => 'Resetting your Sowing account password',
        'title' => 'Password forgotten',
    ],

    /**
     * Password reset confirmation email
     */
    'reset' => [
        'changed' => 'The password for your account has been successfully updated.',
        'sign_in' => 'You can login to your account by clicking the button below.',
        'subject' => 'The password for your Sowing account has been updated',
        'title' => 'The password for your Sowing account has been updated',
    ],

    /**
     * Password update confirmation email
     */
    'password_update' => [
        'subject' => 'The password for your Sowing account has been updated',
    ]
    
];
