@extends('backend.layouts.master')
@section('page_title','Category')
@section('page_sub_title','Details')
@section('content')

   <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Category Details</h4>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">

                          <tbody>
                                 <tr>
                                    <th>ID</th>
                                    <td>{{$category->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$category->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{$category->status==1?'Active':'Inactive'}}</td>
                                </tr>
                                <tr>
                                    <th>order_by</th>
                                    <td>{{$category->order_by}}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$category->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$category->created_at != $category->updated_at ? $category->updated_at->toDayDateTimeString(): 'Not Updated'}}</td>
                                </tr>

                          </tbody>


                    </table>
                    <a href="{{route('category.index')}}"><button class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-left fa-beat"></i></button></a>

                </div>
            </div>

        </div>
   </div>
@endsection
