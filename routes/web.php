<?php

use App\Http\Controllers\DynamicToken;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Statamic\Facades\Site;

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

// Dynamic Token route for posting a form with Ajax.
Route::get('/!/DynamicToken/refresh', [DynamicToken::class, 'getRefresh']);

// The Sitemap route to the sitemap.xml
Route::statamic('/sitemap.xml', 'sitemap/sitemap', [
    'layout' => null,
    'content_type' => 'application/xml'
]);

// The Manifest route to the manifest.json
Route::statamic('/site.webmanifest', 'manifest/manifest', [
    'layout' => null,
    'content_type' => 'application/json'
]);

// The Search route to display search results with `views/search.antlers.html`.
Route::statamic('/search', 'search', [
    'title' => 'Search results'
]);

// Routes for submitting
Route::post('/submit', [SubmissionController::class, 'storeSportperson'])->name('submit');

// Routes for voting
Route::get('/stemlijst/{token}', [VoteController::class, 'showVotingPage'])->name('stemLijst')->where('token', '[a-zA-Z0-9]{32}');

Route::post('/vote', [VoteController::class, 'storeVote'])->name('vote');

Route::get('/verify/{token}', [VoteController::class, 'verify']);
