@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Resultate</div>
                <div class="panel-body">
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
                            <tfoot>
                                <tr>
                                    <td colspan="2"><a class="btn btn-primary center-block" href="{{ route('createOffer',['id' => $request->id]) }}">Angebot machen</a></td>
                                </tr>
                            </tfoot>
                        </table>
                        <hr/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
