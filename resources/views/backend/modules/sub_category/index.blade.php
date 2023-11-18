@extends('backend.layouts.master')
@section('page_title', 'Sub Category')
@section('page_sub_title', 'List')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Sub Category List</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-{{ session('cls') }}">
                            {{ session('success') }}
                        </div>
                    @endif


                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub_categorys as $sub_category)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $sub_category->name }}</td>
                                    <td>{{ $sub_category->slug }}</td>
                                    <td>{{ $sub_category->category->name }}</td>
                                    <td>{{ $sub_category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $sub_category->order_by }}</td>
                                    <td>{{ $sub_category->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $sub_category->created_at != $sub_category->updated_at ? $sub_category->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('sub_category.show', $sub_category->id) }}"><button
                                                    class="btn btn-info btn-sm"><i
                                                        class="fa-solid fa-eye fa-fade"></i></button></a>
                                            <a href="{{ route('sub_category.edit', $sub_category->id) }}"><button
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fas fa-edit fa-pulse"></i></button></a>
                                            <form action="{{ route('sub_category.destroy', $sub_category->id) }}" method="POST"
                                                 >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete btn btn-danger btn-sm delete-button"
                                                    >
                                                    <i class="fa-solid fa-trash fa-beat"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>




 @endsection
