@extends("layouts.app")

@section("content")
    <div class="league-form-container">
        <div class="league-form-inner-container">
            <h3 class="league-form-title">Edit league</h3>
            <form
                class="league-form"
                action="{{ route("leagues.update", $league->league_id) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method("PUT")

                <div class="form-group">
                    <label for="league_name">Name</label>

                    <input
                        type="text"
                        class="form-control"
                        id="league_name"
                        name="league_name"
                        rows="1"
                        value="{{ $league->league_name }}"
                        required
                    />
                </div>
                <div class="form-group-hidden">
                    <label for="league_type_id">Sport Type</label>

                    @php
                        echo html()
                            ->textarea("league_type_id", $league->league_type)
                            ->isReadOnly(true)
                            ->rows(1);
                    @endphp
                </div>
                <div class="form-group">
                    <label for="league_status">Status</label>

                    @php
                        echo html()->select("league_status", $league_status, $league->league_status);
                    @endphp
                </div>
                <div class="form-group">
                    <label for="league_img">Image</label>

                    <input
                        type="file"
                        id="league_img"
                        class="input-image"
                        name="league_img"
                        accept="image/png, image/jpeg, image/svg"
                    />
                </div>

                <div class="form-group">
                    <label for="league_channel">Channel</label>

                    <input
                        type="text"
                        id="league_img"
                        name="league_channel"
                        value="{{ $league->league_channel }}"
                    />
                </div>

                <div class="form-group">
                    <label for="league_official_web">Official website</label>

                    <input
                        type="text"
                        id="league_official_web"
                        name="league_official_web"
                        value="{{ $league->league_official_web }}"
                    />
                </div>

                <div class="form-group">
                    <label for="league_description">Description</label>

                    <textarea
                        type="text"
                        id="league_description"
                        name="league_description"
                        rows="4"
                        cols="15"
                    >
{{ $league->league_description }}
                        </textarea
                    >
                </div>

                <div class="form-group">
                    <label for="league_starting_date">Starting date</label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        id="league_starting_date"
                        name="league_starting_date"
                        value="{{ $league->league_starting_date }}"
                        required
                    />
                </div>

                <div class="form-group">
                    <label for="league_finalization_date">
                        Finalization date
                    </label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        id="league_finalization_date"
                        name="league_finalization_date"
                        value="{{ $league->league_finalization_date }}"
                        required
                    />
                </div>

                @if ($errors->any())
                    <div class="form-validation-errors">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach  
                    </div>
                @endif

                <div class="actions-row">
                    <button type="submit" class="btn-create">Save</button>

                    <a href="{{ route("leagues.index") }}" class="btn-cancel">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
