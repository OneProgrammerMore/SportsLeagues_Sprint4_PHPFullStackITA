<?php

namespace App\Http\Controllers;

use App\Enum\MatchStatusEnum;
use App\Models\Addresses;
use App\Models\League;
use App\Models\LeagueTypes;
use App\Models\Matchy;
use App\Models\Results\ResultsBeachVolleyball;
// Models for results:
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class MatchController extends Controller
{
    public function filterMatches($request, $league_id){
            
        $request->validate([
            'startweek' => 'numeric',
            'endweek' => 'numeric',
            'teamID' => 'numeric',
        ]);
        
        //1. Select Matches from league ID from starting and ending date
        $week_start = $request->query('startweek');
        $week_end = $request->query('endweek');
        
        $matches = Matchy::where('league_id', $league_id)
        ->where('week_number', '>=', (string) $week_start)
        ->where('week_number', '<=', (string) $week_end)
        ->orderby('week_number')->get();

        // 2. Filter by Team
        $teamID = 0;
        $teamID = $request->query('teamID');
        if($teamID != 0){
        //if(true){
            $matches = $matches->where(function ($query) use ($teamID) {
                return $query->where('host_team_id', '=', (string)$teamID )
                      ->orWhere('guest_team_id', '=', (string)$teamID);
            });


            $matches = Matchy::where('league_id', $league_id)
            ->where('week_number', '>=', (string) $week_start)
            ->where('week_number', '<=', (string) $week_end)
            ->orderby('week_number')
            ->where(function ($query) use ($teamID) {
                return $query->where('host_team_id', '=', (string)$teamID )
                      ->orWhere('guest_team_id', '=', (string)$teamID);
            })->get();
        }
        return $matches;
    }


    public function index(?Request $request, string $league_id)
    {

        // Index League Controller will show all leagues related with the user.
        $teams = Team::where('league_id', $league_id)->get();
        $teams_list = $teams->pluck('team_name','team_id')->toArray();//->toArray();
        $teams_list = ['0'=>'None'] + $teams_list;

        $league = League::find($league_id);
        $league_type = LeagueTypes::where('league_type_id', $league->league_type_id)->first()->league_type;
        $week_dates_values = Matchy::where('league_id', $league_id)
        ->orderby('week_number')->groupBy('week_number')
        ->pluck('week_number')->toArray();
        $week_dates = array_combine($week_dates_values, $week_dates_values);

        if($request->has(['startweek','endweek','teamID'])){
            $matches = $this::filterMatches($request, $league_id);
        }else{
            //RETRIEVE ALL MATCHES FOR SPECIFIC LEAGUE
            $matches = Matchy::where('league_id', $league_id)->orderby('week_number')->get();
        }

        if($matches->toArray()){
            $week_start = min(array_column($matches->toArray(), 'week_number'));
            $week_end = max(array_column($matches->toArray(), 'week_number'));
        }else{
            $week_start = 0;
            $week_end = 0;
        }
        
        foreach ($matches as $match) {
                $team_host = Team::find($match->host_team_id);
                $match['host_name'] = $team_host->team_name;
                $match['host_img'] = $team_host->team_img_name;

                $team_guest = Team::find($match->guest_team_id);
                $match['guest_name'] = $team_guest->team_name;
                $match['guest_img'] = $team_guest->team_img_name;
                // Append only date and only time to use it in the view:
                $match['only_date'] = date('d/m/Y', strtotime($match->match_date));
                $match['only_time'] = date('h:m', strtotime($match->match_date));

                // Address:
                $address = Addresses::find($match->match_address_id);
                $match['address_country'] = $address->country;
                $match['address_postalcode'] = $address->postalcode;
                $match['address_city'] = $address->city;
                $match['address_street'] = $address->street;
                $match['address_number'] = $address->number;
                $match['address_floor'] = $address->floor;
                $match['address_door'] = $address->door;

        }
        return view('matches.index', compact('teams','teams_list', 'league', 'matches', 'week_dates', 'week_start', 'week_end', 'league_type'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($league_id)
    {
        //
        $league = League::find($league_id);
        // Find the maximum number of a team to add the following
        // $maxTeamNumber = Team::where('league_id',$id)->sortDesc('team_number')->first();

        $firstElementMatch = Matchy::where('league_id', $league_id)->orderby('match_number', 'DESC')->first();
        if (! $firstElementMatch) {
            $maxMatchNumber = null;
        } else {
            $maxMatchNumber = $firstElementMatch->match_number;
        }

        // $maxTeamNumber = Team::where('league_id',$id)->orderby('team_number', 'DESC')->first()->team_number;
        if (! $maxMatchNumber) {
            $next_match_number = 1;
        } else {
            $next_match_number = $maxMatchNumber + 1;
        }

        // Teams for select host and guest team:
        $teams_list_ids = Team::where('league_id', $league_id)->orderby('team_name', 'ASC')->pluck('team_id')->toArray();
        $teams_list_names = Team::where('league_id', $league_id)->orderby('team_name', 'ASC')->pluck('team_name')->toArray();
        $teams_list = array_combine($teams_list_ids, $teams_list_names);

        // Match Possible Status From ENUM:
        $match_status_values = array_column(\App\Enum\MatchStatusEnum::cases(), 'value');
        $match_status_names = array_column(\App\Enum\MatchStatusEnum::cases(), 'name');
        // $league_status = array_combine($league_status_names, $league_status_values);

        // Workaround for validate:
        $match_status_list = array_combine($match_status_values, $match_status_values);

        // League_type variable to show different forms:
        // $league_type = LeagueTypes::find($league->league_type_id)->first()->league_type;
        $league_type = LeagueTypes::find($league->league_type_id)->league_type;

        return view('matches.create', compact('league', 'teams_list', 'next_match_number', 'match_status_list', 'league_type'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'league_id' => 'required',
            'match_number' => 'required',
            'match_date' => 'required|date',
            'host_team_id' => 'required',
            'guest_team_id' => 'required',
            'week_number' => 'required|numeric|min:1|max:256',
            'host_points' => 'nullable|numeric',
            'guest_points' => 'nullable|numeric',
            'match_status' => [new Enum(MatchStatusEnum::class)],
            'match_address_country' => 'max:255',
            'match_address_postalcode' => 'max:255',
            'match_address_city' => 'max:255',
            'match_address_street' => 'max:255',
            'match_address_number' => 'max:255',
            'match_address_floor' => 'max:255',
            'match_address_door' => 'max:255',
        ]);

        // Validate Request depeding on league_type:

        // League_type variable to show different forms:
        $league = League::find($request->league_id);
        $league_type = LeagueTypes::find($league->league_type_id)->league_type;

        // Here all several sports must be added.
        // Note for the future...
        if (isset($league_type)) {

            switch ($league_type) {

                case 'Beach Volleyball':
                    $request->validate([
                        'matches_won' => 'nullable|numeric',
                        'sets_won' => 'nullable|numeric',
                        'points_won' => 'nullable|numeric',
                        'matches_lost' => 'nullable|numeric',
                        'sets_lost' => 'nullable|numeric',
                        'points_lost' => 'nullable|numeric',

                        'host_g3' => 'nullable|numeric',
                        'host_g2' => 'nullable|numeric',
                        'host_p1' => 'nullable|numeric',
                        'host_p0' => 'nullable|numeric',
                        'host_pg' => 'nullable|numeric',
                        'host_sf' => 'nullable|numeric',
                        'host_sc' => 'nullable|numeric',
                        'host_pf' => 'nullable|numeric',
                        'host_pc' => 'nullable|numeric',
                        'host_sanc' => 'nullable|numeric',

                        'guest_g3' => 'nullable|numeric',
                        'guest_g2' => 'nullable|numeric',
                        'guest_p1' => 'nullable|numeric',
                        'guest_p0' => 'nullable|numeric',
                        'guest_pg' => 'nullable|numeric',
                        'guest_sf' => 'nullable|numeric',
                        'guest_sc' => 'nullable|numeric',
                        'guest_pf' => 'nullable|numeric',
                        'guest_pc' => 'nullable|numeric',
                        'guest_sanc' => 'nullable|numeric',
                    ]);
                    // Set variable to add in results depending of type of league
                    $results = [
                        'matches_won' => $request->matches_won,
                        'sets_won' => $request->sets_won,
                        'points_won' => $request->points_won,
                        'matches_lost' => $request->matches_lost,
                        'sets_lost' => $request->sets_lost,
                        'points_lost' => $request->points_lost,

                        'host_g3' => $request->host_g3,
                        'host_g2' => $request->host_g2,
                        'host_p1' => $request->host_p1,
                        'host_p0' => $request->host_p0,
                        'host_pg' => $request->host_pg,
                        'host_sf' => $request->host_sf,
                        'host_sc' => $request->host_sc,
                        'host_pf' => $request->host_pf,
                        'host_pc' => $request->host_pc,
                        'host_sanc' => $request->host_sanc,

                        'guest_g3' => $request->guest_g3,
                        'guest_g2' => $request->guest_g2,
                        'guest_p1' => $request->guest_p1,
                        'guest_p0' => $request->guest_p0,
                        'guest_pg' => $request->guest_pg,
                        'guest_sf' => $request->guest_sf,
                        'guest_sc' => $request->guest_sc,
                        'guest_pf' => $request->guest_pf,
                        'guest_pc' => $request->guest_pc,
                        'guest_sanc' => $request->guest_sanc,
                    ];
                    break;

                case 'Other Sport':
                    // Temporal results empty array:
                    $results = [];

                    break;

                default:
                    $results = [];

                    break;
            }
        }

        // Procedure
        // 0 - Validate request
        // 1 - Create Address for match
        // 2 - Check for existing Teams and the team must not be the same!
        // 3 - Validate the match_number again!!!
        // 4 - Store Address
        // 5 -  Store Match in Database

        // VALIDATE THE MATCH NUMBER:
        $firstElementMatch = Matchy::where('league_id', $request->league_id)->orderby('match_number', 'DESC')->first();
        if (! $firstElementMatch) {
            $maxMatchNumber = null;
        } else {
            $maxMatchNumber = $firstElementMatch->match_number;
        }

        // $maxTeamNumber = Team::where('league_id',$id)->orderby('team_number', 'DESC')->first()->team_number;
        if (! $maxMatchNumber) {
            $next_match_number = 1;
        } else {
            $next_match_number = $maxMatchNumber + 1;
        }

        // Todo - Try Changing conditional...
        if ($next_match_number != $request->match_number) {
            // Something happend... Maybe a try of intrussion?
            $league_id = $request->league_id;

            return redirect()->route('matches.index', ['league' => $league_id]);
        }

        // ToDo - Check behaviour
        if ($request->host_team_id == $request->guest_team_id) {
            // A match of a team against itself is not allowed in this app...
            // We consider it as cheating
            // Cheaters must be desqualified!!!

            $league_id = $request->league_id;

            return redirect()->route('matches.create', ['league' => $league_id]);
        }

        $match_address = [
            'country' => $request->match_address_country,
            'postalcode' => $request->match_address_postalcode,
            'city' => $request->match_address_city,
            'street' => $request->match_address_street,
            'number' => $request->match_address_number,
            'floor' => $request->match_address_floor,
            'door' => $request->match_address_door,
        ];

        $newMatchAddress = Addresses::create($match_address);
        $newMatchAddressId = $newMatchAddress->address_id;

        $match = [
            'league_id' => $request->league_id,
            'match_number' => $request->match_number,
            'match_date' => $request->match_date,
            'host_team_id' => $request->host_team_id,
            'guest_team_id' => $request->guest_team_id,
            'week_number' => $request->week_number,
            'match_address_id' => $newMatchAddressId,
            'host_points' => ($request->host_points ?? 0),
            'guest_points' => ($request->guest_points ?? 0),
            'match_status' => $request->match_status,
        ];

        $newMatch = Matchy::create($match);

        // Create Match Results:
        // Add the common data to $results:
        $results += [
            'league_id' => $newMatch->league_id,
            'match_id' => $newMatch->match_id,
            'host_team_id' => $newMatch->host_team_id,
            'guest_team_id' => $newMatch->guest_team_id,
        ];

        if (isset($league_type)) {

            switch ($league_type) {

                case 'Beach Volleyball':
                    $newResults = ResultsBeachVolleyball::create($results);
                    break;
            }
        }

        return redirect()->route('matches.index', ['league' => $request->league_id])
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $league_id, string $match_id)
    {
        // Shows information for one match:
        // Match information (Same as index view)
        // Teams information
        // Results information

        $league = League::find($league_id);
        $match = Matchy::find($match_id);
        $match_address = Addresses::find($match->match_address_id);
        $host_team = Team::find($match->host_team_id);
        $guest_team = Team::find($match->guest_team_id);
        $results = ResultsBeachVolleyball::where('match_id', $match->match_id);
        $league_type = LeagueTypes::where('league_type_id', $league->league_type_id);

        // Append only date and only time to use it in the view:
        $match['only_date'] = date('d/m/Y', strtotime($match->match_date));
        $match['only_time'] = date('h:m', strtotime($match->match_date));

        return view('matches.show', compact('league', 'match', 'match_address', 'host_team', 'guest_team', 'league_type', 'results'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $league_id, string $match_id)
    {
        $league = League::find($league_id);

        // Teams for select host and guest team:
        $teams_list_ids = Team::where('league_id', $league_id)->orderby('team_name', 'ASC')->pluck('team_id')->toArray();
        $teams_list_names = Team::where('league_id', $league_id)->orderby('team_name', 'ASC')->pluck('team_name')->toArray();
        $teams_list = array_combine($teams_list_ids, $teams_list_names);

        // Match Possible Status From ENUM:
        $match_status_values = array_column(\App\Enum\MatchStatusEnum::cases(), 'value');
        $match_status_names = array_column(\App\Enum\MatchStatusEnum::cases(), 'name');
        // $league_status = array_combine($league_status_names, $league_status_values);

        // Workaround for validate:
        $match_status_list = array_combine($match_status_values, $match_status_values);

        $match = Matchy::find($match_id);
        $match_address = Addresses::find($match->match_address_id);
        $host_team = Team::find($match->host_team_id);
        $guest_team = Team::find($match->guest_team_id);

        // Default value for select guest and host teams:
        $select_host_value = array_search($host_team->team_name, $teams_list);
        $select_guest_value = array_search($guest_team->team_name, $teams_list);

        // League_type variable to show different forms:
        $league_type = LeagueTypes::find($league->league_type_id)->league_type;

        return view('matches.edit', compact('league', 'match', 'match_address', 'host_team', 'guest_team', 'teams_list', 'match_status_list', 'select_host_value', 'select_guest_value', 'league_type'));
    }

    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'league_id' => 'required',
            'match_id' => 'required',
            'match_number' => 'required',
            'match_date' => 'required|date',
            'host_team_id' => 'required',
            'guest_team_id' => 'required',
            'week_number' => 'required|numeric|min:1|max:256',

            'host_points' => 'nullable|numeric',
            'guest_points' => 'nullable|numeric',

            'match_status' => [new Enum(MatchStatusEnum::class)],

            'match_address_country' => 'max:255',
            'match_address_postalcode' => 'max:255',
            'match_address_city' => 'max:255',
            'match_address_street' => 'max:255',
            'match_address_number' => 'max:255',
            'match_address_floor' => 'max:255',
            'match_address_door' => 'max:255',
        ]);

        // League_type variable to show different forms:
        $league = League::find($request->league_id);
        $league_type = LeagueTypes::find($league->league_type_id)->league_type;

        if (isset($league_type)) {

            switch ($league_type) {

                case 'Beach Volleyball':
                    $request->validate([
                        'matches_won' => 'nullable|numeric',
                        'sets_won' => 'nullable|numeric',
                        'points_won' => 'nullable|numeric',
                        'matches_lost' => 'nullable|numeric',
                        'sets_lost' => 'nullable|numeric',
                        'points_lost' => 'nullable|numeric',

                        'host_g3' => 'nullable|numeric',
                        'host_g2' => 'nullable|numeric',
                        'host_p1' => 'nullable|numeric',
                        'host_p0' => 'nullable|numeric',
                        'host_pg' => 'nullable|numeric',
                        'host_sf' => 'nullable|numeric',
                        'host_sc' => 'nullable|numeric',
                        'host_pf' => 'nullable|numeric',
                        'host_pc' => 'nullable|numeric',
                        'host_sanc' => 'nullable|numeric',

                        'guest_g3' => 'nullable|numeric',
                        'guest_g2' => 'nullable|numeric',
                        'guest_p1' => 'nullable|numeric',
                        'guest_p0' => 'nullable|numeric',
                        'guest_pg' => 'nullable|numeric',
                        'guest_sf' => 'nullable|numeric',
                        'guest_sc' => 'nullable|numeric',
                        'guest_pf' => 'nullable|numeric',
                        'guest_pc' => 'nullable|numeric',
                        'guest_sanc' => 'nullable|numeric',
                    ]);
                    // Set variable to add in results depending of type of league
                    $results = [
                        'matches_won' => $request->matches_won,
                        'sets_won' => $request->sets_won,
                        'points_won' => $request->points_won,
                        'matches_lost' => $request->matches_lost,
                        'sets_lost' => $request->sets_lost,
                        'points_lost' => $request->points_lost,

                        'host_g3' => $request->host_g3,
                        'host_g2' => $request->host_g2,
                        'host_p1' => $request->host_p1,
                        'host_p0' => $request->host_p0,
                        'host_pg' => $request->host_pg,
                        'host_sf' => $request->host_sf,
                        'host_sc' => $request->host_sc,
                        'host_pf' => $request->host_pf,
                        'host_pc' => $request->host_pc,
                        'host_sanc' => $request->host_sanc,

                        'guest_g3' => $request->guest_g3,
                        'guest_g2' => $request->guest_g2,
                        'guest_p1' => $request->guest_p1,
                        'guest_p0' => $request->guest_p0,
                        'guest_pg' => $request->guest_pg,
                        'guest_sf' => $request->guest_sf,
                        'guest_sc' => $request->guest_sc,
                        'guest_pf' => $request->guest_pf,
                        'guest_pc' => $request->guest_pc,
                        'guest_sanc' => $request->guest_sanc,
                    ];

                    break;
            }
        }

        // Procedure
        // 1 - Validate Request
        // 2 - Find the match and address component
        // 3 - Modify the values of the address
        // 4 - Modify the values for the match ->update()

        // 2 - Find the match and address "rows":
        $matchToModify = Matchy::find($request->match_id);
        $addressToModify = Addresses::find($matchToModify->match_address_id);

        // 2.1 - Find the league in order to assure its existence and reroute at the end:
        $league = League::find($request->league_id);

        // Validate the match number... It cannot / MUST NOT be changed!
        if ($request->match_number != $matchToModify->match_number) {
            return redirect()->route('matches.index', ['league' => $league->league_id, 'match' => $matchToModify->match_id])
                ->with('success', 'Match updated successfully.');

        }

        // 2- Modify the values for the address:
        $match_address = [
            'country' => $request->match_address_country,
            'postalcode' => $request->match_address_postalcode,
            'city' => $request->match_address_city,
            'street' => $request->match_address_street,
            'number' => $request->match_address_number,
            'floor' => $request->match_address_floor,
            'door' => $request->match_address_door,
        ];
        $addressToModify->update($match_address);

        // 4 - Modify the values for match:
        $match = [
            'match_number' => $request->match_number,
            'match_date' => $request->match_date,
            'host_team_id' => $request->host_team_id,
            'guest_team_id' => $request->guest_team_id,
            'week_number' => $request->week_number,
            'host_points' => ($request->host_points ?? 0),
            'guest_points' => ($request->guest_points ?? 0),
            'match_status' => ($request->match_status),
        ];

        $matchToModify->update($match);

        if (isset($league_type)) {

            switch ($league_type) {

                case 'Beach Volleyball':
                    $resultsToModify = ResultsBeachVolleyball::where('match_id', $matchToModify->match_id);
                    $resultsToModify->update($results);
                    break;
            }
        }

        return redirect()->route('matches.index', ['league' => $league->league_id, 'match' => $matchToModify->match_id])
            ->with('success', 'Match updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $league_id, string $match_id)
    {
        // Destroy the match and address corresponding to it:
        $matchToDestroy = Matchy::find($match_id);
        $addressToDestroy = Addresses::find($matchToDestroy->match_address_id);

        // Validate that the match is part of the given league:
        // If not something went wrong... Login into the web log:
        if ($matchToDestroy->league_id != $league_id) {
            // Log in the server logs!!!
            // ToDo!!! - Warning!!! Security!!

            // Return without doing any deletion!!
            return redirect()->route('leagues.index');
        }

        // Delete both  address and match
        $matchToDestroy->delete();
        $addressToDestroy->delete();

        return redirect()->route('matches.index', ['league' => $league_id, 'match' => $match_id])
            ->with('success', 'Match deleted successfully');
    }
}
