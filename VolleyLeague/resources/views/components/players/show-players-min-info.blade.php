
@vite('resources/css/comp_players.css')
<div class="players-all-container">
		<div class="players-container-title">
			Players of the team
		</div>
    @foreach($players as $player)
		<div class="player-container">
			
			<div class="player-info">
				<div class="player-photo">
					<img class="player-img" src="{{ asset( $player->player_img_name ? 'storage/'.$player->player_img_name : 'img/player.png' )}}" alt="Player Photo">
				</div>
				<div class="player-data">
					<div class="player-team-info">
						{{$player->player_number ?? ""}} - {{$team->team_name ?? ""}} - {{$league->league_name ?? ""}}
					</div>
						
					<div class="player-name">
						{{$player->name ?? ""}}, {{$player->surname_1 ?? ""}} {{$player->surname_2 ?? ""}}
					</div>
					<div class="player-origin-data">
						{{$player->sex ?? "" }} - {{$player->birth_date ?? ""}} ({{$player->age ?? ""}}) - {{$player->country ?? ""}}
					</div>
					<div class="player-body">
						<h3>Height:</h3> <h2>{{$player->height}} m</h2>
						<h3>Weight:</h3> <h2>{{$player->weight}} bananas</h2>
					</div>
					
					
				</div>
				
			</div>
			<div class="player-actions">
				
				<div class="player-action">
					<form action="{{ route('players.show', ['league'=> $league->league_id, 'team' => $team->team_id, 'player' => $player->player_id ]) }}" method="get">
						@csrf
						@method('GET')
						<button type="submit" class="btn-info btn-players-action">
							<img class="btn-img" src="{{ asset('img/info.png') }}"> 
							Show</button>
					</form>
				</div>
				
				
				<div class="player-action">	
					<form action="{{ route('players.edit', ['league'=> $league->league_id, 'team' => $team->team_id , 'player' => $player->player_id ]) }}" method="post">
						@csrf
						@method('GET')
						<button type="submit" class="btn-edit btn-players-action">
							<img class="btn-img" src="{{ asset('img/edit.png') }}"> 
							Edit</button>
					</form>
				</div>
				
				
				<div class="player-action">
					
					<form action="{{ route('players.destroy', ['league'=> $league->league_id, 'team' => $team->team_id, 'player' => $player->player_id ]) }}" method="post">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn-delete btn-players-action">
							<img class="btn-img" src="{{ asset('img/delete.png') }}"> 
							Delete</button>
					</form>
					
					
				</div>
			</div>
		
		</div>
    
    @endforeach
    
</div>
