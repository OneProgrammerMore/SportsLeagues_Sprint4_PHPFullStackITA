<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\League;
use App\Models\Person;
use App\Models\Players;
use App\Models\Team;
use Illuminate\Http\Request;
// In order to work with files:
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        // Index League Controller will show all leagues related with the user.
        $teams = Team::where('league_id', $id)->get();
        $league = League::find($id);
        $league_id = $id;

        // Add address to team add from addresses tables depending on address_id in team
        foreach ($teams as $team) {

            $team_address = Addresses::find($team->team_address_id);

            $team->address_street = ($team_address->street ?? '');
            $team->address_number = ($team_address->number ?? '');
            $team->address_floor = ($team_address->floor ?? '');
            $team->address_door = ($team_address->door ?? '');
            $team->address_city = ($team_address->city ?? '');
            $team->address_postalcode = ($team_address->postalcode ?? '');
            $team->address_country = ($team_address->country ?? '');
        }

        return view('teams.index', compact('teams', 'league'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $league = League::find($id);
        // Find the maximum number of a team to add the following
        // $maxTeamNumber = Team::where('league_id',$id)->sortDesc('team_number')->first();

        $firstElementTeam = Team::where('league_id', $id)->orderby('team_number', 'DESC')->first();
        if (! $firstElementTeam) {
            $maxTeamNumber = null;
        } else {
            $maxTeamNumber = $firstElementTeam->team_number;
        }

        // $maxTeamNumber = Team::where('league_id',$id)->orderby('team_number', 'DESC')->first()->team_number;
        if (! $maxTeamNumber) {
            $next_team_number = 1;
        } else {
            $next_team_number = $maxTeamNumber + 1;
        }

        return view('teams.create', compact('league', 'next_team_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, Request $request)
    {
        // Procedure to store a team:
        // 1. Validate Request
        // 2. Validate Team Number
        // 3. Store Image and get Image name for folder /teams_imgs/
        // 4. Store info in database
        // 4.1 - Store Address Team in addresses table (Store primary id in variable)
        // 4.2 - Store Responsible info in Person table (Store primary id in variable)
        // 4.3 - Store Team information in Team Table
        // 5. Return to /leagues/{league}/teams

        // 1. Validate request:
        $request->validate([
            'team_number' => 'required',
            'league_id' => 'required',
            'team_name' => 'required|max:255',
            'team_img' => 'file|mimes:png,jpeg,svg|max:5000',
            'team_phone' => 'required|max:255',
            'team_email' => 'required|max:255',

            'team_responsible_name' => 'max:255',
            'team_responsible_surname_1' => 'max:255',
            'team_responsible_surname_2' => 'max:255',
            'team_responsible_email' => 'max:255',
            'team_responsible_phone' => 'max:255',

            'team_responsible_address_country' => 'max:255',
            'team_responsible_address_postalcode' => 'max:255',
            'team_responsible_address_city' => 'max:255',
            'team_responsible_address_street' => 'max:255',
            'team_responsible_address_number' => 'max:255',
            'team_responsible_address_floor' => 'max:255',
            'team_responsible_address_door' => 'max:255',

            'team_address_country' => 'max:255',
            'team_address_postalcode' => 'max:255',
            'team_address_city' => 'max:255',
            'team_address_street' => 'max:255',
            'team_address_number' => 'max:255',
            'team_address_floor' => 'max:255',
            'team_address_door' => 'max:255',
        ]);

        // 2. Validate team number:
        $league_id = $id;
        $league = League::find($league_id);

        $firstElementTeam = Team::where('league_id', $id)->orderby('team_number', 'DESC')->first();
        if (! $firstElementTeam) {
            $maxTeamNumber = null;
        } else {
            $maxTeamNumber = $firstElementTeam->team_number;
        }

        if (! $maxTeamNumber) {
            $next_team_number = 1;
        } else {
            $next_team_number = $maxTeamNumber + 1;
        }
        if ($next_team_number != $request->team_number) {
            // break;
            // or return to same view
            // break not working... therefore return:
            return redirect()->route('teams.index', 'league_id');
        }

        // 3. Store image:
        if ($request->hasFile('team_img')) {
            // Store request image in variable:
            $imgLeagueFile = $request->file('team_img');
            // Create an unique name in order to store the image using it
            $nameImgToStore = $imgLeagueFile->hashName();
            // Store the image in the public /team_imgs/ folder
            $pathImgStored = $request->file('team_img')->storeAs('public/imgs/team_imgs',
                $nameImgToStore);

        } else {
            // If there is no image store an empty string
            // $request->request->add(['team_img_name' => ""]);
            $pathImgStored = '';
        }

        //
        $team_address = [
            'country' => $request->team_address_country,
            'postalcode' => $request->team_address_postalcode,
            'city' => $request->team_address_city,
            'street' => $request->team_address_street,
            'number' => $request->team_address_number,
            'floor' => $request->team_address_floor,
            'door' => $request->team_address_door,
        ];

        $newTeamAddress = Addresses::create($team_address);
        $newIdAddress = $newTeamAddress->address_id;

        // Responsible address:
        $responsible_address = [
            'country' => $request->team_responsible_address_country,
            'postalcode' => $request->team_responsible_address_postalcode,
            'city' => $request->team_responsible_address_city,
            'street' => $request->team_responsible_address_street,
            'number' => $request->team_responsible_address_number,
            'floor' => $request->team_responsible_address_floor,
            'door' => $request->team_responsible_address_door,
        ];

        $newResponsibleAddress = Addresses::create($responsible_address);
        $newResponsibleIdAddress = $newResponsibleAddress->address_id;

        $team_responsible = [
            'person_name' => $request->team_responsible_name,
            'person_surname_1' => $request->team_responsible_surname_1,
            'person_surname_2' => $request->team_responsible_surname_2,
            'person_email' => $request->team_responsible_email,
            'person_phone' => $request->team_responsible_phone,
            // Null for the moment, add address somewhen... too lazy to do it now... I want results!!!
            'person_address_id' => $newResponsibleIdAddress,
        ];

        $newPerson = Person::create($team_responsible);
        $newIdPerson = $newPerson->person_id;

        $team_new = [
            'league_id' => $league_id,
            'team_number' => $next_team_number,
            'team_name' => $request->team_name,
            'team_address_id' => $newIdAddress,
            'team_responsible_id' => $newIdPerson,
            'team_phone' => $request->team_phone,
            'team_img_name' => $pathImgStored,
            'team_email' => $request->team_email,
        ];

        Team::create($team_new);

        return redirect()->route('teams.index', ['league' => $league_id])
            ->with('success', 'Team created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $league_id, string $team_id)
    {
        // Show Team Controller will show all the info about the team
        $teams = Team::where('league_id', $league_id)->get();
        $league = League::find($league_id);

        // Team info
        $team = Team::find($team_id);
        // Team address
        $team_address = Addresses::find($team->team_address_id);
        // Team responsible
        $team_responsible = Person::find($team->team_responsible_id);
        $team_responsible_address = Addresses::find($team_responsible->person_address_id);

        // Players:
        $players = Players::where('team_id', $team->team_id)->get();

        return view('teams.show', compact('team', 'league', 'team_address', 'team_responsible', 'team_responsible_address', 'players'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $league_id, string $team_id)
    {
        // Edit League Controller will show the user to edit a League (If policy aggrees)
        $league = League::find($league_id);
        $team = Team::find($team_id);
        $team_responsible = Person::find($team->team_responsible_id);
        $team_address = Addresses::find($team->team_address_id);

        // Team responsible
        $team_responsible_address = Addresses::find($team_responsible->person_address_id);

        // Take out nulls in order to make it work in the view -> a null will be changed by a empty string ""
        if (is_array($team_responsible)) {
            foreach ($team_responsible as $key => $value) {
                if ($value == null) {
                    $value = '';
                }
            }
        }

        // Take out nulls in order to make it work in the view -> a null will be changed by a empty string ""
        if (is_array($team_address)) {
            foreach ($team_address as $key => $value) {
                if ($value == null) {
                    $value = '';
                }
            }
        }

        return view('teams.edit', compact('league', 'team', 'team_address', 'team_responsible', 'team_responsible_address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, string $team_id, Request $request)
    {
        //
        // Procedure to store a team:
        // 1. Validate Request
        // 2. Validate Team Number
        // 3. Store Image and get Image name for folder /teams_imgs/
        // 4. Store info in database
        // 4.1 - Store Address Team in addresses table (Store primary id in variable)
        // 4.2 - Store Responsible info in Person table (Store primary id in variable)
        // 4.3 - Store Team information in Team Table
        // 5. Return to /leagues/{league}/teams

        // 1. Validate request:
        $request->validate([
            'team_number' => 'required',
            'league_id' => 'required',
            'team_id' => 'required',
            'team_name' => 'required|max:255',
            'team_img' => 'file|mimes:png,jpeg,svg|max:5000',
            'team_phone' => 'required|max:255',
            'team_email' => 'required|max:255',

            'team_responsible_name' => 'max:255',
            'team_responsible_surname_1' => 'max:255',
            'team_responsible_surname_2' => 'max:255',
            'team_responsible_email' => 'max:255',
            'team_responsible_phone' => 'max:255',

            'team_responsible_address_country' => 'max:255',
            'team_responsible_address_postalcode' => 'max:255',
            'team_responsible_address_city' => 'max:255',
            'team_responsible_address_street' => 'max:255',
            'team_responsible_address_number' => 'max:255',
            'team_responsible_address_floor' => 'max:255',
            'team_responsible_address_door' => 'max:255',

            'team_address_country' => 'max:255',
            'team_address_postalcode' => 'max:255',
            'team_address_city' => 'max:255',
            'team_address_street' => 'max:255',
            'team_address_number' => 'max:255',
            'team_address_floor' => 'max:255',
            'team_address_door' => 'max:255',
        ]);

        // 1.2 Find all parameters to update
        // Team, Team Address, Person (Team_responsible)
        $teamToUpdate = Team::find($request->team_id);
        $addressToUpdate = Addresses::find($teamToUpdate->team_address_id);

        $personToUpdate = Person::find($teamToUpdate->team_responsible_id);
        $addressResponsibleToUpdate = Addresses::find($personToUpdate->person_address_id);

        // 2. Validate team number:
        $league_id = $id;
        $league = League::find($league_id);

        // 3. Store image:
        if ($request->hasFile('team_img')) {
            // Store request image in variable:
            $imgLeagueFile = $request->file('team_img');
            // Create an unique name in order to store the image using it
            $nameImgToStore = $imgLeagueFile->hashName();
            // Store the image in the public /team_imgs/ folder
            $pathImgStored = $request->file('team_img')->storeAs('public/imgs/team_imgs',
                $nameImgToStore);
            // Delete the old image from team parameter field
            // Delete the old image:
            $oldImgNamePath = public_path().'/storage/public/'.$teamToUpdate->team_img_name;
            if (File::exists($oldImgNamePath)) {
                File::delete($oldImgNamePath);
            }

        } else {
            $pathImgStored = $teamToUpdate->team_img_name;
        }

        $team_address = [
            'country' => $request->team_address_country,
            'postalcode' => $request->team_address_postalcode,
            'city' => $request->team_address_city,
            'street' => $request->team_address_street,
            'number' => $request->team_address_number,
            'floor' => $request->team_address_floor,
            'door' => $request->team_address_door,
        ];

        $team_responsible_address = [
            'country' => $request->team_responsible_address_country,
            'postalcode' => $request->team_responsible_address_postalcode,
            'city' => $request->team_responsible_address_city,
            'street' => $request->team_responsible_address_street,
            'number' => $request->team_responsible_address_number,
            'floor' => $request->team_responsible_address_floor,
            'door' => $request->team_responsible_address_door,
        ];

        $team_responsible = [
            'person_name' => $request->team_responsible_name,
            'person_surname_1' => $request->team_responsible_surname_1,
            'person_surname_2' => $request->team_responsible_surname_2,
            'person_email' => $request->team_responsible_email,
            'person_phone' => $request->team_responsible_phone,
            'person_address_id' => $addressResponsibleToUpdate->address_id,
        ];

        $team_new = [
            'league_id' => $league_id,
            'team_number' => $request->team_number,
            'team_name' => $request->team_name,
            'team_address_id' => $addressToUpdate->address_id,
            'team_responsible_id' => $personToUpdate->person_id,
            'team_phone' => $request->team_phone,
            'team_img_name' => $pathImgStored,
            'team_email' => $request->team_email,
        ];

        // Store the information in the database:
        $personToUpdate->update($team_responsible);
        $addressToUpdate->update($team_address);
        $teamToUpdate->update($team_new);
        $addressResponsibleToUpdate->update($team_responsible_address);

        return redirect()->route('teams.index', ['league' => $league_id, 'id' => $league_id])
            ->with('success', 'Team modified successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $league_id, string $team_id)
    {
        // Deletes League Controller will allow the user to delete a League (If policy aggrees)
        $team = Team::find($team_id);

        // $league_id_from_team = $team->league_id;
        $league = League::find($league_id);

        // Delete the old image:
        $oldImgNamePath = public_path().'/storage/public/'.$team->team_img_name;
        if (File::exists($oldImgNamePath)) {
            // unlink($oldImgNamePath);
            File::delete($oldImgNamePath);
        }

        $team->delete();

        return redirect()->route('teams.index', compact('league', 'league_id'))
            ->with('success', 'Team deleted successfully');
    }
}
