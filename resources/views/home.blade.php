@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                @if($requests->isEmpty())
                    <div class="panel-body">
                        Du bist angemeldet!
                    </div>
                @else
                    <div class="panel-body">
                        <h2>Ihre Nachfragen:</h2>
                        @foreach($requests as $request)
                            <strong>{{ $request->category->description }}</strong> - Anzahl: {{ $request->quantity }}, Lieferdatum: {{ $request->date }} <br/>
                            @foreach($request->requestAttributes as $atr)
                                {{ $atr->value . " " . $atr->definition->unit }}
                                @if ($request->requestAttributes->last() != $atr)
                                    ,
                                @endif
                            @endforeach
                            <hr/>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
