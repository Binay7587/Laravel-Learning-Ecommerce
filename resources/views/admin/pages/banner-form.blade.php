@extends('admin.layouts.master')
@section('title', 'Banner Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Banner {{ isset($banner_data) ? 'Update' : 'Add' }}
                    </div>

                </div>
                <div class="ibox-body">

                    @if(isset($banner_data))
                        {{ Form::open(['url'=>route('banner.update', $banner_data->id),'class'=>'form']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url'=>route('banner.store'),'class'=>'form']) }}
                    @endif



                        <div class="form-group row @error('title') has-error @enderror">
                            {{ Form::label('title','Title: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">

                                {{ Form::text('title',@$banner_data->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'required'=>true]) }}

                                @error('title')
                                    <label id="title-error" class="help-block error" for="title">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('link') has-error @enderror">
                            {{ Form::label('link','Link: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::url('link',@$banner_data->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'required'=>true]) }}
                                @error('link')
                                <label id="link-error" class="help-block error" for="link">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>


                    <div class="form-group row @error('status') has-error @enderror">
                        {{ Form::label('status','Status: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>"Active",'inactive'=>"Inactive"],@$banner_data->select,['class'=>'form-control form-control-sm','id'=>'status','required'=>true]) }}
                            @error('status')
                            <label id="status-error" class="help-block error" for="status">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image','Image: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-5">
                            <div class="input-group">
                               <span class="input-group-btn">
                                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </a>
                               </span>
                                <input required id="thumbnail" class="form-control" type="text" name="image" readonly value="{{ @$banner_data->image }}">
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <img id="holder"
                                    @if(isset($banner_data))
                                        src="{{ asset(@$banner_data->image) }}"
                                    @endif
                                 style="max-height:100px;">

                        </div>

                    </div>

                    <div class="form-gorup row">
                        {{ Form::label('','',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button('<i class="fa fa-trash"></i> Reset',['class'=>'btn btn-danger','type'=>'reset']) }}
                            {{ Form::button('<i class="fa fa-send"></i> Submit',['class'=>'btn btn-success','type'=>'submit']) }}
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
    @endsection
