@extends('home.parent')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center mt-2">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center mt-2">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="card p-4">
            <h3 class="card-title text-center fs-1">
                All User
            </h3>
            <table class="table table-stripped table-hover text-center ">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->role }}</td>
                            <td>

                                <!-- Basic Modal -->
                                <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $row->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                    Reset Password
                                </button>

                                {{-- content modal --}}
                                <div class="modal fade" id="basicModal{{ $row->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn-close fs-1" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <h5 class="modal-title bg-warning p-2 text-white">{{ $row->name }}</h5>
                                            <div class="modal-body">
                                                Default Password into <strong>123456</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('resetPassword',$row->id ) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning text-white">
                                                        <i class="bi bi-pencil-square"></i>
                                                        Reset Password
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
