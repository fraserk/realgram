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
Route::get('/', function(){
    return View('home');
});
Route::get('/getimage', function() {
    // this doesn't do anything other than to
    // tell you to go to /fire
    $client = new GuzzleHttp\Client();
    $response = $client->get('https://api.instagram.com/v1/tags/NYC/media/recent?client_id=ba86e397e3e7471a9909aaf1bdb93010&max_id=19261720');
    $data = json_decode($response->getBody()->getContents());
    dd($data->data['0']->images->standard_resolution->url);


});

Route::get('fire', function () {
    // this fires the event
    $data = '10';
    event(new App\Events\EventName($data));
    //return $data;
});

Route::get('test', function () {
    // this checks for the event
    return view('test');
});

//instagram urls.
Route::get('/instagram', function(){

    $params = array(
        'client_id' => getenv('ClientID'),
        'client_secret' => getenv('ClientSecret'),
        'aspect' => "media",
        'object' => "tag",
        'object_id' => "nofilter",
        'callback_url' => 'http://real.picblocks.com/callback'
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
 return $Request->query('hub_challenge');
});

Route::post('/callback', function(Request $Request){
 $requestData = $Request->get('data');
 $object_id = $requestData['object_id'];
 $id        = $requestData['id'];
 $client = new GuzzleHttp\Client();
 $response = $client->get('https://api.instagram.com/v1/tags/'.$object_id .'/media/recent?client_id=ba86e397e3e7471a9909aaf1bdb93010&max_id='.$id);

 //dd($data->data['0']->images->standard_resolution->url);

 $instadata = json_decode($response->getBody()->getContents());
 //dd($data);
 //dd($instadata ->data['0']->images);
 foreach ($instadata->data as $data ) {
    event(new App\Events\EventName($data));
}

});
