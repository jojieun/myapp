<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('good');
});
//Route::get('/homei',function(){
//    return redirect(route('home'));
//});


//Route::get('/', 'IndexController@index');
//Route::resource('posts', 'PostsController');
//Route::get('posts', [
//    'as'=>'posts.index',
//    function(){
//        return view('posts.index');
//    },
//    'uses'=>'PostsController@index'
//]);
Route::get('posts', function(){
    $posts = App\Post::with('user')->paginate(10);
    return view('posts.index',compact('posts'));
});

Route::resource('posts.comments', 'PostCommentController');

DB::listen(function ($event) {
//    var_dump($event->sql);
    // var_dump($event->bindings);
    // var_dump($event->time);
});
Route::get('auth',function(){
    $credentials = [
        'email'=>'john@example.com',
        'password'=>'password'
    ];
    if(! Auth::attempt($credentials)){
        return 'Incorrect username and password combination';
    }
    event('user.login',[Auth::user()]);
    var_dump('Event fired and continue to next line...');
    return;
});
Event::listen('user.login', function($user){
   var_dump('"user.log" event catches and passed data is:');
    var_dump($user->toArray());
});
Event::listen('user.login', function($user) {
    $user->last_login = (new DateTime)->format('Y-m-d H:i:s');
 
    return $user->save();
});
//Route::get('auth/logout', function(){
//    Auth::logout();
//    return 'See you again!';
//});
//Route::get('protected',[
//    'middleware'=>'auth',
//    function(){
//        return 'Welcome back, '.Auth::user()->name;
//    }
//]);
//Route::get('login', function(){
//    return 'login please!';
//});































Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
