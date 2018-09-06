<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexAdmin()
    {
        $admin = Admin::find(1);
        $response = $this->actingAs($admin, 'web-admin')->get('/admin/admins');
        $response->assertOk();
    }
}
