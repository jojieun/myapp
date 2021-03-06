<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Advertiser.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
}, ['guards' => ['advertiser']]);

//Broadcast::channel('chats', function ($user) {
//    return auth()->check();
//});
//
//Broadcast::channel('adchats', function ($user) {
//    return auth()->guard('advertiser')->check();
//}, ['guards' => ['advertiser']]);

