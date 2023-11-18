@extends('backend.auth.layouts.master')
@section('page_title','Reset Password')
@section('content')

     {!! Form::open(['method'=>'post' , 'route'=>'password.email']) !!}
     {!! Form::label('email','Email') !!}
     {!! Form::email('email',null, ['class'=>'form-control form-control-sm']) !!}

     @error('email')
      <span class="text-danger">{{$message}}</span>
     @enderror



     <div class="d-grid mt-3">
        {!! Form::button('Reset Password',['type'=>'submit','class'=>'btn btn-sm btn-info']) !!}
     </div>

     {!! Form::close() !!}

      <p>Already Registered?  <a href="{{route('login')}}">Login Here</a></p>

@endsection
