<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use RefreshDatabase;


    public  function test_login_redirects_successful()
    {
//        create a user
           User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password1234')
        ]);

        $response = $this->post('/login',['email' => 'admin@gmail.com', 'password'=> 'password1234']);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public  function test_authenticated_user_can_access_products_table()
    {
//        create a user
     $user =    User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password1234')
        ]);


      $response =   $this->actingAs($user)->get('/');
      $response->assertStatus(200);

    }

    public  function test_unauthenticated_user_cannot_access_products_table()
    {

//        go to home
//        assert status 200

        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
