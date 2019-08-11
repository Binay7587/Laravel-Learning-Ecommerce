@extends('admin.layouts.master')
@section('title', 'Product Management | Admin Nayabazar')
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        Product Lists
                    </div>
                    <a href="{{ route('product.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add Product
                    </a>

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price(NPR. )</th>
                            <th>Discount(%)</th>
                            <th>Brand</th>
                            <th>Vendor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($product_data)
                            @foreach($product_data as $product_info)
                                <tr>
                                    <td>{{ $product_info->title }}</td>
                                    <td>
                                        {{ $product_info->category_info['title'] }}
                                        <sub>
                                            {{ $product_info->child_category_info['title'] }}
                                        </sub>
                                    </td>
                                    <td>
                                        NPR. {{ number_format($product_info->price) }}
                                    </td>
                                    <td>
                                        {{ $product_info->discount }} %
                                    </td>
                                    <td>
                                        {{ $product_info->brand }}
                                    </td>
                                    <td>
                                        {{ $product_info->vendor_info['name'] }}
                                    </td>
                                    <td>{{ ucfirst($product_info->status) }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product_info->id) }}" class="btn btn-success btn-circle float-right">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {{ Form::open(['url'=>route('product.destroy', $product_info->id), 'class'=>'form float-left','onsubmit'=>"return confirm('Are you sure you want to delete this product?')"]) }}
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
