<?php

namespace Tests;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Testing\TestResponse;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $this->disableSearchSyncingForTests();

        $this->registerCustomAssertions();
        
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Register custom assertions.
     *
     * @return void
     */
    protected function registerCustomAssertions()
    {
        TestResponse::macro('assertResource', function ($resource) {
            $this->assertJson($resource->response()->getData(true));
        });
    }

    /**
     * Disable Algolia search syncing while running tests.
     *
     * @return void
     */
    protected function disableSearchSyncingForTests()
    {
        Shop::disableSearchSyncing();
        Product::disableSearchSyncing();
    }
}
