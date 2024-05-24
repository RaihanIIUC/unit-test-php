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
            'password' => bcrypt('password1234')
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
}
