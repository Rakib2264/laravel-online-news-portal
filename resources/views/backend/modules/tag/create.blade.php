@extends('backend.layouts.master')
@section('page_title','Category')
@section('page_sub_title','Tag')
@section('content')

   <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Tag Create</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <form action="{{route('tag.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tag Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Tag name">
                        </div>
                     
                        <div class="form-group">
                            <label for="order_by">Order By</label>
                            <input type="number" class="form-control" name="order_by" id="order_by" placeholder="Enter Tag Serial">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="" selected>--------Select Status--------</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                         </div>
                         <div class="form-group mt-2">
                            <button class="btn btn-sm btn-info btn-add" type="submit">Add Tag</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
   </div>

@endsection
