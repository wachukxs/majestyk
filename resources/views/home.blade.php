@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in! Choose an image to begin') }}

                    
                    <div id="the-form"></div>

                    <div id="the-cropper"></div>

                </div>

                <!-- <img src="{{ Storage::disk('local')->url('all-uploads/uniquename.png') }}" alt="Pic of user"> -->
            </div>
        </div>
    </div>
</div>
@endsection
