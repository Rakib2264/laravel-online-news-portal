@extends('frontend.layouts.master')
@section('content')
@section('page_title')
    Single
@endsection
@section('banner')
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ $title }}</h4>
                            <h2>{{ $sub_title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<div class="col-lg-12">
    <div class="blog-post">
        <div class="blog-thumb">
            <img class="img-thumbnail " src="{{ asset('img/post/original/' . $post->photo) }}" alt="{{ $post->title }}">
        </div>
        <div class="down-content">
            <span>{{ $post->category?->name }}</span><sub class="text-warning"> {{ $post->sub_category?->name }}</sub>
            <a href="{{ route('front.single', $post->slug) }}">
                <h4>{{ $post->title }}</h4>
            </a>
            <ul class="post-info">
                <li><a href="#">{{ $post->user->name }}</a></li>
                <li><a href="#">{{ $post->user?->created_at->format('M d, Y') }}</a></li>
                <li><a href="#">12 Comments</a></li>
            </ul>
            <div class="post-description">
                <p> {!! $post->description !!}</p>
            </div>
            <div class="post-options">
                <div class="row">
                    <div class="col-6">
                        <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            @foreach ($post->tag as $tag)
                                <li><a href="{{ route('front.tags', $tag->slug) }}">{{ $tag->name }}</a>,</li>
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
<div class="col-lg-12">
    <div class="sidebar-item comments">
        <div class="sidebar-heading">
            <h2>4 comments</h2>
        </div>
        <div class="content">
            <ul>
                @foreach ($post->comment as $comment)
                <li>
                    <div class="author-thumb">
                        <img src="{{ asset('frontend') }}/assets/images/comment-author-03.jpg" alt="">
                    </div>
                    <div class="right-content">
                        <h4>{{$comment->user?->name}}<span>{{$comment->created_at->format('M d, Y')}}</span></h4>
                        <p>{{$comment->comment}}</p>
                    </div>
                </li>

                <li class="replied">
                    {{-- <div class="author-thumb">
                        <img src="{{ asset('frontend') }}/assets/images/comment-author-02.jpg" alt="">
                    </div>
                    <div class="right-content">
                        <h4>Thirteen Man<span>May 22, 2020</span></h4>
                        <p>Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc,
                            gravida in erat sit amet, feugiat viverra leo.</p>
                    </div> --}}
                     </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="sidebar-item submit-comment">
        <div class="sidebar-heading">
            <h2>Your comment</h2>
        </div>
        <div class="content">
             <form action="{{route('comment.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @error('post_id')
                           <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="hidden" value="{{$post->id}}" name="post_id">
                        @error('comment')
                        <span class="text-danger">{{$message}}</span>
                     @enderror
                        <textarea name="comment" rows="6" form-control @error('date') is-invalid @enderror" id="message" placeholder="Type your comment"></textarea>

                        <button type="submit">Submit</button>
                    </div>
                 </div>
             </form>
        </div>
    </div>
</div>
@endsection
