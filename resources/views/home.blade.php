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
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nachfrage Nr.</th>
                                    <th>{{ $request->id }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Kategory</td>
                                    <td>{{ $request->category->description }}</td>
                                </tr>
                                <tr>
                                    <td>Anzahl</td>
                                    <td>{{ $request->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Lieferdatum</td>
                                    <td>{{ $request->date }}</td>
                                </tr>
                                @foreach($request->requestAttributes as $atr)
                                    <tr>
                                        <td>
                                            {{ $atr->definition->definition  }}
                                        </td>
                                        <td>
                                            {{ $atr->value . " " . $atr->definition->unit }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                    @if ( count($request->offers) > 0)
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <a class="btn btn-primary center-block" href="{{ route('showRequest',['id' => $request->id]) }}">Angebote auflisten</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    @endif
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
