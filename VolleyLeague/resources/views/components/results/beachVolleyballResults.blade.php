

@vite('resources/css/comp_results_table.css')
<div class="results-table-section">
    <!-- Results Table For Beach Volley -->
    
    
    
    
    
    <div class="results-table-title">
		Beach Volleyball Matches Results
	</div>
			
	<!-- MATCHES TABLE BY WEEK -->
	@if (isset($match_results))
		<table class="results-table" border="1">
			<tr class="results-table-header-row" >
				<th>Match <br> Number</th>
				<th>Host <br> Team</th>
				<th>vs</th>
				<th>Guest <br> Team</th>
				<th>Date <br>  And <br>  Time</th>
				<th>Matches <br>  Won</th>
				<th>Matches <br>  Lost</th>
				<th>Sets <br>  Won</th>
				<th>Sets <br>  Lost</th>
				<th>Points <br>  Won</th>
				<th>Points <br> Lost</th>
				<th>Info</th>
				<th>Edit</th> <!-- 12 columns -->
			</tr>
		@foreach ($match_results as $result)

			<tr class="results-table-row" >
				<td>{{ $result->match_number ?? ""}}</td>
				<td class="team-name-table-data"> 
					<img class="results-team-img" src="{{ asset('storage/'.$result->host_img)}}" alt="Host Team Image">
					{{ $result->host_team_name ?? ""}}</td>
				<td>vs</td>
				<td class="team-name-table-data">
					<img class="results-team-img" src="{{ asset('storage/'.$result->guest_img)}}" alt="Guest Team Image">
					{{ $result->guest_team_name ?? ""}}</td>
				
				<td>{{ $result->only_date ?? ""}} <br> {{ $result->only_time ?? ""}}</td>
				
				<td>{{ $result->matches_won ?? ""}}</td>
				<td>{{ $result->matches_lost ?? ""}}</td>
				<td>{{ $result->sets_won ?? ""}}</td>
				<td>{{ $result->sets_lost ?? ""}}</td>
				<td>{{ $result->points_won ?? ""}}</td>
				<td>{{ $result->points_lost ?? ""}}</td>
				
				<td>
					<a href="{{ route('matches.show', ['league'=> $result->league_id, 'match' =>$result->match_id ]) }}">
					<i class="results-team-img-container">
						<img class="results-actions-icon-img" src="{{ asset('img/eye_info.png')}}" alt="More Info About The Match">
					</i>
					</a>
				</td>
				
				<td>
					<a href="{{ route('matches.edit', ['league'=> $result->league_id, 'match' =>$result->match_id ]) }}">
					<i class="results-team-img-container">
						<img class="results-actions-icon-img" src="{{ asset('img/edit.png')}}" alt="Edit About The Match">
					</i>
					</a>
				</td>
				
				
				
				
				
				
				
				
				
				
			</tr>
			
		@endforeach	
		
		</table>
	@endif
    
</div>
