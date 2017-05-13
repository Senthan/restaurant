@extends('layouts.app')
@section('content')
    <div class="block-header">
        <h1>Delete Restaurant</h1>
    </div>
    <div class="row clearfix">
        <div class="ui segments">
            <div class="ui green segment">
                {!! Form::model($restaurant, ['url' => route('restaurant.destroy', ['restaurant' => $restaurant]), 'role' => 'form', 'class' => 'form-horizontal ui form', 'method' => 'DELETE']) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="ui button" href="{{ route('restaurant.index') }}">Restaurant?</a>
                    </div>
                    <div class="panel-body">
                        <p>Do you really want to delete this ({{ $restaurant->name }}) restaurant?</p>
                    </div>
                    <div class="panel-footer">
                        <button class="ui button red" type="submit">Delete</button>
                        <a class="ui button" href="{{ route('restaurant.index') }}">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection