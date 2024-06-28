<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href={{ URL::asset('css/app.css') }} rel="stylesheet" >
	<title>CupApp</title>
	@vite('resources/css/forms_design.css')
	@vite('resources/css/app.css')
	@vite('resources/css/players.css')
</head>



<body>

	@php
		$leagueId = $league->league_id;
	@endphp
	<x-web.header :leagueId="$leagueId"/>
  
  
	<main>
		
		
		<div class="create-player-container">
			<div class="create-player-inner-container">
				<h3>Create a new player</h3>
				<form class="create-player-form" action="{{ route('players.store', ['league'=> $league->league_id, 'team'=> $team->team_id]) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('POST')
					<!--TEAM NUMBER -->
					<div class="form-group section-form-group">
						<h3>Team Information</h3>
						<div class="form-group">
							<label for="league_id">League ID:</label>
							<input type="text"  class="form-control" name="league_id" rows="1" value={{$league->league_id}} required readonly>
						</div>
						<div class="form-group">
							<label for="league_name">League Name:</label>
							<input type="text"  class="form-control" name="league_name" rows="1" value={{$league->league_name}} required readonly>
						</div>
						<div class="form-group">
							<label for="team_id">Team ID:</label>
							<input type="text"  class="form-control" id="team_id" name="team_id" rows="1" value={{$team->team_id}} required readonly>
						</div>
						
						<div class="form-group">
							<label for="team_name">Team Name:</label>
							<input type="text"  class="form-control" id="team_name" name="team_number" rows="1" value={{$team->team_name}} required readonly>
						</div>
						<!--PLAYER NAME -->
						<div class="form-group">
							<label for="player_name">Player Name:
								<span class="required">*</span>
							</label>
							<input type="text" class="form-control" name="player_name" rows="1" required>
						</div>
						<div class="form-group">
							<label for="player_surname_1">Player 1st Surname:
								<span class="required">*</span>
							</label>
							<input type="text" class="form-control" name="player_surname_1" rows="1" required>
						</div>
						<div class="form-group">
							<label for="player_surname_2">Player 2nd Surname:</label>
							<input type="text" class="form-control" name="player_surname_2" rows="1">
						</div>
						
						<div class="form-group">
							<label for="host_team_id">Player Sex:</label>
							@php
							echo html()->select('player_sex', $sexs_list, null);
							@endphp
						</div>
						
						
						<div class="form-group">
							<label for="player_number">Player Number:</label>
							<input type="number" class="form-control" name="player_number" rows="1">
						</div>
						
						<div class="form-group">
							<label for="player_birth_date">Player Birth Date:
								<span class="required">*</span>
							</label>
							<input type="date"  class="form-control" name="player_birth_date" required>
						</div>
						
						<div class="form-group">
							<label for="player_country">Player Origin Country:</label>
							<input type="text" class="form-control" name="player_country" rows="1" >
						</div>
						
						<div class="form-group">
							<label for="player_height">Player Height:</label>
							<input type="number" step="0.01"  class="form-control" name="player_height" rows="1">
						</div>
						<div class="form-group">
							<label for="player_weight">Player Weight:</label>
							<input type="number" step="0.01"  class="form-control" name="player_weight" rows="1" >
						</div>
						
						
						
						<!--Player IMAGE -->
						<div class="form-group">
							<label for="player_img">Player Image:</label>
							<input  class="form-control" type="file" id="team_img" name="player_img" accept="image/png, image/jpeg, image/svg" />
						</div>
						
						<!--Player PHONE -->
						<div class="form-group">
							<label for="player_phone">Player Phone:</label>
							<input type="text" class="form-control" name="player_phone" rows="1" >
						</div>
						
						<!--Player EMAIL -->
						<div class="form-group">
							<label for="player_email">Player E-Mail:
								<span class="required">*</span>
							</label>
							<input type="email" class="form-control" name="player_email" rows="1" required>
						</div>
					
					</div>
					
					
					
					
					<div class="actions-row">
						<div class="btn-container">
							<button type="submit" class="btn-create">
								<img class="btn-img" src="{{ asset('img/create.png') }}"> 
								Create player</button>
						</div>

						<a href="{{ route('matches.index', [ 'league'=>$league->league_id ]) }}" class="btn-cancel">
						<img class="btn-img" src="{{ asset('img/cancel.png') }}"> 
						Cancel
						</a>

					</div>
					
					
					
					
				</form>
			</div>
		</div>
		
		
		
		
		
	
	</main>
	
	<x-footer/>
	
</body>
</html>

