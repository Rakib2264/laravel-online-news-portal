@extends('backend.layouts.master')
@section('page_title','Post')
@section('page_sub_title','Update')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Update Post</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="{{ $post->title }}" name="title" id="title"
                            placeholder="Enter post title">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" value="{{ $post->slug }}" name="slug" id="slug"
                            placeholder="Enter post slug" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Select Category Name</label>
                            {!! Form::select('category_id', $cats, $post->category_id, ['id' => 'category_id', 'class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="name">Select Sub Category Name</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-select">
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
                                {!! Form::checkbox('tag_ids[]', $tag->id, Route::currentRouteName() == 'post.edit' ? in_array($tag->id , $selected_tags) : false) !!} <span>{{$tag->name}}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo">Select Photos</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        @if ( Route::currentRouteName() == 'post.edit')
                        <img   class="img-thumbnail post_image" data-src="{{asset('img/post/original/'.$post->photo)}}" src="{{asset('img/post/thumbmail/'.$post->photo)}}" alt="{{ $post->title }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Post Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea id="summernote" name="description" cols="30" rows="10">{{ $post->description }}</textarea>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-sm btn-info btn-add" type="submit">Update Post</button>
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
    const get_sub_categories = (category_id) => {
        let route_name = '{{Route::currentRouteName()}}'
        let sub_categories;
        jQuery('#sub_category_id').empty();
        let sub_category_select = ''
        if (route_name != 'post.edit') {
            sub_category_select = 'selected'
        }
        jQuery('#sub_category_id').append('<option ' + sub_category_select + '>------Select Sub Category------</option>');
        axios.get(window.location.origin + '/dashboard/get-subcategory/' + category_id).then(res => {
            sub_categories = res.data;
            sub_categories.map((sub_category, index) => {
                let selected = ''
                if (route_name == 'post.edit') {
                    let sub_category_id = '{{$post->sub_category_id ?? null}}'

                    if (sub_category_id == sub_category.id) {
                        selected = 'selected'
                    }
                }
                jQuery('#sub_category_id').append(`<option ${selected} value="${sub_category.id}">${sub_category.name}</option>`)
            });
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
</script>
<script>
    jQuery(document).on("input", "#title", function () {
        let name = $(this).val();
        let slug = name.replaceAll(' ', '-');
        jQuery("#slug").val(slug.toLowerCase());
    });
</script>
<script>
    jQuery(document).on('change', '#category_id', function () {
        let category_id = $("#category_id").val();
        get_sub_categories(category_id);
    });

</script>

@if (Route::currentRouteName()=='post.edit')
<script>
    get_sub_categories('{{$post->category->id}}')
</script>
@endif
@endpush
@endsection

