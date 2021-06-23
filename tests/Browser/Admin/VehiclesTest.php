<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VehiclesTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/vehicles')
                ->assertSee('Техника в наличии')
                ->assertRouteIs('admin.vehicles');
        });
    }
}
