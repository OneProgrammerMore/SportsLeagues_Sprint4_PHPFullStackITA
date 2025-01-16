<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Models\LeagueTypes;
//use Spatie\Html\Elements\Element;
use App\Enum\LeagueStatusEnum;
use Illuminate\Validation\Rules\Enum;

//In order to work with files:
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 



class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Index League Controller will show all leagues related with the user.
        $leagues = League::all();
		return view('leagues.index', compact('leagues'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Create League Controller will show the user to create a League (If policy aggrees)
        $league_types = LeagueTypes::pluck('description','league_type_id')->toArray();
        $league_status_values = array_column(\App\Enum\LeagueStatusEnum::cases(), 'value');
        $league_status_names = array_column(\App\Enum\LeagueStatusEnum::cases(), 'name');
        //$league_status = array_combine($league_status_names, $league_status_values);
        
        //Workaround for validate:
        $league_status = array_combine($league_status_values, $league_status_values);
        
        return view('leagues.create', compact('league_types', 'league_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Store League Controller will allow the user to store a League (If policy aggrees)
        $request->validate([
		  'league_type_id' => 'required',
		  'league_name' => 'required|max:255',
		  'league_status' => ['required', new Enum(LeagueStatusEnum::class)],
		  'league_img' => 'file|mimes:png,jpeg,svg|max:5000',
		  'league_description' => 'max:1500',
		  'league_starting_date' => 'required|date',
		  'league_finalization_date' => 'required|date',
		  'league_web' => 'max:500',
		  'league_channel' => 'max:500'
 
		]);
		
		//Add the parameter 'league_type' by searching the match in the table league_types with id 'league_type_id';
		$leagueType = LeagueTypes::find($request->league_type_id)->league_type;	
		$request->request->add(['league_type' => $leagueType]);
		
		//File Image Working:
		if($request->hasFile('league_img')){
			$imgLeagueFile = $request->file('league_img');
			
			$nameImgToStore = $imgLeagueFile->hashName();
			
			$pathImgStored = $request->file('league_img')->storeAs('public/league_imgs',
				$nameImgToStore);
			
			$request->request->add(['league_img_name' => $pathImgStored]);
			League::create($request->all());
			return redirect()->route('leagues.index')
			  ->with('success', 'League created successfully.');
			
		}else{
			$request->request->add(['league_img_name' => ""]);
			League::create($request->all());
			return redirect()->route('leagues.index')
			  ->with('success', 'League created successfully.');
		}
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Show League Controller will allow the user to create a League (If policy aggrees)
        $league = League::find($id);
		return view('leagues.show', compact('league'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Edit League Controller will show the user to edit a League (If policy aggrees)
        $league = League::find($id);
        
        //Leagues type for edition:
        $league_types = LeagueTypes::pluck('description','league_type_id')->toArray();
        $league_status_values = array_column(\App\Enum\LeagueStatusEnum::cases(), 'value');

        $league_status = array_combine($league_status_values, $league_status_values);
        
        $league_type = $league->league_type;
        
		return view('leagues.edit', compact('league', 'league_types', 'league_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Update League Controller will allow the user to create a League (If policy aggrees)
		$request->validate([
		  'league_type' => 'required',
		  'league_name' => 'required|max:255',
		  'league_status' => ['required', new Enum(LeagueStatusEnum::class)],
		  'league_img' => 'file|mimes:png,jpeg,svg|max:5000',
		  'league_description' => 'max:1500',
		  'league_starting_date' => 'required|date',
		  'league_finalization_date' => 'required|date',
		  'league_web' => 'max:500',
		  'league_channel' => 'max:500'
		]);
		$league = League::find($id);
		
		//Add the parameter 'league_type' by searching the match in the table league_types with id 'league_type_id';
		$leagueTypeId = LeagueTypes::where('league_type', $request->league_type)->first()->league_type_id;	
		$request->request->add(['league_type_id' => $leagueTypeId]);
		
		//Updates Image (Deletes the old one and stores the new one)
		//File Image Working:
		if($request->hasFile('league_img')){
			
			//Create a variable containing the info of the image upload:
			$imgLeagueFile = $request->file('league_img');
			//Create a unique file name for the image, in order to store it
			$nameImgToStore = $imgLeagueFile->hashName();
			//Store the image in the 'league_imgs' folder with the hashed name:
			$pathImgStored = $request->file('league_img')->storeAs('public/league_imgs',
				$nameImgToStore);
			//Delete the old image:
			$oldImgNamePath = public_path() ."/storage/public/". $league->league_img_name;
			if(File::exists($oldImgNamePath)){
				//unlink($oldImgNamePath);
				File::delete($oldImgNamePath);
			}
			
			$request->request->add(['league_img_name' => $pathImgStored]);
		}

		//Check that league type is the same as before (if it changes it makes problems with the table structure and the data already stored
		//If league_type_id is the same update the model:
		if($request->league_type_id == $league->league_type_id){
			//Same league_type_id given and stored in database
			//Execute the update of the database:
			$league->update($request->all());
			return redirect()->route('leagues.index')
			->with('success', 'League updated successfully.');

		}else{
			//Something wrong happend, maybe an attack?
			//Log into Warnings!
		}
		return redirect()->route('leagues.index')
		  ->with('success', 'League updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Deletes League Controller will allow the user to delete a League (If policy aggrees)
        $league = League::find($id);

        //Delete the old image:
		$oldImgNamePath = public_path() ."/storage/public/". $league->league_img_name;
		if(File::exists($oldImgNamePath)){
			File::delete($oldImgNamePath);
		}
        
		$league->delete();
		return redirect()->route('leagues.index')
		->with('success', 'League deleted successfully');
    }
}
