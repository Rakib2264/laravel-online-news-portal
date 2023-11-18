@extends('backend.layouts.master')
@section('page_title','SubCategory')
@section('page_sub_title','Details')
@section('content')

   <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Sub Category Details</h4>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">

                          <tbody>
                                 <tr>
                                    <th>ID</th>
                                    <td>{{$subCategory->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$subCategory->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{$subCategory->category->name}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{$subCategory->status==1?'Active':'Inactive'}}</td>
                                </tr>
                                <tr>
                                    <th>order_by</th>
                                    <td>{{$subCategory->order_by}}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$subCategory->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$subCategory->created_at != $subCategory->updated_at ? $subCategory->updated_at->toDayDateTimeString(): 'Not Updated'}}</td>
                                </tr>

                          </tbody>


                    </table>
                    <a href="{{route('category.index')}}"><button class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-left fa-beat"></i></button></a>

                </div>
            </div>

        </div>
   </div>
@endsection
