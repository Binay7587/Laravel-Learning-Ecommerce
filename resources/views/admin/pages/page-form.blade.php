@extends('admin.layouts.master')
@section('title', 'Page Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Edit <em>{{ $page_content->title }}</em> Content
                    </div>

                </div>
                <div class="ibox-body">

                        {{ Form::open(['url'=>route('pages.update', $page_content->id),'class'=>'form']) }}
                        @method('patch')

                        <h4 class="text-center">{{ $page_content->title }}</h4>
                    <hr>
                    {{-- <div class="form-group row @error('title') has-error @enderror">
                        {{ Form::label('title','Title: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">

                            {{ Form::text('title',@$page_content->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'required'=>true]) }}

                            @error('title')
                            <label id="title-error" class="help-block error" for="title">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    --}}

                    <div class="form-group row @error('summary') has-error @enderror">
                        {{ Form::label('summary','Summary: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$page_content->summary, ['class'=>'form-control form-control-sm','rows'=>5,'style'=>'resize: none','id'=>'summary', 'required'=>false]) }}
                            @error('summary')
                            <label id="summary-error" class="help-block error" for="summary">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row @error('description') has-error @enderror">
                            {{ Form::label('description','Description: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('description',@$page_content->description, ['class'=>'form-control form-control-sm','rows'=>5,'style'=>'resize: none','id'=>'description', 'required'=>false]) }}
                                @error('description')
                                <label id="description-error" class="help-block error" for="description">{{ $message }}</label>
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
                                <input required id="thumbnail" class="form-control" type="text" name="image" readonly value="{{ @$page_content->image }}">
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <img id="holder"
                                 @if(isset($page_content) && $page_content->image != null)
                                 src="{{ asset(@$page_content->image) }}"
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
        $('#description').summernote({
            height: 200
        });

    </script>
@endsection
