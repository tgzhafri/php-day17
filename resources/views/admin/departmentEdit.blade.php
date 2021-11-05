@extends('layout.default')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-users"></i> Edit Department</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Department ID: {{ $department->id }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- to show status --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST">
                        @csrf
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><input type="text" name='id' id='id' value="{{ $department->id }}"></th>
                                    <th><input type="text" name='name' id='name' value="{{ $department->name }}"></th>
                                </tr>
                            </tbody>

                        </table>
                        <input type="submit" value="Update" class="btn btn-primary">
                        <a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal">Delete</button>
                        </a>
                        <a href="{{ route('admin.department') }}">Back</a>
                    </form>

                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Department
                                        ID: {{ $department->id }}, department name {{ $department->name }}?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Select "Delete" below if you want to delete this Department
                                    permanently. This action CANNOT be reversed!</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-danger"
                                        href="{{ route('departmentDestroy', ['id' => $department->id]) }}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Delete Modal-->

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
