@extends('backend.auth.layouts.master')
@section('page_title','Login')
@section('content')

     {!! Form::open(['method'=>'post' , 'route'=>'login']) !!}
     {!! Form::label('email','Email') !!}
     {!! Form::email('email',null, ['class'=>'form-control form-control-sm']) !!}

     @error('email')
      <span class="text-danger">{{$message}}</span>
     @enderror

     {!! Form::label('password','Password',['class'=>'mt-2']) !!}
     {!! Form::password('password',['class'=>'form-control form-control-sm']) !!}

     @error('password')
     <span class="text-danger">{{$message}}</span>
    @enderror

     <div class="d-grid mt-3">
        {!! Form::button('Login',['type'=>'submit','class'=>'btn btn-sm btn-info']) !!}
     </div>

     {!! Form::close() !!}

     <p class="mt-2">Forgot Password?  <a href="{{route('password.request')}}">Reset Here</a></p>
     <p>Not Registered?  <a href="{{route('register')}}">Register Here</a></p>

@endsection
