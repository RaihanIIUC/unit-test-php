<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp():void
    {
        parent::setUp();
     $this->user =    User::factory()->create([
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


         $response =   $this->actingAs($this->user)->get('/');
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


        $response =   $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);


        $response->assertDontSee('No Products Found');

        $response->assertSee($product->name);

//        $products = Product::all();

//        $view_products = $response->viewData('products');

        $response->assertStatus(200);

    }

    public function test_paginated_products_table_does_not_show_11th_record()
    {
      $products =  Product::factory(11)->create();
        info($products->toArray());

//        $user =   $this->create_user();


        $response =   $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);

        $response->assertDontSee($products->last()->name);
        $response->assertStatus(200);

    }

    public function test_admin_can_see_product_create_button()
    {
        $admin_user = User::factory()->create([
            'email' => 'md@gmail.com',
            'password' =>  bcrypt('password'),
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
       $response =  $this->actingAs($this->user)->post('products',['name' => 'New Product' , 'price' => 1111]);
        $response->assertRedirect('products');

        $this->assertDatabaseHas('products',['name' => 'New Product' , 'price' => 1111]);

        $product = Product::orderBy('id','desc')->first();

        $this->assertEquals('New Product', $product->name);
        $this->assertEquals(1111, $product->price);


    }
}
