@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Resultate</div>
                <div class="panel-body">
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
            </div>
        </div>
    </div>
</div>
@endsection
