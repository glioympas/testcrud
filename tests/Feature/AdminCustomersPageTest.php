<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Session;

class AdminCustomersPage extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testAdminCanSeeCustomerFromDatabase()
    {
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 2;
        $user->save();
        $customer = User::where('role_id', 1)->first(); //just take a random one
        $response = $this->actingAs($user)->get('/admin/customers');
        $response->assertStatus(200)->assertSee($customer->name);
    }

    public function testAdminDeleteCustomerAction()
    {
        Session::start();
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 2;
        $user->save();

        $response = $this->actingAs($user)->json('POST', '/admin/customers/3', [
            '_token' => csrf_token(),
            '_method' => 'DELETE',
        ]);

        $response->assertStatus(200);
        $this->assertTrue(User::find(3) == NULL); //Check if user  deleted.
    }

    public function testAdminCreateCustomerAction()
    {
        Session::start();
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 2;
        $user->save();

        $response = $this->actingAs($user)->json('POST', '/admin/customers', [
            'name' => 'New User',
            'email' => 'newuser@gmail.com',
            'password' => 'password',
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(200);
        $this->assertTrue(User::whereEmail('newuser@gmail.com')->first() != null); //Check if user  created
    }

    public function testAdminUpdateCustomerAction()
    {
        Session::start();
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 2;
        $user->save();

        $response = $this->actingAs($user)->json('POST', '/admin/customers/3', [
            'name' => 'Updated User',
            'email' => 'updatedemail@gmail.com',
            '_token' => csrf_token(),
            '_method' => 'PATCH'
        ]);

        $response->assertStatus(200);
        $this->assertTrue(User::whereEmail('updatedemail@gmail.com')->first() != null); //Check if user  updated
    }



}
