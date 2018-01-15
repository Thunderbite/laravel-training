@extends('admin.layouts.admin')

@section('moduleNav')

    <div class="row">
        <div id="moduleNav" class="col-sm-12 clearfix">
            <a href="/admin/users/create" class="btn btn-success pull-right">Add user</a>
        </div>
    </div>

@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
            <table class="table table-hover" id="users">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $(function() {

            $('#users').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/users/data',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
            });

        });

    </script>

@endsection
