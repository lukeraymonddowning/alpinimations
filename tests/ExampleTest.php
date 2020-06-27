<?php

namespace Lukeraymonddowning\Alpinimations\Tests;

use Orchestra\Testbench\TestCase;
use Lukeraymonddowning\Alpinimations\AlpinimationsServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [AlpinimationsServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
