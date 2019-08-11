@extends('admin.layouts.master')
@section('title', 'Pages Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Pages List
                    </div>

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Summary</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($page_data)
                            @foreach($page_data as $page_info)
                                <tr>
                                    <td>{{ $page_info->title }}</td>
                                    <td>
                                        <img style="max-width: 150px;" src="{{ asset($page_info->image) }}" alt="" class="img img-responsive img-fluid">
                                    </td>
                                    <td>
                                        {{ $page_info->summary }}
                                    </td>
                                    <td>
                                        <a href="{{ route('pages.edit', $page_info->id) }}" class="btn btn-success btn-circle">
                                            <i class="fa fa-pencil"></i>
                                        </a>
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
