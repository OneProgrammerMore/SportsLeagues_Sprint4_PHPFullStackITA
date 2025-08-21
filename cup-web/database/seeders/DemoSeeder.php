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


class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Create one league
        $league = League::factory()->create();
        $league_id = $league;
        // Create 8 teams for these league
        $amountTeams = 8;
        $teams = [];
        for( $num = 0; $num < $amountTeams; $num += 1 ) { 
            array_push($teams, Team::factory()->state(['league_id'=> $league_id, 'team_number'=>$num])->create());
        }
        
        $amountPlayers = 8;
        // For each team create 8 Players
        foreach($teams as $team){
            for( $num = 0; $num < $amountPlayers; $num += 1 ) { 
                echo "LeaugeID = ". $league_id;
                echo "team_id= ". $team;
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
        echo "NUmber Of Matches ".count($matches)."\n\n\n\n\n";
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
        echo "NUmber Of Matches ".count($matches)."\n\n\n\n\n";
        
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

                echo "Number Line = ".$index."\n";

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



        /*
        for( $host = 0; $host < ($amountTeams-1); $host += 1 ) {
            for( $guest = $amountTeams-1; $guest > ($amountTeams-1)-($amountTeams-1)/2; $guest -= 1){  
                
                if($guest != $host){
                    $match = Matchy::where('league_id','=',$league->league_id)->orderBy('match_number', 'DESC')->first();
                    if(! $match && $matchNumber == 0){
                        $matchNumber = 1;
                    }else{
                        //$matchNumber = $match->match_number++;
                        $matchNumber = $matchNumber+1;
                    }

                    $match = Matchy::factory()->state(
                        ['league_id'=>$league_id,
                        'host_team_id' => $teams[$host],
                        'guest_team_id'=> $teams[$guest],
                        'week_number'=>$host+1,
                        'match_number'=>$matchNumber,
                        ]
                        )->create();
                    //Create results
                    if($league->league_type_id == 1){
                        ResultsBeachVolleyball::factory()->state(
                            [
                                'league_id' => $league_id,
                                'match_id' => $match,
                                'host_team_id' => $teams[$host],
                                'guest_team_id'=> $teams[$guest],
                            ]
                        )->create();
                    }
                }

            }
        }*/
        
       
    }
}
