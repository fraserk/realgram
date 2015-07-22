<?php
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
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

    $callback_url = "http://realgram.dev/callback";

        $params = array(
            'client_id' => getenv('ClientID'),
            'client_secret' => getenv('ClientSecret'),
            'aspect' => "media",
            'object' => "tag",
            'object_id' => "nofilter",
            'callback_url' => $callback_url
        );

        $defaults = array(
            CURLOPT_URL => 'https://api.instagram.com/v1/subscriptions/',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Accept: application/json')
        );
        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        $jsonData = curl_exec($ch);
        curl_close($ch);
        var_dump($jsonData);

});

Route::get('/callback', function(Request $Request){
 exit($_GET['hub_challenge']);
});

Route::post('/callback', function(){

});
