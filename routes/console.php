<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

// Development commands
Artisan::command('setAccessToken', function () {
    Artisan::call('passport:install');
    $password_client = DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first();
    setEnvironmentValue('PASSPORT_CLIENT_SECRET', $password_client->secret);
    
    $this->info("Password client secret generated and set");

})->describe('Generate access tokens and set in environment.');
