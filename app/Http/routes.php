<?php
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    // this doesn't do anything other than to
    // tell you to go to /fire
    return "go to /fire";
});

Route::get('fire', function () {
    // this fires the event
    event(new App\Events\EventName());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('test');
});

//instagram urls.
Route::get('/instagram', function(){

    $client = new GuzzleHttp\Client();

    $client->POST('https://api.instagram.com/v1/subscriptions/',[
            'client_id'=> getenv('ClientID'),
            'client_secret'=>getenv('ClientSecret'),
            'object'=>'tag',
            'aspect'=>'media',
            'callback_url'=>'http://real.picblocks.com/callback',
            'object_id'=>'nofilter'


        ]);

});

Route::get('/callback', function(Request $Request){
 return $Request->query('hub_challenge');
});

Route::post('/callback', function(){

});
