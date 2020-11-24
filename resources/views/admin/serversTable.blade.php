@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <router-view name="serversTable"></router-view>
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection
