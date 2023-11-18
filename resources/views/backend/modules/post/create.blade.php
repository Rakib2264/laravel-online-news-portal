@extends('backend.layouts.master')
@section('page_title', 'Post')
@section('page_sub_title', 'Create')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Add Post</h4>
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
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Enter post title">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug"
                                placeholder="Enter post slug" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Select Category Name</label>
                                {!! Form::select('category_id', $cats, null, ['id' => 'category_id', 'class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="name">Select Sub Category Name</label>
                                 <select name="sub_category_id" id="sub_category_id" class="form-select" id="sub_category_id">
                                    <option selected>------Select Sub Category------</option>
                                  </select>
                            </div>

                        </div>

                        <div class="form-group">
                             {!! Form::label('tag_id', 'Select Tag', ['class' => 'mt-2']) !!}
                             <br>

                             <div class="row">
                                @foreach ($tags as $tag)
                                <div class="col-md-3">
                                    {!! Form::checkbox('tag_ids[]', $tag->id,false) !!} <span>{{$tag->name}}</span>

                                </div>
                                @endforeach
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="photo">Select Photos</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>


                        <div class="form-group">
                            <label for="status">Post Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="" selected>--------Select Post Status--------</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <textarea id="summernote" name="description"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-info btn-add" type="submit">Add Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.1/axios.min.js"></script>

<script>
  $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
        <script>
            jQuery(document).on("input", "#title", function() {
                let name = $(this).val();
                let slug = name.replaceAll(' ', '-');
                jQuery("#slug").val(slug.toLowerCase());
            });
        </script>
        <script>
            jQuery(document).on('change', '#category_id', function() {
                let category_id = jQuery(this).val();
                let sub_categories;
                jQuery('#sub_category_id').empty();
                jQuery('#sub_category_id').append('<option selected>------Select Sub Category------</option>');
                axios.get(window.location.origin + '/dashboard/get-subcategory/' + category_id).then(res => {
                    sub_categories = res.data;
                    sub_categories.map((sub_category, index) => (
                        jQuery('#sub_category_id').append(`<option value="${sub_category.id}">${sub_category.name}</option>`)
                    ));
                });
            });
        </script>
    @endpush
@endsection
