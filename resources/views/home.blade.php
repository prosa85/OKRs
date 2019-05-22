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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Okrs</div>

                <div class="card-body">

                    <okrs></okrs>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    import Okrs from "../js/components/okrs";
    export default {
        components: { Okrs }
    };
</script>
