<?php

namespace Tests\Feature;


use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/admin')
            ->assertStatus(200)
            ->assertSeeText('Справочники')
            ->assertSeeText('Список техники');
    }
}
