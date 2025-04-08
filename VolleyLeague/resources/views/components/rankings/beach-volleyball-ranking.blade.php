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
                <th>G3</th>
                <th>G2</th>
                <th>P1</th>
                <th>P0</th>
                <th>PG</th>
                <th>SF</th>
                <th>SC</th>
                <th>PF</th>
                <th>PC</th>
                <th>Sanc</th>
                <!-- 15 rows -->
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

                    <td>{{ $team->ranking_g3 ?? "" }}</td>
                    <td>{{ $team->ranking_g2 ?? "" }}</td>
                    <td>{{ $team->ranking_p1 ?? "" }}</td>
                    <td>{{ $team->ranking_p0 ?? "" }}</td>
                    <td>{{ $team->ranking_pg ?? "" }}</td>
                    <td>{{ $team->ranking_sf ?? "" }}</td>
                    <td>{{ $team->ranking_sc ?? "" }}</td>
                    <td>{{ $team->ranking_pf ?? "" }}</td>
                    <td>{{ $team->ranking_pc ?? "" }}</td>
                    <td>{{ $team->ranking_sanc ?? "" }}</td>
                    <!-- 15 rows -->
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
