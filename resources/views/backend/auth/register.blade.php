@extends('backend.auth.layouts.master')
@section('page_title','Register')
@section('content')

     {!! Form::open(['method'=>'post' , 'route'=>'register']) !!}

     {!! Form::label('name','Name') !!}
     {!! Form::text('name',null, ['class'=>'form-control form-control-sm']) !!}

     {!! Form::label('email','Email',['class'=>'mt-2']) !!}
     {!! Form::email('email',null, ['class'=>'form-control form-control-sm']) !!}

     {!! Form::label('password','Password',['class'=>'mt-2']) !!}
     {!! Form::password('password',['class'=>'form-control form-control-sm']) !!}

     {!! Form::label('password_confirmation','Password Confirm',['class'=>'mt-2']) !!}
     {!! Form::password('password_confirmation',['class'=>'form-control form-control-sm']) !!}

     <div class="d-grid mt-3">
        {!! Form::button('Register',['type'=>'submit','class'=>'btn btn-sm btn-info']) !!}
     </div>

     {!! Form::close() !!}

      <p>Already Registered?  <a href="{{route('login')}}">Login Here</a></p>

@endsection
