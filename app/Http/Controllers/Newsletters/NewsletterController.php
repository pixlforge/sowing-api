<?php

namespace App\Http\Controllers\Newsletters;

use Exception;
use Newsletter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletters\SubscriberStoreRequest;
use App\Exceptions\NewsletterSubscriptionFailedException;

class NewsletterController extends Controller
{
    /**
     * Subscribe a user to the newsletter.
     *
     * @param SubscriberStoreRequest $request
     * @return void
     */
    public function __invoke(SubscriberStoreRequest $request)
    {
        try {
            $result = Newsletter::subscribeOrUpdate($request->email);
        } catch (Exception $e) {
            throw new NewsletterSubscriptionFailedException();
        }
    }
}
