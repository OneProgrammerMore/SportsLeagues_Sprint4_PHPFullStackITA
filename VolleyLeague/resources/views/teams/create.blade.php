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
		$leagueId = ( $league->league_id ?? null);
	@endphp
	<x-web.header :leagueId="$leagueId"/>
  
  
	<main>
		
		
		<div class="create-league-container">
			<div class="create-league-inner-container">
				<h3>Create a new team</h3>
				<form class="create-league-form" action="{{ route('teams.store', $league->league_id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('POST')
					<!--TEAM NUMBER -->
					<div class="form-group section-form-group">
						<h3>Team Information</h3>
						<div class="form-group-hidden">
							<label for="league_id">League ID:</label>
							<input type="text"  class="form-control" id="league_id" name="league_id" rows="1" value={{$league->league_id}} required>
						</div>
						<div class="form-group">
							<label for="team_number">Team Number:</label>
							<input type="text"  class="form-control" id="team_number" name="team_number" rows="1" value={{$next_team_number}} required>
						</div>
						<!--TEAM NAME -->
						<div class="form-group">
							<label for="team_name">Team Name:
								<span class="required">*</span>
							</label>
							<textarea class="form-control" id="team_name" name="team_name" rows="1" required></textarea>
						</div>
						<!--TEAM IMAGE -->
						<div class="form-group">
							<label for="team_img">Team Image:</label>
							<input  class="form-control" type="file" id="team_img" name="team_img" accept="image/png, image/jpeg, image/svg" />
						</div>
						
						<!--TEAM PHONE -->
						<div class="form-group">
							<label for="team_phone">Team Phone:
								<span class="required">*</span>
							</label>
							<input type="text" class="form-control" id="team_phone" name="team_phone" rows="1" required>
						</div>
						
						<!--TEAM EMAIL -->
						<div class="form-group">
							<label for="team_email">Team E-Mail:
								<span class="required">*</span>
							</label>
							<input type="email" class="form-control" id="team_email" name="team_email" rows="1" required>
						</div>
					
					</div>
					
					
					<!--TEAM ADDRESS -->
					<div class="form-group section-form-group">
						<h3>Team Address</h3>
						
						<div class="form-group">
						<label for="team_address_country">Country:</label>
						<input type="text"  class="form-control" id="team_address_country" name="team_address_country" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_address_postalcode">Postal Code:</label>
						<input type="text"  class="form-control" id="team_address_postalcode" name="team_address_postalcode" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_address_city">City:</label>
						<input type="text"  class="form-control" id="team_address_city" name="team_address_city" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_address_street">Street:</label>
						<input type="text"  class="form-control" id="team_address_street" name="team_address_street" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_address_number">Street Number:</label>
						<input type="text"  class="form-control" id="team_address_number" name="team_address_number" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_address_floor">Building Floor:</label>
						<input type="text" class="form-control" id="team_address_floor" name="team_address_floor" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_address_door">Building Door:</label>
						<input type="text" class="form-control" id="team_address_door" name="team_address_door" rows="1" >
						</div>
						
					</div>

					
					
					<!--TEAM RESPONSIBLE -->
					<div class="form-group section-form-group">
						<h3>Team Responsible</h3>
						
						<div class="form-group">
						<label for="team_responsible_name">Team Responsible Name:</label>
						<input type="text"  class="form-control" id="team_responsible_name" name="team_responsible_name" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_surname_1">Team Responsible 1st Surname:</label>
						<input type="text"  class="form-control" id="team_responsible_surname_1" name="team_responsible_surname_1" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_surname_2">Team Responsible 2nd Surname:</label>
						<input type="text"  class="form-control" id="team_responsible_surname_2" name="team_responsible_surname_2" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_email">Team Responsible E-Mail:</label>
						<input type="email" class="form-control" id="team_responsible_email" name="team_responsible_email" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_phone">Team Responsible Phone:</label>
						<input type="text" class="form-control" id="team_responsible_phone" name="team_responsible_phone" rows="1" >
						</div>
					</div>
					
					
					<!--TEAM RESPONSIBLE ADDRESS-->
					<div class="form-group section-form-group">
						<h3>Team Responsible Address:</h3>
						
						<div class="form-group">
						<label for="team_responsible_address_country">Team Responsible Country:</label>
						<input type="text"  class="form-control" id="team_responsible_address_country" name="team_responsible_address_country" rows="1"  >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_address_postalcode">Team Responsible Postal Code:</label>
						<input type="text"  class="form-control" id="team_responsible_address_postalcode" name="team_responsible_address_postalcode" rows="1"  >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_address_city">Team Responsible City:</label>
						<input type="text"  class="form-control" id="team_responsible_address_city" name="team_responsible_address_city" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_address_street">Team Responsible Street:</label>
						<input type="text"  class="form-control" id="team_responsible_address_street" name="team_responsible_address_street" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_address_number">Team Responsible Number:</label>
						<input type="text"  class="form-control" id="team_responsible_address_number" name="team_responsible_address_number" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_address_floor">Team Responsible Floor:</label>
						<input type="text" class="form-control" id="team_responsible_address_floor" name="team_responsible_address_floor" rows="1" >
						</div>
						
						<div class="form-group">
						<label for="team_responsible_address_door">Team Responsible Door:</label>
						<input type="text" class="form-control" id="team_responsible_address_door" name="team_responsible_address_door" rows="1" >
						</div>
					
					</div>
					
					
					
					<div class="actions-row">
						<div class="btn-container">
							<button type="submit" class="btn-create">
								<span class="icon icon-league-link icon-create"></span> 
								Create team</button>
						</div>

						<a href="{{ route('matches.index', [ 'league'=>$league->league_id ]) }}" class="btn-cancel">
							<span class="icon icon-league-link icon-cancel"></span> 
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

