@extends('admin.layouts.master')
@section('title', 'Banner Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Banner Lists
                    </div>
                    <a href="{{ route('banner.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add Banner
                    </a>

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($banner_data)
                                @foreach($banner_data as $banner_info)
                                    <tr>
                                        <td>{{ $banner_info->title }}</td>
                                        <td>
                                            <img src="{{ asset($banner_info->image) }}" class="img img-reponsive img-thumbnail" style="max-width: 150px;" alt="">
                                        </td>
                                        <td>
                                            <a href="{{ $banner_info->link }}" target="_banner">
                                                {{ $banner_info->link }}
                                            </a>
                                        </td>
                                        <td>{{ ucfirst($banner_info->status) }}</td>
                                        <td>
                                            <a href="{{ route('banner.edit', $banner_info->id) }}" class="btn btn-success btn-circle">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            {{ Form::open(['url'=>route('banner.destroy', $banner_info->id), 'class'=>'form','onsubmit'=>"return confirm('Are you sure you want to delete this banner?')"]) }}
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
