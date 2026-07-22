@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>Product List</h4>

            <a href="{{ route('products.create') }}" class="btn btn-primary">
                Add Product
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

            @endif

            <table class="table table-bordered table-striped" id="productTable">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Image</th>

                        <th>Name</th>
                        <th>description</th>
                        <th>Price</th>


                        <th>Status</th>

                        <th>Created At</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($products as $product)

                    <tr>

                        <td>{{ $product->id }}</td>

                        <td>

                            @if($product->image)

                            <img src="{{ asset('uploads/products/'.$product->image) }}"
                                width="70"
                                height="70"
                                class="rounded">

                            @else

                            No Image

                            @endif

                        </td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>

                        <td>₹ {{ number_format($product->price,2) }}</td>

                        <td>

                            @if($product->status)

                            <!-- <span class="badge bg-success">Active</span> -->



                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal{{ $product->id }}">
                                Active
                            </button>

                            @else

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal{{ $product->id }}">
                                DeActive
                            </button>

                            @endif

                        </td>

                        <td>{{ $product->created_at->format('d-m-Y') }}</td>

                        <td>

                            <a href="{{ route('products.edit',$product->id)  }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="{{ route('products.delete',$product->id) }}" class="btn btn-danger btn-sm">
                                Delete
                            </a>

                        </td>

                    </tr>


                    @endforeach

                    <!-- Status Confirmation Modal -->



                </tbody>

            </table>

            @foreach($products as $product)

            <div class="modal fade"
                id="statusModal{{ $product->id }}"
                tabindex="-1"
                aria-labelledby="statusModalLabel{{ $product->id }}"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="statusModalLabel{{ $product->id }}">
                                Change Product Status
                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>

                        </div>

                        <div class="modal-body">

                            @if($product->status == 1)

                            Are you sure you want to
                            <strong>deactivate</strong>
                            this product?

                            @else

                            Are you sure you want to
                            <strong>activate</strong>
                            this product?

                            @endif

                        </div>

                        <div class="modal-footer">

                            {{-- No Button --}}

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                                No
                            </button>


                            {{-- Yes Button --}}

                            <form action="{{ route('products.status', $product->id) }}"
                                method="POST">

                                @csrf

                                <button type="submit"
                                    class="btn btn-primary">
                                    Yes, Continue
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach



        </div>

    </div>

</div>

@endsection


@section('scripts')

<script>
    $(document).ready(function() {

        $('#productTable').DataTable();

    });
</script>

@endsection