@extends('admin.layouts.master')
@section('title', 'Product Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Product {{ isset($product_data) ? 'Update' : 'Add' }}
                    </div>

                </div>
                <div class="ibox-body">

                    @if(isset($product_data))
                        {{ Form::open(['url'=>route('product.update', $product_data->id),'class'=>'form']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url'=>route('product.store'),'class'=>'form']) }}
                    @endif



                    <div class="form-group row @error('title') has-error @enderror">
                        {{ Form::label('title','Title: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">

                            {{ Form::text('title',@$product_data->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'required'=>true]) }}

                            @error('title')
                            <label id="title-error" class="help-block error" for="title">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row @error('cat_id') has-error @enderror">
                            {{ Form::label('cat_id','Category: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('cat_id',$parent_cats ,@$product_data->cat_id,['placeholder' => '--Select Any One--','class'=>'form-control form-control-sm','id'=>'cat_id','required'=>true]) }}
                                @error('cat_id')
                                <label id="cat_id-error" class="help-block error" for="cat_id">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('child_cat_id') has-error @enderror d-none" id="child_cat_div">
                            {{ Form::label('child_cat_id','Sub Category: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('child_cat_id',[],@$product_data->child_cat_id,['class'=>'form-control form-control-sm','id'=>'child_cat_id']) }}
                                @error('child_cat_id')
                                <label id="child_cat_id-error" class="help-block error" for="child_cat_id">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row @error('summary') has-error @enderror">
                        {{ Form::label('summary','Summary: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$product_data->summary, ['class'=>'form-control form-control-sm','rows'=>5,'style'=>'resize: none','id'=>'summary', 'required'=>false]) }}
                            @error('summary')
                            <label id="summary-error" class="help-block error" for="summary">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('description') has-error @enderror">
                        {{ Form::label('description','Description: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description',@$product_data->description, ['class'=>'form-control form-control-sm','rows'=>5,'style'=>'resize: none','id'=>'description']) }}
                            @error('description')
                            <label id="description-error" class="help-block error" for="description">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row @error('price') has-error @enderror">
                            {{ Form::label('price','Price (NPR.): ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::number('price',@$product_data->price, ['class'=>'form-control form-control-sm', 'id'=>'price', 'required'=>true, 'min'=>'100']) }}
                                @error('price')
                                <label id="price-error" class="help-block error" for="price">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('discount') has-error @enderror">
                            {{ Form::label('discount','Discount (%): ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::number('discount',@$product_data->discount, ['class'=>'form-control form-control-sm', 'id'=>'discount', 'required'=>false, 'min'=>0, 'max'=>90]) }}
                                @error('discount')
                                <label id="discount-error" class="help-block error" for="discount">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('brand') has-error @enderror">
                            {{ Form::label('brand','Brand : ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('brand',@$product_data->brand, ['class'=>'form-control form-control-sm', 'id'=>'brand']) }}
                                @error('brand')
                                <label id="brand-error" class="help-block error" for="brand">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('is_featured') has-error @enderror">
                            {{ Form::label('is_featured','Is Featured: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::checkbox('is_featured',1 ,((isset($category_data->is_featured)) ? @$category_data->is_parent : true), ['id'=>'is_parent']) }} Yes

                                @error('is_featured')
                                <label id="is_featured-error" class="help-block error" for="is_featured">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row @error('status') has-error @enderror">
                        {{ Form::label('status','Status: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>"Active",'inactive'=>"Inactive"],@$product_data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true]) }}
                            @error('status')
                            <label id="status-error" class="help-block error" for="status">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row @error('vendor_id') has-error @enderror">
                            {{ Form::label('vendor_id','Vendor : ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('vendor_id',$vendor ,@$product_data->vendor_id,['placeholder' => 'Select Any One','class'=>'form-control form-control-sm','id'=>'vendor_id']) }}
                                @error('vendor_id')
                                <label id="vendor_id-error" class="help-block error" for="vendor_id">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row">
                        {{ Form::label('image','Image: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                               <span class="input-group-btn">
                                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                   <i class="fa fa-picture-o"></i> Choose
                                 </a>
                               </span>
                                <input required id="thumbnail" class="form-control" type="text" name="image" readonly value="{{ @$product_data->image }}">
                            </div>
                        </div>
                    </div>

                        <div class="row">

                            <div id="holder" style="margin-top: 15px">
                                @if(isset($product_data) && $product_data->image)
                                   @php
                                       $image_list = explode(",",$product_data->image);
                                   @endphp
                                    @foreach($image_list as $related_images)
                                        <div class="lfm-image col-sm-3">
                                            <img src="{{ asset($related_images) }}" class="img img-responsive img-thumbnail" style="padding-left:20px; margin-right: 10px;">
                                            <a href="javascript:;" class="lfm-img-close-btn" onclick="deleteThis(this)" data-value="{{ $related_images }}">X</a>
                                        </div>
                                    @endforeach

                                @endif
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
    <script src="{{ asset('vendor/laravel-filemanager/js/multiple.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');

        $('#description').summernote();



        $('#cat_id').change(function(){
            var cat_id = $('#cat_id').val();
            $.ajax({
                url: "/admin/category/"+cat_id+"/child",
                type: "post",
                data:{
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if(typeof(response) != 'object'){
                        response = $.parseJSON(response);
                    }

                    var html_option = "<option value='' selected>--Select Any One--</option>";
                    if(response.status){
                        //child exits
                        $.each(response.data, function(key, value){
                            html_option += "<option value='"+key+"'>"+value+"</option>";
                        });
                        $('#child_cat_div').removeClass('d-none');
                    } else {
                        // no child exists
                        $('#child_cat_div').addClass('d-none');
                    }

                    $('#child_cat_id').html(html_option);
                }
            });
        });
        $(document).ready(function(){
            $('#cat_id').change();
        });
    </script>
@endsection
