<?php

namespace App\Observers;

use App\Notifications\UserCreated;
use App\Notifications\UserUpdated;
use App\Notifications\UserDeleted;


use App\User;
use Notification;

class UserObserver
{
    public function created(User $user)
    {
        Notification::send(User::getAllAdministrators(), new UserCreated($user));
    }

    public function updated(User $user)
    {
        $user->notify(new UserUpdated($user));
    }

    public function deleted(User $user)
    {
        Notification::route('mail', $user->email)->notify(new UserDeleted());
    }

 
}
