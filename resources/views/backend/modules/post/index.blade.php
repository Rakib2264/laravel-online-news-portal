@extends('backend.layouts.master')
@section('page_title', 'Post')
@section('page_sub_title', 'List')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Post List</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-{{ session('cls') }}">
                            {{ session('success') }}
                        </div>
                    @endif


                    <table class="table table-striped table-bordered table-hover custom_css">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th >
                                    <p>Title</p>
                                    <hr/>
                                    <p>Slug</p>
                                </th>
                                <th>
                                    <p>Category</p>
                                    <hr/>
                                    <p>Sub Category</p>
                                </th>

                                <th>
                                    <p>Status</p>
                                    <hr/>
                                    <p>Is Approved</p>
                                </th>
                                <th>Photo</th>
                                <th>Tags</th>
                                <th>
                                    <p>Created At</p>
                                    <hr/>
                                    <p>Updated At</p>
                                    <hr/>
                                    <p>Created By</p>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                       <p> {{ $post->title }}</p>
                                       <hr/>
                                       <p> {{ $post->slug }}</p>
                                    </td>
                                    <td >
                                        <p> <a class="text-decoration-none text-success"  data-toggle="tooltip" data-placement="top" title="Click Me"  href="{{route('category.show',$post->category->id)}}">{{ $post->category?->name }}</a></p>
                                       <hr/>
                                       <p> <a class="text-decoration-none text-success"  data-toggle="tooltip" data-placement="top" title="Click Me" href="{{route('sub_category.show',$post->sub_category->id)}}">{{ $post->sub_category?->name}} </p>
                                    </td>
                                    <td>
                                        <p> {{ $post->status == 1 ? 'Published' : 'Not Published' }}</p>
                                        <hr/>
                                        <p> {{ $post->is_apporved == 1 ? 'Approved' : 'Not Approved'}}</p>
                                    </td>
                                    <td>
                                       <img   class="img-thumbnail post_image" data-src="{{asset('img/post/original/'.$post->photo)}}" src="{{asset('img/post/thumbmail/'.$post->photo)}}" alt="{{ $post->title }}">
                                    </td>
                                    <td>
                                        @php
                                            $classes = ['btn-success','btn-info','btn-danger','btn-secondary','btn-warning','btn-dark','btn-light']
                                        @endphp
                                        @foreach ($post->tag as $tag)
                                        <a href="{{route('tag.show',$tag->id)}}"><button class="btn btn-sm {{$classes[random_int(0,6)]}} mb-1"> {{$tag->name}}</button></a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <p>{{ $post->created_at->toDayDateTimeString() }}</p>
                                        <hr/>
                                        <p>{{ $post->created_at != $post->updated_at ? $post->updated_at->toDayDateTimeString() : 'Not Updated' }}</p>
                                        <hr/>
                                        <p>{{ $post->user?->name }}</p>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('post.show', $post->id) }}"><button
                                                    class="btn btn-info btn-sm"><i
                                                        class="fa-solid fa-eye fa-fade"></i></button></a>
                                            <a href="{{ route('post.edit', $post->id) }}"><button
                                                    class="btn btn-warning btn-sm mx-1"><i
                                                        class="fas fa-edit fa-pulse"></i></button></a>
                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST"
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
                    <div class="mt-3 ">
                        {{ $posts->links() }}
                    </div>




                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
<button id="image_show_button" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show"></button>
        <!-- Modal -->
<div class="modal fade modal-lg" id="image_show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Image</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img alt="Display Image" id="display_image" class="img-fluid"/>

        </div>
        <div class="modal-footer">
          </div>
      </div>
    </div>
  </div>
    </div>


@push('js')

<script>
    $(document).on("click",".post_image",function(){
      let img = $(this).attr('data-src');
      $('#display_image').attr('src', img);
      $('#image_show_button').trigger('click');
      console.log(img)

    });
</script>
<script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endpush

 @endsection
