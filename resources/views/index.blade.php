@extends('layouts.master')

@section('content')
    <div class="container text-center mt-5">
        <!-- MTS SI Logo Section -->
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('storage/mts-si-tp.png') }}"
                     alt="MTS SI Logo" class="img-fluid">
            </div>
        </div>

        <!-- Heading -->
        <div class="row mt-4">
            <div class="col-12">
                <h2 class="display-4 text-danger">Welcome to MTS SI</h2>
                <p class="lead text-secondary">Povezujemo tehnologiju i budućnost. Na pravom SI mestu.</p>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-5">
            <div class="col-12">
                <p class="text-muted">
                    Neka te tvoja sledeća digitalna avantura poveže sa nama. Hajde da zajedno stvaramo budućnost.
                </p>
            </div>
        </div>
    </div>
@stop
