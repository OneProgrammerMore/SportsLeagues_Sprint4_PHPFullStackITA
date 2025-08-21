<?php

namespace App\Http\Controllers;

use App\Enum\SexEnum;
use App\Models\Addresses;
use App\Models\League;
use App\Models\Players;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $league_id, string $team_id)
    {
        // return view('players.index');
        return redirect()->route('teams.show', ['league' => $league_id, 'team' => $team_id])
            ->with('success', 'Team created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($league_id, $team_id)
    {
        $league = League::find($league_id);
        $team = Team::find($team_id);

        $sex_status_values = array_column(\App\Enum\SexEnum::cases(), 'value');
        $sex_status_names = array_column(\App\Enum\SexEnum::cases(), 'name');
        // Workaround for validate:
        $sexs_list = array_combine($sex_status_values, $sex_status_values);

        return view('players.create', compact('league', 'team', 'sexs_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $league_id, $team_id)
    {
        // Store the player info
        $request->validate([
            'league_id' => 'required',
            'team_id' => 'required',
            'player_name' => 'required',
            'player_number' => 'nullable|numeric',
            'player_surname_1' => 'required',
            'player_surname_2' => 'nullable|max:255',
            'player_sex' => ['required', new Enum(SexEnum::class)],
            'player_birth_date' => 'nullable|date',
            'player_country' => 'nullable|max:255',
            'player_height' => 'nullable|numeric',
            'player_weight' => 'nullable|numeric',
            'player_img' => 'nullable|file|mimes:png,jpeg,svg|max:5000',
            'player_phone' => 'nullable|max:50',
            'player_email' => 'required',
        ]);

        // Store image and compute new image name:
        // 3. Store image:
        if ($request->hasFile('player_img')) {
            // Store request image in variable:
            $imgPlayerFile = $request->file('player_img');
            // Create an unique name in order to store the image using it
            $nameImgToStore = $imgPlayerFile->hashName();
            // Store the image in the public /team_imgs/ folder
            $pathImgStored = $request->file('player_img')->storeAs('public/imgs/player_imgs',
                $nameImgToStore);
            // Add the final name of the image to the request (the name within it has been stored)
        } else {
            // If there is no image store an empty string
            $pathImgStored = '';
        }

        // Compute Players Age:
        $dateNow = new \DateTime(date('Y-m-d'));
        $dateBirth = new \DateTime($request->player_birth_date);
        $player_age = $dateNow->diff($dateBirth, true)->y;

        // Create Address Row For future implementations:
        $new_address_id = Addresses::create()->address_id;

        // Define the data of the player in order to be stored:
        $newPlayerData = [
            'team_id' => $request->team_id,
            'league_id' => $request->league_id,
            'player_number' => $request->player_number,

            'name' => $request->player_name,
            'surname_1' => $request->player_surname_1,
            'surname_2' => $request->player_surname_2,
            'sex' => $request->player_sex,
            'player_img_name' => $pathImgStored,
            'height' => $request->player_height,
            'weight' => $request->player_weight,
            'country' => $request->player_country,
            'age' => $player_age,
            'birth_date' => $request->player_birth_date,

            'email' => $request->player_email,
            'phone' => $request->player_phone,
            // No address needed untill version 2 -  Too much work
            'address_id' => $new_address_id,
        ];

        // Sotre player info into database:
        $newPlayer = Players::create($newPlayerData);

        return redirect()->route('teams.show', ['league' => $request->league_id, 'team' => $team_id])
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $league_id, string $team_id, string $player_id)
    {
        $league = League::find($league_id);
        $team = Team::find($team_id);
        $player = Players::find($player_id);

        return view('players.show', compact('league', 'team', 'player'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $league_id, string $team_id, string $player_id)
    {
        $league = League::find($league_id);
        $team = Team::find($team_id);
        $player = Players::find($player_id);

        $sex_status_values = array_column(\App\Enum\SexEnum::cases(), 'value');
        $sex_status_names = array_column(\App\Enum\SexEnum::cases(), 'name');
        // Workaround for validate:
        $sexs_list = array_combine($sex_status_values, $sex_status_values);

        return view('players.edit', compact('league', 'team', 'sexs_list', 'player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $league_id, string $team_id, string $player_id)
    {
        // Validate the request...
        $request->validate([
            'league_id' => 'required',
            'team_id' => 'required',
            'player_name' => 'required',
            'player_number' => 'required|numeric',
            'player_surname_1' => 'required',
            'player_surname_2' => 'nullable|max:255',
            'player_sex' => ['required', new Enum(SexEnum::class)],
            'player_birth_date' => 'required|date',
            'player_country' => 'nullable|max:255',
            'player_height' => 'nullable|numeric',
            'player_weight' => 'nullable|numeric',
            'player_img' => 'nullable|file|mimes:png,jpeg,svg|max:5000',
            'player_phone' => 'nullable|max:50',
            'player_email' => 'required',
        ]);

        $player = Players::find($player_id);
        $playerData = [];

        // 3. Update the image:
        // Updates Image (Deletes the old one and stores the new one)
        // File Image Working:
        if ($request->hasFile('player_img')) {

            // Create a variable containing the info of the image upload:
            $imgPlayerFile = $request->file('player_img');
            // Create a unique file name for the image, in order to store it
            $nameImgToStore = $imgPlayerFile->hashName();
            // Store the image in the 'league_imgs' folder with the hashed name:
            $pathImgStored = $request->file('player_img')->storeAs('public/imgs/player_imgs',
                $nameImgToStore);
            // Delete the old image:
            $oldImgNamePath = public_path().'/storage/'.$player->player_img_name;
            if (File::exists($oldImgNamePath)) {
                File::delete($oldImgNamePath);
            }
            $playerData += ['player_img_name' => $pathImgStored];
        }

        // Compute Players Age:
        $dateNow = new \DateTime(date('Y-m-d'));
        $dateBirth = new \DateTime($request->player_birth_date);
        // $dateBirth = new \DateTime('1993-10-21');
        $player_age = $dateNow->diff($dateBirth, true)->y;

        // Define the data of the player in order to be stored:
        $playerData += [
            'team_id' => $request->team_id,
            'league_id' => $request->league_id,
            'player_number' => $request->player_number,

            'name' => $request->player_name,
            'surname_1' => $request->player_surname_1,
            'surname_2' => $request->player_surname_2,
            'sex' => $request->player_sex,
            'height' => $request->player_height,
            'weight' => $request->player_weight,
            'country' => $request->player_country,
            'age' => $player_age,
            'birth_date' => $request->player_birth_date,

            'email' => $request->player_email,
            'phone' => $request->player_phone,
            // No address needed untill version 2 -  Too much work
        ];

        // Sotre player info into database:
        $player->update($playerData);

        return redirect()->route('players.index', ['league' => $request->league_id, 'team' => $team_id])
            ->with('success', 'Team created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $league_id, string $team_id, string $player_id)
    {
        $player = Players::find($player_id);
        $address = Addresses::find($player->address_id);

        $player->delete();
        $address->delete();

        return redirect()->route('players.index', ['league' => $league_id, 'team' => $team_id])
            ->with('success', 'Team created successfully.');
    }
}
