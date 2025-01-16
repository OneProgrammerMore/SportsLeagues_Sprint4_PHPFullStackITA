<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CupApp</title>
	@vite('resources/css/app.css')
	<link rel="stylesheet" href="{{ asset('css/iconStyles.css') }}">
</head>



<body>

	@php
		$leagueId = $league->league_id;
	@endphp
	<x-web.header :leagueId="$leagueId"/>
  
  
	<main>
		
		<div class="match-main-container">
			<form class="match-edit-form" action="{{ route('matches.update',  ['league'=> $league->league_id, 'match' => $match->match_id ]) }}" method="post" enctype="multipart/form-data">
				
				<h3>Modify Match:</h3>
				@csrf
				@method('PUT')
				
				<div class="form-group-hidden">
					<label for="league_id">League ID:</label>
					<input type="text"  class="form-control" id="league_id" name="league_id" rows="1" value={{$league->league_id}} required>
					<label for="match_id">Match ID:</label>
					<input type="text"  class="form-control" id="match_id" name="match_id" rows="1" value={{$match->match_id}} required>
					
				
				</div>
				
				
				<div class="form-group-match section-form-group-match">
				
					<div class="match-number-container">
						<label for="match_number">Match Number:</label>
						<input type="text"  class="form-control" id="match_number" name="match_number" rows="1" value={{$match->match_number}} readonly required>
					</div>
					
					<div class="match-number-container">
						<label for="week_number">Week number:</label>
						<input type="number"  class="form-control" id="week_number" name="week_number" value="{{ $match->week_number }}" required>
					</div>
					
					<div class="match-teams-names">
						<div class="match-team-name">
							<label for="host_team_id">Host Team:</label><br>
							@php
							echo html()->select('host_team_id', $teams_list, $select_host_value);
							@endphp
						
							
						</div>
						<div class="match-team-name-vs">
						VS
						</div>
						<div class="match-team-name">
							<label for="guest_team_id">Guest Team:</label><br>
								@php
								echo html()->select('guest_team_id', $teams_list, $select_guest_value);
								@endphp
						</div>
					</div>
					
					<div class="container-match-date">
						<label class="match_date" for="match_date">Match Date:</label>
						<input type="datetime-local"  class="form-control" id="match_date" name="match_date" value="{{$match->match_date}}" required>
					</div>
					
					<div class="container-match-info">
						<div class="container-team-logo">
							<img class="team-img-match" src="{{ asset('storage/public/'.$host_team->team_img_name)}}" alt="Host Team Image">
						</div>
						
						
						<div class="container-match-results">
							<div class="container-match-points">
								<h3>
									<label for="host_points">Host Points: (Optional)</label><br>
									<input type="number"  class="form-control" id="host_points" name="host_points" value="{{ $match->host_points }}">
								</h3>
								<h3>
									:
								</h3>
								<h3>	
									<label for="guest_points">Guest Points: (Optional)</label><br>
									<input type="number"  class="form-control" id="guest_points" name="guest_points" value="{{ $match->guest_points }}">
								</h3>
							</div>
								
							<div class="contaier-match-status">
								<h3>
									<label for="match_status">Match Status:</label><br>
									@php
									echo html()->select('match_status', $match_status_list, null);
									@endphp
								</h3>
								
							</div>
						</div>
						
						<div class="container-team-logo">
							<img class="team-img-match" src="{{ asset('storage/public/'.$guest_team->team_img_name)}}" alt="Host Team Image">
						</div>
						
						
					
					</div>
				</div>
				
				<!-- MATCH ADDRESS FORM: -->
				<!--MATCH  ADDRESS-->
				<div class="form-group section-form-group">
					<h3>Match Address:</h3>
					<label for="match_address_country">Country:</label>
					<input type="text"  class="form-control" id="match_address_country" name="match_address_country" rows="1" value="{{$match_address->country ?? "" }}"  >
					
					<label for="match_address_postalcode">Postal Code:</label>
					<input type="text"  class="form-control" id="match_address_postalcode" name="match_address_postalcode" rows="1" value="{{$match_address->postalcode ?? ""}}"  >
					
					<label for="match_address_city">City:</label>
					<input type="text"  class="form-control" id="match_address_city" name="match_address_city" rows="1" value="{{$match_address->city ?? ""}}" >
					
					
					<label for="match_address_street">Street:</label>
					<input type="text"  class="form-control" id="match_address_street" name="match_address_street" rows="1" value="{{$match_address->street ?? ""}}" >
					
					<label for="match_address_number">Street Number:</label>
					<input type="text"  class="form-control" id="match_address_number" name="match_address_number" rows="1" value="{{$match_address->number ?? ""}}">
					
					<label for="match_address_floor">Floor:</label>
					<input type="text" class="form-control" id="match_address_floor" name="match_address_floor" rows="1" value="{{$match_address->floor ?? ""}}">
					
					<label for="match_address_door">Door:</label>
					<input type="text" class="form-control" id="match_address_door" name="match_address_door" rows="1"  value="{{$match_address->door ?? ""}}">
				</div>
				
				@php 
					$matchId = $match->match_id;
				@endphp
				
				@if(isset($league_type) and $league_type == "Beach Volleyball")
					<x-formsResults.beachVolleyball :matchId="$matchId" />
					<x-legends.beachVolleyballLegend/>
				@endif	
					
				<div class="actions-row">
					<div class="btn-container">
					<button type="submit" class="btn-create">
						<span class="icon icon-league-link icon-cancel"></span>
						Modify Match</button>
					</div>
					

					<a href="{{ route('matches.index', [ 'league'=>$league->league_id ]) }}" class="btn-cancel">
						<span class="icon icon-league-link icon-cancel"></span>
					Cancel
					</a>

				</div>
				
				
			</form>
			 
			
		</div>

	</main>
	
	<x-footer/>
	
</body>


</html>
