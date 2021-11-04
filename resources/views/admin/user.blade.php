@extends('layout.default')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users Table</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Add new user</h6> --}}
                <a href="{{ route('userRegister') }}">
                    <button class="m-0 font-weight-bold btn btn-primary" type="button">Add new user</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- to show status --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @isset($users)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('userEdit', ['id' => $user->id]) }}">
                                                <button type="button" class="btn btn-secondary">Edit</button>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            @endisset
                        </tbody>
                    </table>


                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

@endsection

@section('scripts')

@endsection
