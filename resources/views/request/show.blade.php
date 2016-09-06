@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nachfrage erstellen</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Kategory</td>
                                <td>{{ $request->category->description }}</td>
                            </tr>
                        </thead>
                        <tbody>
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
                    </table>
                    <hr>
                    @foreach($request->offers as $offer)
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>CHF {{ number_format($offer->price, 2) }}</td>
                                    <td><a href="{{ route('selectRequest',['rid' => $request->id, 'cid' => $offer->id ]) }}" class="btn btn-primary">Annehmen</a></td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
