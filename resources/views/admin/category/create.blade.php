@extends('layouts.app')
@section('content')

	<h1>Restaurant Category Management</h1>
    <section class="content">
        {!! Form::open(['url' => route('category.store'), 'role' => 'form', 'class' => 'form-horizontal ui form']) !!}
            <div class="ui segments">
                <div class="ui segment clearfix">
                    <h2 class="pull-left">Create category</h2>
                    <div class="pull-right">
                        <a class="ui small button" href="{{ route('restaurant.index') }}">Cancel</a>
                    </div>
                </div>
                <div class="ui green segment">
                    @include('admin.category.form')
                </div>
                <div class="ui segment">
                    <button class="ui small button green" type="submit">Create</button>
                    <a class="ui small button" href="{{ route('restaurant.index') }}">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
    </section>



@endsection