@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <users-component></users-component>

                </div>
            </div>
        </div>

    </div>

</div> -->
<div class="container-fluid p-5">
    <div class="row justify-content-center">
<!--        <okrs></okrs>-->
        <div class="col-1">
            <ul class="list-group">
                <li class="list-group-item"> <router-link to="/okrs">Okrs</router-link></li>
                <li class="list-group-item"> <router-link to="/users">Users</router-link></li>
            </ul>
        </div>
        <div class="col-11">

        <router-view></router-view>
        </div>
    </div>

</div>

@endsection

