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

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('storeOffer', ['id' => $request->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Angebot Preis</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}">

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Angebot machen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
