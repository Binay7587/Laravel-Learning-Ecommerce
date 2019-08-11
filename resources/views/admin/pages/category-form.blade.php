@extends('admin.layouts.master')
@section('title', 'Category Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Category {{ isset($category_data) ? 'Update' : 'Add' }}
                    </div>

                </div>
                <div class="ibox-body">

                    @if(isset($category_data))
                        {{ Form::open(['url'=>route('category.update', $category_data->id),'class'=>'form']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url'=>route('category.store'),'class'=>'form']) }}
                    @endif



                    <div class="form-group row @error('title') has-error @enderror">
                        {{ Form::label('title','Title: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">

                            {{ Form::text('title',@$category_data->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'required'=>true]) }}

                            @error('title')
                            <label id="title-error" class="help-block error" for="title">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('summary') has-error @enderror">
                        {{ Form::label('summary','Summary: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$category_data->summary, ['class'=>'form-control form-control-sm','rows'=>5,'style'=>'resize: none','id'=>'summary', 'required'=>false]) }}
                            @error('summary')
                            <label id="summary-error" class="help-block error" for="summary">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('is_parent') has-error @enderror">
                        {{ Form::label('is_parent','Is Parent: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::checkbox('is_parent',1 ,((isset($category_data->is_parent)) ? @$category_data->is_parent : true), ['id'=>'is_parent']) }} Yes
                            @error('is_parent')
                            <label id="is_parent-error" class="help-block error" for="is_parent">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group row @error('parent_id') has-error @enderror
                                @if(isset($category_data) && $category_data->is_parent == 1 )
                                    d-none
                                @elseif(isset($category_data) && $category_data->is_parent == 0)

                                @else
                                    d-none
                                @endif
                            " id="parent_cat_div">
                            {{ Form::label('parent_id','Parent Category: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('parent_id', $parent_cats ,@$category_data->parent_id,['class'=>'form-control form-control-sm','id'=>'parent_id','placeholder'=>'Select Any one']) }}
                                @error('parent_id')
                                <label id="parent_id-error" class="help-block error" for="parent_id">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('status') has-error @enderror">
                        {{ Form::label('status','Status: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>"Active",'inactive'=>"Inactive"],@$category_data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true]) }}
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
                                <input required id="thumbnail" class="form-control" type="text" name="image" readonly value="{{ @$category_data->image }}">
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <img id="holder"
                                 @if(isset($category_data) && $category_data->image != null)
                                 src="{{ asset(@$category_data->image) }}"
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

        $('#is_parent').change(function(){
            var is_checked = $('#is_parent').prop('checked');
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection
