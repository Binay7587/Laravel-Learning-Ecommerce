@extends('layouts.master')
@section('main-content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background: #AAA">
        <h2 class="ltext-105 cl0 txt-center" style="color: #000;">
            Sign Up
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            <div class="row p-b-148">
                <div class="col-md-12 col-lg-12">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        {{ Form::open(['url'=>route('signup-process'), 'class'=>'form']) }}
                            <div class="form-group row">
                                {{ Form::label('name','Name: ',['class'=>'col-3']) }}
                                <div class="col-9">
                                    {{ Form::text('name', old('name'), ['class'=>'form-control form-control-sm','id'=>'name','required'=>true]) }}
                                    @error('name')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('email','Email: ',['class'=>'col-3']) }}
                                <div class="col-9">
                                    {{ Form::email('email', old('email'), ['class'=>'form-control form-control-sm','id'=>'email','required'=>true]) }}
                                    @error('email')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('password','Password: ',['class'=>'col-3']) }}
                                <div class="col-9">
                                    {{ Form::password('password',['class'=>'form-control form-control-sm','id'=>'password','required'=>true]) }}
                                    @error('password')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('password_confirmation','Re-Password: ',['class'=>'col-3']) }}
                                <div class="col-9">
                                    {{ Form::password('password_confirmation',['class'=>'form-control form-control-sm','id'=>'password_confirmation','required'=>true]) }}
                                </div>
                            </div>
                        <div class="form-group row">
                            {{ Form::label('user_type','You are: ',['class'=>'col-3']) }}
                            <div class="col-9">
                                {{ Form::select('role',['vendor'=>'Seller','customer'=>'Buyer'],old('role'),['class'=>'form-control form-control-sm','id'=>'user_type','required'=>true]) }}
                                @error('role')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('','',['class'=>'col-3']) }}
                            <div class="col-9">
                                {{ Form::submit('Register',['class'=>'btn btn-success','id'=>'submit']) }}
                            </div>
                        </div>


                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
