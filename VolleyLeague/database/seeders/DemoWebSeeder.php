<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\League;
use App\Models\Team;
use App\Models\Players;
use App\Models\Matchy;
use App\Models\LeagueTypes;
use App\Models\Results\ResultsBeachVolleyball;


class DemoWebSeeder extends Seeder
{

    public function createLeagueXTeams($leagueName, $amountTeams, $amountPlayers, $leagueType){

        echo "Creating league with Name -> ". $leagueName. "\n";
        echo "Creating league with Team Amount -> ". $amountTeams. "\n";
        echo "Creating league with Players Amount -> ". $amountPlayers. "\n";

        //Create one league
        $league = League::factory()->state([
            'league_name'=>$leagueName,
            'league_type_id'=>$leagueType
        ])->create();
        $league_id = $league;
        // Create 8 teams for these league
        $teams = [];
        for( $num = 0; $num < $amountTeams; $num += 1 ) { 
            array_push($teams, Team::factory()->state(['league_id'=> $league_id, 'team_number'=>$num])->create());
        }
        
        // For each team create 8 Players
        foreach($teams as $team){
            for( $num = 0; $num < $amountPlayers; $num += 1 ) { 
                Players::factory()->state(['league_id'=>$league_id, 'team_id'=>$team])->create();
            }  
        }

        //Create Matches:
        
        $matches = [];
        $matchNumber = 0;
        $matchesPerRound = ceil($amountTeams/2);
        $team = 1;
        $amountOfRounds = ceil($amountTeams/2)*2;
        for( $round = 0; $round < $amountOfRounds-1; $round += 1 ) {   
            for($x=0; $x < ceil($amountTeams/2); $x+=1){
                array_push($matches, ["host_team"=>$team, "round"=>$round+1]);
                $team += 1;
                if(($amountTeams %2 == 0 && $team > $amountTeams-1 )|| ($amountTeams %2 != 0 && $team > $amountTeams)){
                    $team = 1;
                }
            }
        }
        $x = 0;
        for( $round = 0; $round < ($amountOfRounds-1); $round += 1 ) {   
            if($round < $amountOfRounds-2 ){
                $arrrayAux = array_reverse(array_slice($matches, $round*$matchesPerRound+$matchesPerRound, $matchesPerRound));
            }else{
                $arrrayAux = array_reverse(array_slice($matches, 0, $matchesPerRound));
            }
            
            foreach($arrrayAux as $team){
                $matches[$x]['guest_team'] = $team['host_team'];
                $x +=1;
            }
        }
        
        if($amountTeams%2 == 0){
            $i=0;
            $c=0;
            foreach($matches as $match){
                if($i%$matchesPerRound == 0){
                    if($c%2==2){
                        $matches[$i]['guest_team'] = $amountTeams;
                    }else{
                        $matches[$i]['host_team'] = $amountTeams;
                    }
                    $c+=1;
                }
                $i+=1;

            }
        }
        
        
        $index = 0;
        $matchNumber = 0;
        foreach($matches as $match){
            if($amountTeams % 2 == 0 || ($amountTeams % 2 != 0 && $index % $matchesPerRound != 0 ) ){

                $matchDB = Matchy::where('league_id','=',$league->league_id)->orderBy('match_number', 'DESC')->first();
                if(! $matchDB && $matchNumber == 0){
                    $matchNumber = 1;
                }else{
                    $matchNumber += 1;
                }

                $matchNew = Matchy::factory()->state(
                    ['league_id'=>$league_id,
                    'host_team_id' => $teams[$match['host_team']-1],
                    'guest_team_id'=> $teams[$match['guest_team']-1],
                    'week_number'=>$match['round'],
                    'match_number'=>$matchNumber,
                    ]
                    )->create();
                //Create results
                if($league->league_type_id == 1){
                    ResultsBeachVolleyball::factory()->state(
                        [
                            'league_id' => $league_id,
                            'match_id' => $matchNew,
                            'host_team_id' => $teams[$match['host_team']-1],
                            'guest_team_id'=> $teams[$match['guest_team']-1],
                        ]
                    )->create();
                }

            }
            $index +=1;
        }
        return $league;
    }



    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this::createLeagueXTeams('8-Teams Volleyball League RandomData', 8, 8,1);
        $this::createLeagueXTeams('5-Teams Volleyball League RandomData', 5, 5,1);
        //$this::createLeagueXTeams('3TeamsLeagueRandomData', 3, 6,1);
        //$this::createLeagueXTeams('2TeamsLeagueRandomData', 2, 4,1);
        $this::createLeagueXTeams('11-Teams Volleyball League RandomData', 11, 7,1);

        $this::createLeagueXTeams('8-Teams Basketball League RandomData', 8, 8,2);
        $this::createLeagueXTeams('5-Teams Basketball League RandomData', 5, 5,2);
        $this::createLeagueXTeams('11-Teams Basketball League RandomData', 11, 7,2);
    }
}
