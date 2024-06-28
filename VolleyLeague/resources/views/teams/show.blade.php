<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href={{ URL::asset('css/app.css') }} rel="stylesheet" >
	<title>CupApp</title>
	@vite('resources/css/app.css')
</head>



<body>

	@php
		$leagueId = $league->league_id;
	@endphp
	<x-web.header :leagueId="$leagueId"/>
  
  
	<main>
		<!-- INFORMATION IN leagues/{league} -->
		<!-- League Info -->
		<!-- League Classification -->
		<!-- League Results -->
		<!-- League Next Matches -->
		
		<div class="team-info-container">
			<div class="team-main-container">
					<div class="team-info-name">
						<div class="team-img">
							<img id="webLogoImg" src="{{ asset( $team->team_img_name ? 'storage/'.$team->team_img_name : 'img/team.png' )}}" alt="Image of the team">
						</div>
						<h3 class="team-name">{{ $team->team_name }}</h3>
					</div>
					
					
					<div class="team-info-main">
						<div class="team-data">
							<h3 class="title-section">Team information:</h3>
							
							<h3 class="team-phone">{{ $team->team_phone }}</h3>
							<h3 class="team-email">{{ $team->team_email }}</h3>
							
							<h3 class="title-section">Address:</h3>
							<h3 class="team-address">
								
								{{$team_address->street ?? ""}} {{$team_address->number ?? ""}} <br>
								{{$team_address->floor ? $team_address->floor . " Floor" :""}}  {{$team_address->door ?  $team_address->door  . " Door": ""}} <br>
								{{$team_address->city ?? ""}} {{$team_address->postalcode ?? ""}} <br>
								{{$team_address->country ?? ""}}
							</h3>
							
						</div>
					</div>
					
					
					<div class="team-responsible-info team-info-main">
						<div class="team-data">
							<h3 class="title-section">Team Responsible:</h3>
							<h3 class="team-responsible-name">{{ $team_responsible->person_surname_1 ?? ""  }}  {{ $team_responsible->person_surname_2 ?? ""  }} {{ $team_responsible->person_name ?? "" }}</h3>
							<h3 class="team-responsible-mail">{{ $team_responsible->person_email  ?? "" }}</h3>
							<h3 class="team-responsible-mail">{{ $team_responsible->person_phone  ?? "" }}</h3>
							
							<h3 class="title-section">Address:</h3>
							<h3 class="team-responsible-address">
								{{$team_responsible_address->street ?? ""}} {{$team_responsible_address->number ?? ""}} <br>
								{{$team_responsible_address->floor ? $team_responsible_address->floor . " Floor" :""}}  {{$team_responsible_address->door ?  $team_responsible_address->door  . " Door": ""}} <br>
								{{$team_responsible_address->city ?? ""}} {{$team_responsible_address->postalcode ?? ""}} <br>
								{{$team_responsible_address->country ?? ""}}
							</h3>
						</div>
					</div>
					
					
					<div class="team-actions">
						
						<form action="{{ route('teams.edit', ['league' => $league->league_id, 'team'=> $team->team_id]) }}" method="post">
							@csrf
							@method('GET')
							<button type="submit" class="btn-edit">Edit</button>
						</form>
						
						
						<form action="{{ route('teams.destroy', ['league' => $league->league_id, 'team'=> $team->team_id]) }}" method="post">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn-delete">Delete</button>
						</form>
					
					</div>
				</div>
		</div>
		
		
		<!-- League Classification -->
		<!-- League Results -->
		<!-- League Next Matches -->
		
		<!-- Teams Minimal Info Show With Component -->
		@php
			$leagueId = $league->league_id;
			$teamId = $team->team_id;
		@endphp
		<x-players.showPlayersMinInfo :leagueId="$leagueId" :teamId="$teamId" />
		
		
		
		@if (count($players) == 0)
		<!-- Empty State team Creation: -->
		<div class="creator-empty-state">
			<h2>
				There are not players to show. <br>
				Try creating a new player!
			</h2>
			<a class="btn-create" href="{{ route('players.create', ['league' => $league->league_id, 'team' => $team->team_id] ) }}">
			<img class="btn-img" src="{{ asset('img/create.png') }}"> 
			Create PLayer</a>
		</div>

		@else
		<!-- Normal Creation Div -->
		
		<div class="creator-normal">
			<h2>
				In order to create another player click the button!
			</h2>
				<a class="btn-create" href="{{ route('players.create', ['league' => $league->league_id, 'team' => $team->team_id] ) }}">
				<img class="btn-img" src="{{ asset('img/create.png') }}"> 
				Create player</a>
		</div>
		
		
		
		@endif
	
		
	</main>
	
	<x-footer/>
	
</body>


</html>
