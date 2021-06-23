<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->assertSee('Список техники')
                ->assertSee('Справочники')
                ->clickLink('Список техники')
                ->waitForText('Техника в наличии')
                ->assertRouteIs('admin.vehicles');
        });
    }
}
