@extends("layouts.app")

@section("content")
    <main>
        <div class="create-league-container">
            <div class="create-league-inner-container">
                <h3>Create a new league</h3>
                <form
                    class="create-league-form"
                    action="{{ route("leagues.store") }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="form-group section-form-group">
                        <div class="form-group">
                            <label for="league_type_id">League Type:</label>
                            <br />

                            @php
                                echo html()->select("league_type_id", $league_types, null);
                            @endphp
                        </div>
                        <div class="form-group">
                            <label for="league_name">
                                League Name:
                                <span class="required">*</span>
                            </label>
                            <br />
                            <textarea
                                class="form-control"
                                id="league_name"
                                name="league_name"
                                rows="1"
                                required
                            ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="league_status">League Status:</label>
                            <br />
                            @php
                                echo html()->select("league_status", $league_status, null);
                            @endphp
                        </div>

                        <div class="form-group">
                            <label for="league_img">League Image:</label>
                            <br />
                            <input
                                type="file"
                                id="league_img"
                                class="input-image"
                                name="league_img"
                                accept="image/png, image/jpeg, image/svg"
                            />
                        </div>

                        <div class="form-group">
                            <label for="league_channel">League Channel:</label>
                            <br />
                            <input
                                type="text"
                                id="league_img"
                                name="league_channel"
                            />
                        </div>

                        <div class="form-group">
                            <label for="league_official_web">
                                League Official/External Web:
                            </label>
                            <br />
                            <input
                                type="text"
                                id="league_official_web"
                                name="league_official_web"
                            />
                        </div>

                        <div class="form-group">
                            <label for="league_description">
                                League Description:
                            </label>
                            <br />
                            <textarea
                                type="text"
                                id="league_description"
                                name="league_description"
                                rows="4"
                                cols="15"
                            ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="league_starting_date">
                                League Starting Date:
                                <span class="required">*</span>
                            </label>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="league_starting_date"
                                name="league_starting_date"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label for="league_finalization_date">
                                League Finalization Date:
                                <span class="required">*</span>
                            </label>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="league_finalization_date"
                                name="league_finalization_date"
                                required
                            />
                        </div>
                    </div>

                    <div class="actions-row">
                        <div class="btn-container">
                            <button type="submit" class="btn-create">
                                <span
                                    class="icon icon-league-link icon-create"
                                ></span>
                                Create
                            </button>
                        </div>

                        <a
                            href="{{ route("leagues.index") }}"
                            class="btn-cancel"
                        >
                            <span
                                class="icon icon-league-link icon-cancel"
                            ></span>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
