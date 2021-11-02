<?php

use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use League\OAuth2\Client\Provider\Google;

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
Route::get('/teste', function () {

    $client = new Google_Client();
    $application_creds = config('app.google_token');
    $credentials_file = file_exists($application_creds) ? $application_creds : false;
    $client->setAuthConfig($credentials_file);
    $client->setApplicationName(config('app.name'));
    $client->setScopes([Google_Service_Calendar::CALENDAR]);
    $service = new Google_Service_Calendar($client);

    $event = new Google_Service_Calendar_Event(array(
        'summary' => 'Google I/O 2015',
        'location' => '800 Howard St., San Francisco, CA 94103',
        'description' => "A chance to hear more about Google's developer products.",
        'start' => array(
            'dateTime' => Carbon::now(),
            'timeZone' => 'UTC',
        ),
        'end' => array(
            'dateTime' => Carbon::now()->addHour(1),
            'timeZone' => 'UTC',
        ),
        'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
                array('method' => 'email', 'minutes' => 24 * 60),
                array('method' => 'popup', 'minutes' => 10),
            ),
        ),
    ));

    $optParams = [
        "conferenceDataVersion" => 1,
    ];

    $event = $service->events->insert(config('app.calendar_id'), $event, $optParams);


    //Conferencia
    $conference = new Google_Service_Calendar_ConferenceData();
    $conferenceRequest = new Google_Service_Calendar_CreateConferenceRequest();
    $conferenceRequest->setRequestId($event->id);
    $conference->setCreateRequest($conferenceRequest);
    $event->setConferenceData($conference);



    $event = $service->events->patch(config('app.calendar_id'), $event->id, $event, $optParams);

    return response()->json($event);

});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
