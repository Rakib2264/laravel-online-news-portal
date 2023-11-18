@extends('backend.auth.layouts.master')
@section('page_title','Reset Password')
@section('content')

     {!! Form::open(['method'=>'post' , 'route'=>'password.store']) !!}

      {!! Form::hidden('token',$request->route('token')) !!}

     {!! Form::label('email','Email',['class'=>'mt-2']) !!}
     {!! Form::email('email',$request->email, ['class'=>'form-control form-control-sm']) !!}

     {!! Form::label('password','Password',['class'=>'mt-2']) !!}
     {!! Form::password('password',['class'=>'form-control form-control-sm']) !!}

     {!! Form::label('password_confirmation','Password Confirm',['class'=>'mt-2']) !!}
     {!! Form::password('password_confirmation',['class'=>'form-control form-control-sm']) !!}

     <div class="d-grid mt-3">
        {!! Form::button('Reset Password',['type'=>'submit','class'=>'btn btn-sm btn-info']) !!}
     </div>

     {!! Form::close() !!}


@endsection
