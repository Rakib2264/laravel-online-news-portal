@extends('backend.layouts.master')
@section('page_title','Category')
@section('page_sub_title','Create')
@section('content')

   <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Add Category</h4>
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
                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category name">
                        </div>
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text"  class="form-control" name="slug" id="slug" placeholder="Enter Category slug" readonly>
                        </div>
                        <div class="form-group">
                            <label for="order_by">Order By</label>
                            <input type="number" class="form-control" name="order_by" id="order_by" placeholder="Enter Category Serial">
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
                            <button class="btn btn-sm btn-info btn-add" type="submit">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
   </div>
@push('js')
<script>


    jQuery(document).on("input","#name",function(){
       let name = $(this).val();
       let slug = name.replaceAll(' ', '-');
       jQuery("#slug").val(slug.toLowerCase());
    })

</script>

@endpush
@endsection
