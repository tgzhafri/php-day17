@extends('layout.default')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fas fa-fw fa-briefcase"></i>
            Jobs Table
        </h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
                <a href="{{ route('jobRegister') }}">
                    <button class="m-0 font-weight-bold btn btn-primary" type="button">
                        <i class="fas fa-fw fa-briefcase"></i>
                        Add New Job
                    </button>
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
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Min Salary</th>
                                <th>Max Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Min Salary</th>
                                <th>Max Salary</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @isset($jobs)
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td>{{ $job->id }}</td>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->description }}</td>
                                        <td>{{ $job->min_salary }}</td>
                                        <td>{{ $job->max_salary }}</td>
                                        <td>
                                            <a href="{{ route('jobEdit', ['id' => $job->id]) }}">
                                                <button type="button" class="btn btn-secondary">Edit</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            @endisset
                        </tbody>
                    </table>
                    {{ $jobs->links('pagination::bootstrap-4') }}
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
