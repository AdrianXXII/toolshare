@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nachfrage erstellen</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-4 control-label">Kategorie</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category->id == old('category_id'))
                                            <option value="{{ $category->id }}" selected>{{ $category->description }}</option>
                                        @else
                                            <option value="{{ $category->id }}" >{{ $category->description }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                <!-- {{ old('category_id') }} -->

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('attribute1') ? ' has-error' : '' }}">
                            <label for="attribute1" class="col-md-4 control-label">Eigenschaft 1</label>

                            <div class="col-md-6">
                                <select id="attribute1" class="form-control" name="attribute1">
                                    @foreach ($attributes as $attribute)
                                        @if ($attribute->id == old('attribute1'))
                                            <option value="{{ $attribute->id }}" selected >{{ $attribute->definition->definition }} -  {{ $attribute->value }} {{ $attribute->definition->unit }}</option>
                                        @else
                                            <option value="{{ $attribute->id }}" >{{ $attribute->definition->definition }} -  {{ $attribute->value }} {{ $attribute->definition->unit }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('attribute1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attribute1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('attribute2') ? ' has-error' : '' }}">
                            <label for="attribute2" class="col-md-4 control-label">Eigenschaft 2</label>

                            <div class="col-md-6">
                                <select id="attribute2" class="form-control" name="attribute2">
                                    <option value="">&nbsp;</option>
                                    @foreach ($attributes as $attribute)
                                        @if ($attribute->id == old('attribute2'))
                                            <option value="{{ $attribute->id }}" selected >{{ $attribute->definition->definition }} -  {{ $attribute->value }} {{ $attribute->definition->unit }}</option>
                                        @else
                                            <option value="{{ $attribute->id }}" >{{ $attribute->definition->definition }} -  {{ $attribute->value }} {{ $attribute->definition->unit }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('attribute2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attribute2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('attribute3') ? ' has-error' : '' }}">
                            <label for="attribute3" class="col-md-4 control-label">Eigenschaft 3</label>

                            <div class="col-md-6">
                                <select id="attribute3" class="form-control" name="attribute3">
                                    <option value="">&nbsp;</option>
                                    @foreach ($attributes as $attribute)
                                        @if ($attribute->id == old('attribute3'))
                                            <option value="{{ $attribute->id }}" selected>{{ $attribute->definition->definition }} -  {{ $attribute->value }} {{ $attribute->definition->unit }}</option>
                                        @else
                                            <option value="{{ $attribute->id }}" >{{ $attribute->definition->definition }} -  {{ $attribute->value }} {{ $attribute->definition->unit }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('attribute3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attribute3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-4 control-label">Anzahl</label>

                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control" name="quantity" value="{{ old('quantity') or 1 }}">

                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Lieferdatum</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}">

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Nachfrage erstellen
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
