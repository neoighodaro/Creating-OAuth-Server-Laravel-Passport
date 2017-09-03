<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    $query = http_build_query([
        'client_id' => 3,
        'redirect_uri' => 'http://127.0.0.1:8001/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $response = (new GuzzleHttp\Client)->post('http://127.0.0.1:8000/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 3,
            'client_secret' => 'Qzm2qZdIoaYzkDjYGRFu9iq8qFJiRClagu4CsHDT',
            'redirect_uri' => 'http://127.0.0.1:8001/callback',
            'code' => $request->code,
        ]
    ]);

    session()->put('token', json_decode((string) $response->getBody(), true));

    return redirect('/todos');
});

Route::get('/todos', function () {
    if ( ! session()->has('token')) {
        return redirect('/');
    }

    $response = (new GuzzleHttp\Client)->get('http://127.0.0.1:8000/api/todos', [
        'headers' => [
            'Authorization' => 'Bearer '.Session::get('token.access_token')
        ]
    ]);

    return json_decode((string) $response->getBody(), true);
});
