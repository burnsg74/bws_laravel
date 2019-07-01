<?php

use App\Client;
use App\Event;
use App\Note;
use App\Tasks;
use App\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/counters', function (Request $request) {
    $clientCounter  = Client::all()->count();
    $eventCounter   = Event::all()->count();
    $timeLogCounter = TimeLog::all()->count();

    return [
        'clientCounter'  => $clientCounter,
        'eventCounter'   => $eventCounter,
        'timelogCounter' => $timeLogCounter,
    ];
});

Route::get('/clients', function (Request $request) {
    return Client::all();
});
Route::post('/saveClient', function (Request $request) {
    $client       = new Client();
    $client->name = $request->name;
    $client->code = $request->code;
    $client->save();

    $event        = new Event();
    $event->event = 'New Client Added ' . $client->id;
    $event->save();

    return response(['success' => true], 200);
});

Route::get('/timeLogs', function (Request $request) {
    return TimeLog::all();
});

Route::get('/tasks', function (Request $request) {
    return Tasks::all();
});

Route::get('/task/{id}', function (Request $request) {
    return Tasks::where('id',$request->id)->first();
});

Route::post('/saveTask', function (Request $request) {
    $task        = new Tasks();
    $task->summary = $request->summary;
    $task->description = $request->description;
    $task->save();

    return response(['success' => true], 200);
});

Route::post('/saveTimeLog', function (Request $request) {
    $start = new Carbon($request->start_at);
    $end   = new Carbon($request->end_at);

    $timeLog           = new TimeLog();
    $timeLog->name     = $request->name;
    $timeLog->start_at = $start->format('Y-m-d H:i:s');
    $timeLog->end_at   = $end->format('Y-m-d H:i:s');
    $timeLog->total    = $start->diffInMinutes($end);
    $timeLog->save();

    $event        = new Event();
    $event->event = 'New Time Log ' . $timeLog->id;
    $event->save();

    return response(['success' => true], 200);
});

Route::get('/events', function (Request $request) {
    return Event::all();
});

Route::post('/saveEvent', function (Request $request) {
    $event        = new Event();
    $event->event = $request->event;
    $event->save();

    return response(['success' => true], 200);
});



Route::post('/login', function (Request $request) {
    if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        $event        = new Event();
        $event->event = $request->email . ' logged in';
        $event->save();

        return response(['success' => true], 200);
    } else {
        return
            response([
                'success' => false,
                'message' => 'Auth failed'
            ], 501);
    }
});

Route::get('/logout', function (Request $request) {
    $event        = new Event();
    $event->event = 'logged out';
    $event->save();
    Auth::logout();

    return response(['success' => true], 200);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
