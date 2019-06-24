<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AdminPageTest extends TestCase
{ 

    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testThatGuestsCannotVisitAdminPage()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function testThatCustomersCannotVisitAdminPage()
    {
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 1;
        $user->save();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertRedirect('/');
    }

    public function testThatAdminCanVisitAdminPage()
    {
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->role_id = 2;
        $user->save();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertSeeText($user->name . ', welcome to the administration panel.');
    }
}
