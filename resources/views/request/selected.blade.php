@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Angebot akzeptiert</div>
                <div class="panel-body">
                    Ihre Bestellung war erfolgreich.
                    <a href="{{ url('/') }}" class="btn btn-primary"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
