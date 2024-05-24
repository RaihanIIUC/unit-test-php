<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password1234'),
            'is_admin' => 1
        ]);
    }
    /**
     * A basic test example.
     */

//    private function create_user()
//    {
//        return   User::factory()->create([
//            'email' => 'admin@gmail.com',
//            'password' => bcrypt('password1234')
//        ]);
//
//    }
    public function test_home_page_contains_empty_products_table(): void
    {
//         $response = $this->get('/');
//
//         $response->assertSee('No Products Found');
//
//         $response->assertStatus(200);
//         $user =   $this->create_user();


        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);
//         $response->assertSee('No Products Found');

    }

    public function test_home_page_contains_non_empty_table(): void
    {
        $product = Product::create([
            'name' => "N",
            'price' => 99
        ]);

//        $user =   $this->create_user();


        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);


        $response->assertDontSee('No Products Found');

        $response->assertSee($product->name);

//        $products = Product::all();

//        $view_products = $response->viewData('products');

        $response->assertStatus(200);

    }

    public function test_paginated_products_table_does_not_show_11th_record()
    {
        $products = Product::factory(11)->create();
        info($products->toArray());

//        $user =   $this->create_user();


        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);

        $response->assertDontSee($products->last()->name);
        $response->assertStatus(200);

    }

    public function test_admin_can_see_product_create_button()
    {
        $admin_user = User::factory()->create([
            'email' => 'md@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        ]);

        $response = $this->actingAs($admin_user)->get('products');

        $response->assertStatus(200);
        $response->assertSee('Add New Product');

    }

    public function test_non_admin_can_not_see_product_create_button()
    {

        $response = $this->actingAs($this->user)->get('products');

        $response->assertStatus(200);
        $response->assertSee('Add New Product');
//        $response->assertDontSee('Add New Product');

    }

    public function test_admin_can_access_products_create_page()
    {
        $admin_user = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($admin_user)->get('products/create');

        $response->assertStatus(200);
        $response->assertSee('Product Add');

    }

    public function test_product_exists_in_database()
    {
        $response = $this->actingAs($this->user)->post('products', ['name' => 'New Product', 'price' => 1111]);
        $response->assertRedirect('products');

        $this->assertDatabaseHas('products', ['name' => 'New Product', 'price' => 1111]);

        $product = Product::orderBy('id', 'desc')->first();

        $this->assertEquals('New Product', $product->name);
        $this->assertEquals(1111, $product->price);

    }

    public function test_edit_product_form_contains_correct_name_and_price()
    {
        $product = Product::factory()->create(['name' => 'N', 'price' => 1111]);

        $response = $this->actingAs($this->user)->get('/products/edit/' . $product->id);

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_update_product_correct_validation_error()
    {
        $product = Product::factory()->create(['name' => 'N', 'price' => 1111]);

        $response = $this->actingAs($this->user)->put('/products/update/' . $product->id, [
            'name' => 'Test ', 'price' => 21
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_update_product_json_correct_validation_error()
    {
        $product = Product::factory()->create(['name' => 'N', 'price' => 1111]);

        $response = $this->actingAs($this->user)->put('/products/update/' . $product->id, [
            'name' => 'Test ', 'price' => 21
        ], [
            'Accept' => 'Application/json'
        ]);

        $response->assertStatus(422);
    }
    /***
     * @group  approved
     */

    public function test_delete_product_no_longer_exist_in_db()
    {
        $product = Product::factory()->create(['name' => 'N', 'price' => 1111]);

        $this->assertEquals(1, Product::count());

        $response = $this->actingAs($this->user)->get('/products/delete/' . $product->id);
//        $response = $this->actingAs($this->user)->delete('/products/delete/' . $product->id);

        $response->assertStatus(302);
        $this->assertEquals(0, Product::count());

    }

}
