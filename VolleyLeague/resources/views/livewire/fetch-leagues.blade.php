<div id="leagues-container">
    <div id="leagues-inner-container">
        @foreach ($posts as $league)
            <div class="league-container" :key="$league['league_id']">
                <div class="league-info">
                    <div class="league-img">
                        <img
                            class="league-imgs-index"
                            src="{{ asset($league->league_img_name ? "storage/" . $league->league_img_name : "img/league.png") }}"
                            alt="Web Logo - The image of a Tournament Cup"
                        />
                    </div>
                    <div class="league-data">
                        <h3 class="league-name">
                            {{ $league->league_name ?? "" }}
                        </h3>
                        <h3 class="league-status">
                            {{ $league->league_status ?? "" }}
                        </h3>
                        <h3 class="league-type">
                            [ {{ $league->league_type ?? "" }} ]
                        </h3>
                        <h3 class="league-date">
                            <h2 class="title-bold">Starting on:</h2>
                            {{ $league->league_starting_date ?? "" }}
                        </h3>
                        <h3 class="league-date">
                            <h2 class="title-bold">Finishig on:</h2>
                            {{ $league->league_starting_date ?? "" }}
                        </h3>
                        <h3 class="league-admin"></h3>
                    </div>
                </div>

                <div class="league-interactions-all">
                    <div class="league-links">
                        <div class="league-matches-link league-link">
                            <a
                                class="link-info"
                                href="{{ route("matches.index", $league->league_id) }}"
                            >
                                <img
                                    class="btn-img"
                                    src="{{ asset("img/match.png") }}"
                                />
                                Matches...
                            </a>
                        </div>

                        <div class="league-teams-link league-link">
                            <a
                                class="link-info"
                                href="{{ route("teams.index", $league->league_id) }}"
                            >
                                <img
                                    class="btn-img"
                                    src="{{ asset("img/teams.png") }}"
                                />
                                Teams...
                            </a>
                        </div>

                        <div class="league-info-link league-link">
                            <a
                                class="link-info"
                                href="{{ route("leagues.show", $league->league_id) }}"
                            >
                                <img
                                    class="btn-img"
                                    src="{{ asset("img/info.png") }}"
                                />
                                More Info...
                            </a>
                        </div>
                    </div>

                    <div class="form-actions">
                        <form
                            action="{{ route("leagues.edit", $league->league_id) }}"
                            method="post"
                        >
                            @csrf
                            @method("GET")
                            <button type="submit" class="btn-edit">
                                <img
                                    class="btn-img"
                                    src="{{ asset("img/edit.png") }}"
                                />
                                Edit
                            </button>
                        </form>

                        <form
                            action="{{ route("leagues.destroy", $league->league_id) }}"
                            method="post"
                        >
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn-delete">
                                <img
                                    class="btn-img"
                                    src="{{ asset("img/delete.png") }}"
                                />
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($hasMorePages)
        <div
            x-data="{
            init() {
                console.log('Inside Init');
                let observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            @this.call('loadLeagues')
                        }
                    })
                }, {
                    root: null
                });
                observer.observe(this.$el);
            }
        }"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-4"
        >
            @foreach (range(1, 4) as $x)
                @include("partials.skeleton")
            @endforeach
        </div>
    @endif
</div>
