@extends('frontend.layouts.master')
@section('content')
@section('page_title')
{{$title}}
@endsection
@section('banner')
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="text-content">
                  <h4>{{$sub_title}}</h4>
                  <h2>{{$title}}</h2>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection
@foreach ($posts as $post)


<div class="col-lg-12">
    <div class="blog-post">
        <div class="blog-thumb">
            <img   class="img-thumbnail "  src="{{asset('img/post/original/'.$post->photo)}}" alt="{{ $post->title }}">

        </div>
        <div class="down-content">
            <span>{{$post->category?->name}}</span> <sub class="text-warning">  {{$post->sub_category?->name}}</sub>
            <a href="{{route('front.single',$post->slug)}}">
                <h4>{{$post->title}}</h4>
            </a>
            <ul class="post-info">
                <li><a href="#">{{$post->user->name}}</a></li>
                <li><a href="#">{{$post->user?->created_at->format('M d, Y')}}</a></li>
                <li><a href="#">12 Comments</a></li>
            </ul>
            <p>
                {{strip_tags(substr($post->description,0,400)).'... ' }}
                <a href="{{route('front.single',$post->slug)}}"><button style="border: none; font-size: 13px;  background-color: rgb(228, 213, 193); border-radius:5px; padding:0 10px; transition: .3s all ease-in-out;">Read More</button></a>
            </p>
            <div class="post-options">
                <div class="row">
                    <div class="col-6">
                        <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            @foreach ($post->tag as $tag)
                            <li><a href="{{route('front.tags',$tag->slug)}}">{{$tag->name}}</a>,</li>
                            @endforeach
                         </ul>
                    </div>
                    <div class="col-6">
                        <ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <li><a href="#">Facebook</a>,</li>
                            <li><a href="#"> Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach


@if (count($posts) <1)
  <h1 class="text-danger">No Post Found</h1>
@endif

<div class="col-lg-12">
    {{$posts->links()}}
</div>

@endsection
