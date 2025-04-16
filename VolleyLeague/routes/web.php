<?php
use App\Http\Controllers\FooterController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AltchaController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* [ LEAGUES ] */
// returns the home page with all leagues
//Route::get('/', LeagueController::class.'@index')->name('leagues.index');
// returns a page that shows a full league
Route::get('/leagues/{league}', LeagueController::class.'@show')->name('leagues.show')->where('league', '[0-9]+');
// Infinite Leagues:
/*
Route::get('/infinite-leagues', LeagueController::class.'@infinite')
    ->name('leagues.infinite');*/
Route::get('/', LeagueController::class.'@infinite')
    ->name('leagues.index');

/* [ TEAMS ] */
// returns the home page with all team
Route::get('/leagues/{league}/teams', TeamController::class.'@index')->name('teams.index')->where('league', '[0-9]+');;
// returns a page that shows a full team
Route::get('/leagues/{league}/teams/{team}', TeamController::class.'@show')->name('teams.show')
    ->where('league', '[0-9]+')->where('team', '[0-9]+');

/* [ MATCHES ] */
/*Route::resource('/leagues/{league}/matches', MatchController::class, [
    'except' => ['index', 'store'],
]);*/
Route::get('/leagues/{league}/matches', MatchController::class.'@index')->name('matches.index')
    ->where('league', '[0-9]+');
Route::get('/leagues/{league}/matches/{match}', MatchController::class.'@show')->name('matches.show')
    ->where('league', '[0-9]+')->where('match', '[0-9]+');


/* [ PLAYERS ] */
// returns the home page with all team
Route::get('/leagues/{league}/teams/{team}/players', PlayerController::class.'@index')->name('players.index')->where('league', '[0-9]+')->where('team', '[0-9]+');
// returns a page that shows a full player
Route::get('/leagues/{league}/teams/{team}/players/{player}', PlayerController::class.'@show')->name('players.show')
    ->where('league', '[0-9]+')->where('team', '[0-9]+')->where('player', '[0-9]+');

// Footer Routes
Route::get('/legal', FooterController::class.'@legal')->name('footer.legal');
Route::get('/contact', FooterController::class.'@contact')->name('footer.contact');
Route::get('/about-us', FooterController::class.'@about_us')->name('footer.about-us');
Route::get('/home', FooterController::class.'@home')->name('footer.home');
Route::get('/user-disclaimer', UserController::class.'@show')->name('disclaimer-user.show');


Route::middleware(['auth', 'verified'])->group(function () {
    // [ LEAGUE ]
    // returns the form for editing a league
    Route::get('/leagues/{league}/edit', LeagueController::class.'@edit')->name('leagues.edit')
        ->where('league', '[0-9]+');
    // updates a league
    Route::put('/leagues/{league}', LeagueController::class.'@update')->name('leagues.update')
        ->where('league', '[0-9]+');
    // deletes a league
    Route::delete('/leagues/{league}', LeagueController::class.'@destroy')->name('leagues.destroy')
        ->where('league', '[0-9]+');
    // returns the form for adding a league
    Route::get('/leagues/create', LeagueController::class.'@create')->name('leagues.create');
    // adds a league to the database
    Route::post('/leagues', LeagueController::class.'@store')->name('leagues.store');
    
    // [ TEAMS ]
    // returns the form for adding a  team
    Route::get('/leagues/{league}/teams/create', TeamController::class.'@create')->name('teams.create')
        ->where('league', '[0-9]+')->where('team', '[0-9]+');;
    // adds a team league to the database
    Route::post('/leagues/{league}/teams', TeamController::class.'@store')->name('teams.store')
        ->where('league', '[0-9]+');
    // returns the form for editing a league
    Route::get('/leagues/{league}/teams/{team}/edit', TeamController::class.'@edit')->name('teams.edit')
        ->where('league', '[0-9]+')->where('team', '[0-9]+');
    // updates a team
    Route::put('/leagues/{league}/teams/{team}', TeamController::class.'@update')->name('teams.update')
        ->where('league', '[0-9]+')->where('team', '[0-9]+');
    // deletes a team
    Route::delete('/leagues/{league}/teams/{team}', TeamController::class.'@destroy')->name('teams.destroy')
        ->where('league', '[0-9]+')->where('team', '[0-9]+');


    // [ MATCHES ]
    // adds a team league to the database
    Route::post('/leagues/{league}/matches/store', MatchController::class.'@store')->name('matches.store')
        ->where('league', '[0-9]+');
    Route::get('/leagues/{league}/matches/{match}/edit', MatchController::class.'@edit')->name('matches.edit')
        ->where('league', '[0-9]+')->where('match', '[0-9]+');
    Route::put('/leagues/{league}/matches/{match}', MatchController::class.'@update')->name('matches.update')
        ->where('league', '[0-9]+')->where('match', '[0-9]+');
    Route::delete('/leagues/{league}/matches/{match}', MatchController::class.'@destroy')->name('matches.destroy')
        ->where('league', '[0-9]+')->where('match', '[0-9]+');
    Route::get('/leagues/{league}/matches/create', MatchController::class.'@create')->name('matches.create')
        ->where('league', '[0-9]+');


    // [ PLAYERS ]
    // returns the form for adding a player
    Route::get('/leagues/{league}/teams/{team}/players/create', PlayerController::class.'@create')->name('players.create')
        ->where('league', '[0-9]+')->where('team', '[0-9]+');
    // adds a team league to the database
    Route::post('/leagues/{league}/teams/{team}/players/store', PlayerController::class.'@store')->name('players.store')
        ->where('league', '[0-9]+')->where('team', '[0-9]+');
    // returns the form for editing a player
    Route::get('/leagues/{league}/teams/{team}/players/{player}/edit', PlayerController::class.'@edit')->name('players.edit')
        ->where('league', '[0-9]+')->where('team', '[0-9]+')->where('player', '[0-9]+');
    // updates a player
    Route::post('/leagues/{league}/teams/{team}/players/{player}', PlayerController::class.'@update')->name('players.update')
        ->where('league', '[0-9]+')->where('team', '[0-9]+')->where('player', '[0-9]+');
    // deletes a player
    Route::delete('/leagues/{league}/teams/{team}/players/{player}', PlayerController::class.'@destroy')->name('players.destroy')
        ->where('league', '[0-9]+')->where('team', '[0-9]+')->where('player', '[0-9]+');

});

//ALTCHA
Route::get('/altcha-challenge', AltchaController::class. '@challenge')->name('altcha.challenge');
