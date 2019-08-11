@extends('admin.layouts.master')
@section('title', 'Category Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Category Lists
                    </div>
                    <a href="{{ route('category.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add Category
                    </a>

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Parent</th>
                            <th>Summary</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($category_data)
                            @foreach($category_data as $category_info)
                                <tr>
                                    <td>{{ $category_info->title }}</td>
                                    <td>
                                        {{ $category_info->parent_info['title'] }}
                                    </td>
                                    <td>
                                        {{ $category_info->summary }}
                                    </td>
                                    <td>{{ ucfirst($category_info->status) }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category_info->id) }}" class="btn btn-success btn-circle">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {{ Form::open(['url'=>route('category.destroy', $category_info->id), 'class'=>'form','onsubmit'=>"return confirm('Are you sure you want to delete this category?')",'style'=>'float: left;margin-right: 10px;']) }}
                                        @method('delete')
                                        <button class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
