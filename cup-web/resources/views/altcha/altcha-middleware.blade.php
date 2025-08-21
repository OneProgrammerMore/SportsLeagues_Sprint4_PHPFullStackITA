@extends("layouts.app")

@section("content")

<div class="cards-container">
        <div class="to-do main-section card section-header">
            Animal Verification
        </div> 
        <div class="card">
        
            @if ($errors->any())
                <div style="color: red;">
                    {{ $errors->first('altcha') }}
                </div>
            @endif
        <form method="POST" action="{{ $originalUrl }}" class="user-form">
            @csrf
            <altcha-widget
                challengeurl="{{ route('altcha.challenge')}}"
            >
            </altcha-widget>
            <noscript>Please enable JavaScript to continue.</noscript>
            <input type="hidden" name="__payload" value="{{ $payload }}">
            <div class="item-nav">
                <button type="submit" class="link-nav link-disclaimer link-altcha" >Verify</button>
            </div>
        </form>
        </div>
</div>

@endsection
