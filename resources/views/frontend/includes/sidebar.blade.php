<div class="col-lg-4">
    <div class="sidebar">
      <div class="row">
        <div class="col-lg-12">
          <div class="sidebar-item">

            {!! Form::open(['method'=>'get', 'route'=>'front.search']) !!}

            <div class="input-group">
                {!! Form::search('search',null , ['class'=>'form-control','placeholder'=>'type to search.....']) !!}
                {!! Form::button('<i class="fa-solid fa-magnifying-glass"></i>', ['class'=>'btn btn-sm btn-info input-group-text ','type'=>'submit']) !!}

            </div>
            {!! Form::close() !!}

            {{-- <div class="input-group">
            <form  method="GET" action="{{route('front.search')}}">
              <input type="text" name="search" class="form-control" placeholder="type to search..." autocomplete="on">
            <button class="btn btn-sm btn-info input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form> --}}

        </div>

          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item recent-posts">
            <div class="sidebar-heading">
              <h2>Recent Posts</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($recent_post as $post)
                <li>
                    <a href="{{route('front.single',$post->slug)}}">
                  <h5>{{$post->title}}</h5>
                  <span>{{$post->created_at->format('M d Y')}}</span></a>
               </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item categories">
            <div class="sidebar-heading">
              <h2>Categories</h2>
            </div>
            <div class="content">
                <ul>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('front.category', $category->slug) }}">- {{ $category->name }}</a>
                            @if ($category->sub_categories->isNotEmpty())
                                <ul class="sidebar-subcat">
                                    @foreach ($category->sub_categories as $sub_category)
                                        <li><a href="{{ route('front.sub_category', [$category->slug,$sub_category->slug]) }}">- {{ $sub_category->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item tags">
            <div class="sidebar-heading">
              <h2>Tag Clouds</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($tags as $tag)
                <li><a href="{{route('front.tags',$tag->slug)}}">{{$tag->name}}</a></li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
