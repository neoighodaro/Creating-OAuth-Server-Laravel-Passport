@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Create</h3>
                    <a href="{{ route('todos.index') }}" class="btn btn-default pull-right">< Back</a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    @if ($errors->count())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('todos.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="item" placeholder="Enter todo e.g Take out the groceries" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-left btn-block">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
