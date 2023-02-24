@extends('layouts.master')

@section('title', 'Cloth Roll')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="search-box me-2 mb-2 d-inline-block">
                            <div class="position-relative">
                                <input type="text" class="form-control searchTable"
                                    placeholder="Search">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                            onclick="modalClothRoll()"><i class="bx bx-plus font-size-16 align-middle me-2"></i>
                            Create
                        </a>
                    </div>
                    <table class="table align-middle table-nowrap table-hover table-datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;">#</th>
                                <th scope="col">PO Number</th>
                                <th scope="col">Fabric Type</th>
                                <th scope="col">Color</th>
                                <th scope="col">Roll Number</th>
                                <th scope="col">Width</th>
                                <th scope="col">Length</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Batch Number</th>
                                <th scope="col" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection