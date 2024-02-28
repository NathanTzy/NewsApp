@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h2>CATEGORY</h2>

            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Create Category</a>
            </div>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Category</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Kaskus</td>
                                    <td>Kaskus</td>
                                    <td><img src="" alt="AWOKAOW"></td>
                                    <td>
                                        <a href="#" class="btn btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="" class="btn btn-danger">
                                            <i href="" class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
