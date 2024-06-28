<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href={{ URL::asset('css/app.css') }} rel="stylesheet" >
	<title>CupApp</title>
	@vite('resources/css/comp_footer.css')
	@vite('resources/css/app.css')
	
	
</head>



<body>

	@php
		$leagueId = $league->league_id;
	@endphp
	<x-web.header :leagueId="$leagueId"/>
  
  
	<main>
	
	@if (count($teams)>0)
	<div id="teams-container">
		<div id="teams-inner-container">
			@foreach ($teams as $team)
				
				<div class="team-container">
					<div class="team-info">
						<div class="team-img">
							<img class="team-img" src="{{ asset( $team->team_img_name ? 'storage/'.$team->team_img_name : 'img/team.png' )}}" alt="Web Logo - The image of a Tournament Cup">
						</div>
						<div class="team-data">
							<h3 class="team-name">
								
								{{ $team->team_name }}</h3>
							<h3 class="team-email">
								<img class="team-data-img" src="{{ asset( 'img/email.png' )}}" alt="Email Icon">
								{{ $team->team_email }}</h3>
							<h3 class="team-phone"> 
								<img class="team-data-img" src="{{ asset( 'img/phone.png' )}}" alt="Email Icon">
								{{ $team->team_phone }} </h3>
								
							<h3 class="team-address"> 
								<img class="team-data-img" src="{{ asset( 'img/address.png' )}}" alt="Address Icon">
								{{$team->address_street ?? ""}} {{$team->address_number ?? ""}} <br>
								{{$team->address_floor ? $team->address_floor . " Floor" :""}}  {{$team->address_door ?  $team->address_door  . " Door": ""}} <br>
								{{$team->address_city ?? ""}} {{$team->address_postalcode ?? ""}} <br>
								{{$team->address_country ?? ""}}
								
								
								</h3>
								
								
						</div>
					
					</div>

					
					<div class="team-actions">
						
						

						<form action="{{ route('teams.show', ['league'=> $league->league_id, 'team' => $team->team_id]) }}" method="post">
							@csrf
							@method('GET')
							<button type="submit" class="btn-info">
								<img class="btn-img" src="{{ asset('img/info.png') }}"> 
								Show</button>
						</form>
						
						<form action="{{ route('teams.edit', ['league'=> $league->league_id, 'team' => $team->team_id]) }}" method="post">
							@csrf
							@method('GET')
							<button type="submit" class="btn-edit">
								<img class="btn-img" src="{{ asset('img/edit.png') }}"> 
								Edit</button>
						</form>
						
						<form action="{{ route('teams.destroy', ['league'=> $league->league_id, 'team' => $team->team_id]) }}" method="post">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn-delete">
								<img class="btn-img" src="{{ asset('img/delete.png') }}"> 
								Delete</button>
						</form>
						
						
					
					</div>
					
				
				</div>
			@endforeach
		</div>
	</div>
	@endif
	
	
	
	@if (count($teams) == 0 and $league != null)
	<!-- Empty State team Creation: -->
	<div class="creator-empty-state">
		<h2>
			There are not teams to show. <br>
			Try creating a new team!
		</h2>
		<a class="btn-create" href="{{ route('teams.create', $league->league_id) }}">
		<img class="btn-img" src="{{ asset('img/create.png') }}"> 
		Create team</a>
	</div>

	@elseif($league!=null)
	<!-- Normal Creation Div -->
	
	<div class="creator-normal">
		<h2>
			In order to create another team click the button!
		</h2>
			<a class="btn-create" href="{{ route('teams.create', $league->league_id) }}">
			<img class="btn-img" src="{{ asset('img/create.png') }}"> 
			Create team</a>
	</div>
	
	
	
	@endif
	
  
  
  </main>
  
  
  <x-footer/>
  
  
  
</body>


</html>
