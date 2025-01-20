<div class="results-table-section">
    <!-- Results Table For Beach Volley -->

    <div class="results-table-title">Beach Volleyball Matches Results</div>

    <!-- MATCHES TABLE BY WEEK -->
    @if (isset($match_results))
        <table class="results-table" border="1">
            <tr class="results-table-header-row">
                <th>Nº</th>
                <th>H.</th>
                <th>vs</th>
                <th>G.</th>
                <th>Date</th>
                <th>M. W.</th>
                <th>M. L.</th>
                <th>
                    Sets
                    <br />
                    W.
                </th>
                <th>
                    Sets
                    <br />
                    L.
                </th>
                <th>
                    P.
                    <br />
                    W.
                </th>
                <th>
                    P.
                    <br />
                    L.
                </th>
                <th></th>
                <th></th>
                <!-- 12 columns -->
            </tr>
            @foreach ($match_results as $result)
                <tr class="results-table-row">
                    <td>{{ $result->match_number ?? "" }}</td>
                    <td class="team-name-table-data">
                        <img
                            class="results-team-img"
                            src="{{ asset("storage/public/" . $result->host_img) }}"
                            alt="Host Team Image"
                        />
                        <p>{{ $result->host_team_name ?? "" }}</p>
                    </td>
                    <td>vs</td>
                    <td class="team-name-table-data">
                        <img
                            class="results-team-img"
                            src="{{ asset("storage/public/" . $result->guest_img) }}"
                            alt="Guest Team Image"
                        />
                        <p>{{ $result->guest_team_name ?? "" }}</p>
                    </td>

                    <td>
                        {{ $result->only_date ?? "" }}
                        <br />
                        {{ $result->only_time ?? "" }}
                    </td>

                    <td>{{ $result->matches_won ?? "" }}</td>
                    <td>{{ $result->matches_lost ?? "" }}</td>
                    <td>{{ $result->sets_won ?? "" }}</td>
                    <td>{{ $result->sets_lost ?? "" }}</td>
                    <td>{{ $result->points_won ?? "" }}</td>
                    <td>{{ $result->points_lost ?? "" }}</td>

                    <td>
                        <a
                            href="{{ route("matches.show", ["league" => $result->league_id, "match" => $result->match_id]) }}"
                        >
                            <i class="results-team-img-container">
                                <span
                                    class="icon icon-league-link icon-info"
                                ></span>
                            </i>
                        </a>
                    </td>

                    <td>
                        <a
                            href="{{ route("matches.edit", ["league" => $result->league_id, "match" => $result->match_id]) }}"
                        >
                            <i class="results-team-img-container">
                                <span
                                    class="icon icon-league-link icon-pencil"
                                ></span>
                            </i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
