<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_delete_product()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 69.69
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Test Product'
        ]);

        $this->actingAs($user);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}