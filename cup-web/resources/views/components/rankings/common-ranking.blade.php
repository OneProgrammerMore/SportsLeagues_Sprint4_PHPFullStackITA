<div class="ranking-table-section">
    <!-- Results Table For Beach Volley -->

    <div class="ranking-table-title card section-header">
        Ranking
    </div>

    <!-- MATCHES TABLE BY WEEK -->
    @if (isset($teams) && count($teams)>0)
        <div class="ranking-table-container card">
        <table class="ranking-table" border="1">
            <tr class="ranking-table-header-row">
                <th>Nº</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Pts</th>
                <th>Nº Games</th>
                <th>Wins</th>
                <th>Loses</th>
                <th>Draws</th>
                <th>P.F.</th>
                <th>P.A.</th>
            </tr>
            @foreach ($teams as $team)
                <tr class="ranking-table-row">
                    <td>{{ $team->ranking_position ?? "" }}</td>
                    <td>
                        <img
                            class="ranking-team-img"
                            src="{{ asset( ! empty($team->team_img_name) ? "storage/" . $team->team_img_name : Vite::asset("resources/img/team.png")) }}"
                            alt="Team Logo Image"
                        />
                    </td>
                    <td>{{ $team->team_name ?? "" }}</td>

                    <td>{{ $team->ranking_points ?? "" }}</td>
                    <td>{{ $team->ranking_games_played ?? "" }}</td>

                    <td>{{ $team->wins ?? "" }}</td>
                    <td>{{ $team->loses ?? "" }}</td>
                    <td>{{ $team->draws ?? "" }}</td>
                    <td>{{ $team->points_favour ?? "" }}</td>
                    <td>{{ $team->points_against ?? "" }}</td>
                </tr>
            @endforeach
        </table>
        </div>
    @else
    <div class="creator-normal-card">
        No ranking to show... try creating some matches.
    </div>
    @endif
</div>
