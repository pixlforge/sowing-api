<?php

namespace Tests;

use App\Models\Shop;
use App\Models\Product;
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
        
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
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
