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
</head>



<body>

	@php
		$leagueId = $league->league_id;
	@endphp
	<x-web.header :leagueId="$leagueId"/>
  
  
	<main>
		
		
		<div class="edit-league-container">
			<div class="edit-league-inner-container">
				<h3>Update league</h3>
				<form  class="edit-league-form" action="{{ route('leagues.update', $league->league_id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for="league_type_id">League Type:</label>
						<br>
						@php
							echo html()->textarea('league_type', $league->league_type)->isReadOnly(True)->rows(1);
						@endphp
					</div>
					<div class="form-group">
						<label for="league_name">League Name:</label><br>
						<textarea class="form-control" id="league_name" name="league_name" rows="1" value="{{$league->league_name}}" required>{{ $league->league_name }}</textarea>
					</div>
					<div class="form-group">
						<label for="league_status">League Status:</label><br>
						@php
						echo html()->select('league_status', $league_status, $league->league_status);
						@endphp
					</div>
					<div class="form-group">
						<label for="league_img">League Image:</label><br>
						<input type="file" id="league_img" name="league_img" accept="image/png, image/jpeg, image/svg" />
					</div>
					
					
					
					<div class="form-group">
						<label for="league_channel">League Channel:</label><br>
						<input type="text" id="league_img" name="league_channel"  value="{{ $league->league_channel }}" />
					</div>
					
					<div class="form-group">
						<label for="league_official_web">League Official/External Web:</label><br>
						<input type="text" id="league_official_web" name="league_official_web" value="{{ $league->league_official_web}}" />
					</div>
					
					<div class="form-group">
						<label for="league_description">League Description:</label><br>
						<textarea type="text" id="league_description" name="league_description" rows="4" cols="15" />{{ $league->league_description }}</textarea>
					</div>
					
					<div class="form-group">
						<label for="league_starting_date">League Starting Date:</label>
						<input type="datetime-local"  class="form-control" id="league_starting_date" name="league_starting_date" value="{{ $league->league_starting_date }}" required>
					</div>
						
					<div class="form-group">
						<label for="league_finalization_date">League Finalization Date:</label>
						<input type="datetime-local"  class="form-control" id="league_finalization_date" name="league_finalization_date"  value="{{ $league->league_finalization_date }}" required>
					</div>
					
					
					<div class="actions-row">
						<div class="btn-container">
						<button type="submit" class="btn-create">Modify League</button>
						</div>
						

						<a href="{{ route('leagues.index') }}" class="btn-cancel">
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

