<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Session;

class ProfilePageTest extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testProfilePageAsGuest()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    //Doesn't matter if it is an administrator or customer. It is the same page.
    public function testProfilePageAsLoggedinUser()
    {
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        $response->assertSeeText('Name: ' . $user->name);
    }

    public function testUpdateProfilUserAction()
    {
        Session::start();
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->password = bcrypt('currentpassword');
        $user->save();

        $response = $this->actingAs($user)->json('POST', '/home/update', [
            'name' => 'Updated User',
            'email' => 'updated_email@gmail.com',
            'current_password' => 'currentpassword',
            'new_password' => '',
            '_token' => csrf_token(),
            '_method' => 'PATCH',
            'edit_user_id' => $user->id
        ]);

        $response->assertStatus(200);
    }

    public function testUpdateProfilWrongCurrentPassword()
    {
        Session::start();
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->password = bcrypt('currentpassword');
        $user->save();

        $response = $this->actingAs($user)->json('POST', '/home/update', [
            'name' => 'Updated User',
            'email' => 'updated_email@gmail.com',
            'current_password' => 'wrongcurrent',
            'new_password' => '',
            '_token' => csrf_token(),
            '_method' => 'PATCH',
            'edit_user_id' => $user->id
        ]);

        $response->assertStatus(422);
    }

    public function testUpdateProfilWithNewPasswordUpdate()
    {
        Session::start();
        $this->artisan("db:seed");
        $user = factory(User::class)->create();
        $user->password = bcrypt('currentpassword');
        $user->save();

        $response = $this->actingAs($user)->json('POST', '/home/update', [
            'name' => 'Updated User',
            'email' => 'updated_email@gmail.com',
            'current_password' => 'currentpassword',
            'new_password' => 'newpassword',
            '_token' => csrf_token(),
            '_method' => 'PATCH',
            'edit_user_id' => $user->id
        ]);

        $response->assertStatus(200);
    }

}
