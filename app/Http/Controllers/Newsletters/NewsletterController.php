<?php

namespace App\Http\Controllers\Newsletters;

use Exception;
use App\Http\Controllers\Controller;
use Spatie\Newsletter\NewsletterFacade;
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
            NewsletterFacade::subscribeOrUpdate($request->email);
        } catch (Exception $e) {
            throw new NewsletterSubscriptionFailedException();
        }
    }
}
