

@vite('resources/css/comp_ranking.css')
<div class="ranking-table-section">
    <!-- Results Table For Beach Volley -->
    
    
    
    
    
    <div class="ranking-table-title">
		Beach Volleyball Ranking
	</div>
			
	<!-- MATCHES TABLE BY WEEK -->
	@if (isset($teams))
		<table class="ranking-table" border="1">
			<tr class="ranking-table-header-row" >
				<th>Raanking <br> Position</th>
				<th>Team <br> Logo</th>
				<th>Team <br> Name</th>
				<th>Points</th>
				<th>Games <br> Played</th>
				<th>G3</th>
				<th>G2</th>
				<th>P1</th>
				<th>P0</th>
				<th>PG</th>
				<th>SF</th>
				<th>SC</th>
				<th>PF</th>
				<th>PC</th>
				<th>Sanc</th> <!-- 15 rows -->
			</tr>
		@foreach ($teams as $team)
			
			<tr class="ranking-table-row" >
				

				
				<th>{{ $team->ranking_position ?? ""}}</th>
				<th>
					<img class="ranking-team-img" src="{{ asset('storage/'.$team->team_img_name)}}" alt="Team Logo Image">
				</th>
				<th>{{ $team->team_name ?? ""}}</th>
				
				
				<th>{{ $team->ranking_points ?? ""}}</th>
				<th>{{ $team->ranking_games_played ?? ""}}</th>
				
				<th>{{ $team->ranking_g3 ?? ""}}</th>
				<th>{{ $team->ranking_g2 ?? ""}}</th>
				<th>{{ $team->ranking_p1 ?? ""}}</th>
				<th>{{ $team->ranking_p0 ?? ""}}</th>
				<th>{{ $team->ranking_pg ?? ""}}</th>
				<th>{{ $team->ranking_sf ?? ""}}</th>
				<th>{{ $team->ranking_sc ?? ""}}</th>
				<th>{{ $team->ranking_pf ?? ""}}</th>
				<th>{{ $team->ranking_pc ?? ""}}</th>
				<th>{{ $team->ranking_sanc ?? ""}}</th> <!-- 15 rows -->
				
			
			</tr>		
			

			
		@endforeach	
		
		</table>
	@endif
    
</div>
