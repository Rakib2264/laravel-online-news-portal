@extends('backend.layouts.master')
@section('page_title','Tag')
@section('page_sub_title','Update')
@section('content')

   <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Update Tag</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('tag.update', $tag->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use the PUT method for updates -->

                        <div class="form-group">
                            <label for="name">tag Name</label>
                            <input type="text" class="form-control" value="{{ $tag->name }}" name="name" id="name" placeholder="Enter Tag name">
                        </div>
                        <div class="form-group">
                            <label for="slug">tag Slug</label>
                            <input type="text" class="form-control" value="{{ $tag->slug }}" name="slug" id="slug" placeholder="Enter Tag slug" readonly>
                        </div>
                        <div class="form-group">
                            <label for="order_by">Order By</label>
                            <input type="number" class="form-control" value="{{ $tag->order_by }}" name="order_by" id="order_by" placeholder="Enter Tag Serial">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="{{ $tag->id }}" {{ $tag->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="{{ $tag->id }}" {{ $tag->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-info btn-add" type="submit">Update Tag</button>
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
