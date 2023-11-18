@extends('backend.layouts.master')
@section('page_title','Category')
@section('page_sub_title','Update')
@section('content')

   <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Update Category</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use the PUT method for updates -->

                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" value="{{ $category->name }}" name="name" id="name" placeholder="Enter Category name">
                        </div>
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" class="form-control" value="{{ $category->slug }}" name="slug" id="slug" placeholder="Enter Category slug" readonly>
                        </div>
                        <div class="form-group">
                            <label for="order_by">Order By</label>
                            <input type="number" class="form-control" value="{{ $category->order_by }}" name="order_by" id="order_by" placeholder="Enter Category Serial">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-info btn-add" type="submit">Update Category</button>
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
