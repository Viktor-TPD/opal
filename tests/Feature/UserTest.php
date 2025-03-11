<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_can_view_user_creation_form()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        
        $this->actingAs($admin);
        
        $response = $this->get(route('users.create'));
        
        $response->assertStatus(200);
        
        $response->assertSee('form', false);
    }
}