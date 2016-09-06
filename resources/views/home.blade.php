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
                            <table class="requests">
                                <thead>
                                    <tr>
                                        <th><strong>{{ $request->category->description }}</strong> - Anzahl: {{ $request->quantity }}, Lieferdatum: {{ $request->date }}</th>
                                        <th rowspan="2">
                                            @if ( count($request->offers) > 0)
                                                <a class="btn btn-primary" href="{{ route('showRequest',['id' => $request->id]) }}">Angebotte auflisten</a>
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            @foreach($request->requestAttributes as $atr)
                                                {{ $atr->value . " " . $atr->definition->unit }}
                                                @if ($request->requestAttributes->last() != $atr)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr/>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
