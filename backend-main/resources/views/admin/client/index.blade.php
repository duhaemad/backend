@extends('layouts.app')

@section('title', 'All Clients')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Clients</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">admin</a></li>
                            <li class="breadcrumb-item active">All Clients</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col">
                                <form>
                                    <select name="limit" id="">
                                        <option value="5" {{ Request::get('limit') == 5? 'selected' : '' }}>5</option>
                                        <option value="10" {{ Request::get('limit') == 10? 'selected' : '' }}>10</option>
                                        <option value="25" {{ Request::get('limit') == 25? 'selected' : '' }}>25</option>
                                    </select>
                                    <button type="submit">update</button>
                                </form>
                            </div>
                            <div class="col text-center">
                                <form class="d-flex justfy-between" >
                                    <input type="text" name="search" class="form-control">
                                    <button type="submit" class="btn btn-info">Searching</button>
                                    <a href="{{ route('admin.clients.index') }}" class="btn btn-warning">Reset</a>
                                </form>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.clients.create') }}" class="btn btn-success">Create</a>
                            </div>
                        </div>



                        <table class="table table-bordered table-data mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $clients->links() !!}
                        </div>
                    </div>
                </div>
        <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    <!-- /.content -->
    </div>
@endsection


@section('js')
    <script>

        $(function () {
            getAllClients();
        });

        $(document).on('click', '.delete', function (e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $(`#delete-${$(this).data('id')}`).submit();
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        data: {
                            _method : 'DELETE',
                            _token : '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            if (result.value) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );

                                getAllClients();
                            }
                        }
                    });

                   
                }
            })
        });

        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            getAllClients($(this).text())
        });

        function getAllClients(page = 1) {
            $.ajax({
                url: '{{ route('admin.clients.get-clients') }}?page=' + page,
                type: 'GET',
                success: function (res) {
                    $('.table-data tbody').html(res);
                }
            })
        }
    </script>
@endsection