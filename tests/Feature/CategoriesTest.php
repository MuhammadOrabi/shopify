<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;

class CategoriesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function an_admin_can_browse_categories()
    {
        $admin = Admin::find(1);

        $response = $this->actingAs($admin, 'web-admin')->get('/admin/categories');

        $response->assertOk();
    }
}
