<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    public function test_can_view_product_creation_form()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        
        $response = $this->get(route('products.create'));
        
        $response->assertStatus(200);
        
        $response->assertSee('name', false);
        $response->assertSee('price', false);
    }
}