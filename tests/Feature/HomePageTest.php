<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Role;

class HomePageTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;
  

    public function testHomePageStatus()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testHomePageAsGuest()
    {
        $response = $this->get('/');
        $response->assertSeeText('You need to login to access your profile');
    }

    public function testHomePageAsCustomer()
    {
        Role::create(['name' => 'Customer']);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertSeeText('You are logged in as an Customer');
    }

    public function testHomePageAsAdmin()
    {
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 2; //Administrator
        $user->save();

        $response = $this->actingAs($user)->get('/');
        $response->assertSeeText('You are logged in as an Administrator');
    }

}
