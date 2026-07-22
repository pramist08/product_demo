@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header bg-primary text-white">

            <h4>Add Product</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Image</label>

                    <input type="file"
                        name="image"
                        class="form-control"
                        accept="image/*">

                    @if($product->image)

                    <img src="{{ asset('uploads/products/'.$product->image) }}" width="120">
                    @endif
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <input type="hidden" name="id" value="{{ old('id',$product->id) }}">
                <div class="mb-3">

                    <label>Product Name</label>

                    <input
                        type="text"
                        name="product_name"
                        class="form-control"
                        value="{{ old('name',$product->name) }}">

                    @error('product_name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Price</label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ old('price',$product->price) }}">

                    @error('price')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4">{{ old('description',$product->description) }}</textarea>

                    @error('description')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select
                        name="status"
                        class="form-control">

                        <option value="1" {{ old('status',$product->status)==1?'selected':'' }}>Active</option>

                        <option value="0" {{ old('status',$product->status)==0?'selected':'' }}>Inactive</option>

                    </select>

                </div>

                <button class="btn btn-success">

                    {{ $product->id?'update product' : 'add product' }}

                </button>

                <a href="{{ route('products.index') }}"
                    class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

@endsection