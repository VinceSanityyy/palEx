<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('palex-channel', function () {
    return true;
});


Broadcast::channel('palex-order-channel', function () {
    return true;
});


Broadcast::channel('palex-order-channel-{vendor_id}', function () {
    return true;
});

Broadcast::channel('palex-notification-channel-{user_id}', function () {
    return true;
});





Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
