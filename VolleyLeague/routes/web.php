<?php
use App\Http\Controllers\FooterController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
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

/* ROUTES FOR LEAGUE */
// returns the home page with all leagues
Route::get('/', LeagueController::class.'@index')->name('leagues.index');
// returns the form for adding a league
Route::get('/leagues/create', LeagueController::class.'@create')->name('leagues.create');
// adds a league to the database
Route::post('/leagues', LeagueController::class.'@store')->name('leagues.store');
// returns a page that shows a full league
Route::get('/leagues/{league}', LeagueController::class.'@show')->name('leagues.show');
// returns the form for editing a league
Route::get('/leagues/{league}/edit', LeagueController::class.'@edit')->name('leagues.edit');
// updates a league
Route::put('/leagues/{league}', LeagueController::class.'@update')->name('leagues.update');
// deletes a league
Route::delete('/leagues/{league}', LeagueController::class.'@destroy')->name('leagues.destroy');

// Infinite Leagues:
Route::get('/infinite-leagues', LeagueController::class.'@infinite')
    ->name('leagues.infinite');



/* ROUTES FOR TEAM */
// returns the home page with all team
Route::get('/leagues/{league}/teams', TeamController::class.'@index')->name('teams.index');
// returns the form for adding a  team
Route::get('/leagues/{league}/teams/create', TeamController::class.'@create')->name('teams.create');
// adds a team league to the database
Route::post('/leagues/{league}/teams', TeamController::class.'@store')->name('teams.store');
// returns a page that shows a full team
Route::get('/leagues/{league}/teams/{team}', TeamController::class.'@show')->name('teams.show');
// returns the form for editing a league
Route::get('/leagues/{league}/teams/{team}/edit', TeamController::class.'@edit')->name('teams.edit');
// updates a team
Route::put('/leagues/{league}/teams/{team}', TeamController::class.'@update')->name('teams.update');
// deletes a team
Route::delete('/leagues/{league}/teams/{team}', TeamController::class.'@destroy')->name('teams.destroy');

/* ROUTES FOR TEAM */
Route::resource('/leagues/{league}/matches', MatchController::class, [
    'except' => ['index', 'store'],
]);
Route::get('/leagues/{league}/matches', MatchController::class.'@index')->name('matches.index');
// adds a team league to the database
Route::post('/leagues/{league}/matches/store', MatchController::class.'@store')->name('matches.store');

// Players Routes:
// returns the home page with all team
Route::get('/leagues/{league}/teams/{team}/players', PlayerController::class.'@index')->name('players.index');
// returns the form for adding a  team
Route::get('/leagues/{league}/teams/{team}/players/create', PlayerController::class.'@create')->name('players.create');
// adds a team league to the database
Route::post('/leagues/{league}/teams/{team}/players/store', PlayerController::class.'@store')->name('players.store');
// returns a page that shows a full team
Route::get('/leagues/{league}/teams/{team}/players/{player}', PlayerController::class.'@show')->name('players.show');
// returns the form for editing a league
Route::get('/leagues/{league}/teams/{team}/players/{player}/edit', PlayerController::class.'@edit')->name('players.edit');
// updates a team
Route::post('/leagues/{league}/teams/{team}/players/{player}', PlayerController::class.'@update')->name('players.update');
// deletes a team
Route::delete('/leagues/{league}/teams/{team}/players/{player}', PlayerController::class.'@destroy')->name('players.destroy');

// Footer Routes
Route::get('/legal', FooterController::class.'@legal')->name('footer.legal');
Route::get('/contact', FooterController::class.'@contact')->name('footer.contact');
Route::get('/about-us', FooterController::class.'@about_us')->name('footer.about-us');
Route::get('/home', FooterController::class.'@home')->name('footer.home');
Route::get('/user-disclaimer', UserController::class.'@show')->name('disclaimer-user.show');

