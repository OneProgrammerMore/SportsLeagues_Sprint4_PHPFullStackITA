@extends("layouts.app")

@section("content")
    <div class="league-form-container">
        <div class="league-form-inner-container">
            <h3 class="league-form-title">Create a new league</h3>
            <form
                class="league-form"
                action="{{ route("leagues.store") }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="form-group">
                    <label for="league_type_id">League Type:</label>

                    @php
                        echo html()->select("league_type_id", $league_types, null);
                    @endphp
                </div>
                <div class="form-group">
                    <label for="league_name">
                        <span class="required">*</span>
                        League Name:
                    </label>

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

                    @php
                        echo html()->select("league_status", $league_status, null);
                    @endphp
                </div>

                <div class="form-group">
                    <label for="league_img">League Image:</label>

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

                    <input type="text" id="league_img" name="league_channel" />
                </div>

                <div class="form-group">
                    <label for="league_official_web">
                        League Official/External Web:
                    </label>

                    <input
                        type="text"
                        id="league_official_web"
                        name="league_official_web"
                    />
                </div>

                <div class="form-group">
                    <label for="league_description">League Description:</label>

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
                        <span class="required">*</span>
                        League Starting Date:
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
                        <span class="required">*</span>
                        League Finalization Date:
                    </label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        id="league_finalization_date"
                        name="league_finalization_date"
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
                    <div class="btn-container">
                        <button type="submit" class="btn-create">Create</button>
                    </div>

                    <a href="{{ route("leagues.index") }}" class="btn-cancel">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
