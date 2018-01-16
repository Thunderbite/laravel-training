@extends('admin.layouts.admin')

@section('moduleNav')

    <div class="row">
        <div id="moduleNav" class="col-sm-12 clearfix">
            <a href="/admin/users/create" class="btn btn-success pull-right">Add Text</a>
        </div>
    </div>

@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Texts</div>
        <div class="panel-body">
            <table class="table table-hover" id="texts">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Keyword</th>
                        <th>Text</th>
                        <th>Created</th>
                        <th>Updated</th>                        
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

            $('#texts').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/texts/data',
                columns: [
                    {data: 'ID', name: 'ID'},
                    {data: 'keyword', name: 'keyword'},
                    {data: 'text', name: 'text'},
                    {data: 'created', name: 'created'},
                    {data: 'updated', name: 'updated'}
                ],
            });

        });

    </script>

@endsection
