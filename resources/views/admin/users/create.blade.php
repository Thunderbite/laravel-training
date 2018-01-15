@extends('admin.layouts.admin')

@section('moduleNav')

    <div class="row">
        <div id="moduleNav" class="col-sm-12 clearfix">
            <a href="/admin/users" class="btn btn-default pull-right">Users</a>
        </div>
    </div>

@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Add a new user</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="/admin/users">

                @include('admin.users.partials.form')

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-success">
                            Create
                        </button>
                    </div>
                </div>

            </form>
            
        </div>
    </div>
        
@endsection