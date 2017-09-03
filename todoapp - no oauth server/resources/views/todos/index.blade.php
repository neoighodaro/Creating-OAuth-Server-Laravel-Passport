@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Todos</h3>
                    <a href="{{ route('todos.create') }}" class="btn btn-primary pull-right">Add</a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <todos :todos='{!! $todos->toJson() !!}'></todos>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
