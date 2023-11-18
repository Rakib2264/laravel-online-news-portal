@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'List')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Tag List</h4>
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
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>{{ $tag->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $tag->order_by }}</td>
                                    <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $tag->created_at != $tag->updated_at ? $tag->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('tag.show', $tag->id) }}"><button
                                                    class="btn btn-info btn-sm"><i
                                                        class="fa-solid fa-eye fa-fade"></i></button></a>
                                            <a href="{{ route('tag.edit', $tag->id) }}"><button
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fas fa-edit fa-pulse"></i></button></a>
                                            <form action="{{ route('tag.destroy', $tag->id) }}" method="POST"
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
