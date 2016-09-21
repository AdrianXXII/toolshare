@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Meine noch offene Angebote</div>
                <div class="panel-body">

                    @foreach($offers as $offer)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nachfrage Nr.</th>
                                <th>{{ $offer->request->id }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kategory</td>
                                <td>{{ $offer->request->category->description }}</td>
                            </tr>
                            <tr>
                                <td>Anzahl</td>
                                <td>{{ $offer->request->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Lieferdatum</td>
                                <td>{{ $offer->request->date }}</td>
                            </tr>
                            @foreach($offer->request->requestAttributes as $atr)
                                <tr>
                                    <td>
                                        {{ $atr->definition->definition  }}
                                    </td>
                                    <td>
                                        {{ $atr->value . " " . $atr->definition->unit }}
                                    </td>
                                </tr>
                            @endforeach
                        <tr>
                            <td><strong>Angegot Nr.</strong></td>
                            <td><strong>{{ $offer->id }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Dein Angegot</strong></td>
                            <td><strong>CHF {{ $offer->price }}</strong></td>
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
