@extends('layouts.app')
@section('content')
    <section class="content">
        {!! Form::model($restaurant, ['url' => route('restaurant.update', ['restaurant' => $restaurant]), 'role' => 'form', 'class' => 'form-horizontal ui form', 'method' => 'PATCH']) !!}

            <div class="ui segments">
                <div class="ui segment clearfix">
                    <h2 class="pull-left">Edit restaurant</h2>
                    <div class="pull-right">
                        <a class="ui small button" href="{{ route('category.create') }}">Create category</a>
                    </div>
                </div>
                <div class="ui green segment">
                    @include('admin.restaurant.form')
                </div>
                <div class="ui segment">
                    <button class="ui small button blue" type="submit">Update</button>
                    <a class="ui small button" href="{{ route('restaurant.index') }}">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
    </section>
@endsection