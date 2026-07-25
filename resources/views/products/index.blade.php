@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">

    <div class="card">

        {{-- Card Header --}}
        <div class="card-header">

            <div class="row align-items-center g-3">

                {{-- Page Title --}}
                <div class="col-12 col-lg-3">
                    <h4 class="mb-0">Product List</h4>
                </div>

                {{-- Action Section --}}
                <div class="col-12 col-lg-9">

                    <div class="d-flex flex-wrap justify-content-lg-end gap-2">

                        {{-- Import Excel Form --}}
                        <form action="{{ route('products.import') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="d-flex flex-wrap gap-2 mb-0">

                            @csrf

                            <input type="file"
                                   name="file"
                                   class="form-control"
                                   accept=".xlsx,.xls,.csv"
                                   required
                                   style="max-width: 250px;">

                            <button type="submit"
                                    class="btn btn-info">
                                Import Excel
                            </button>

                        </form>

                        {{-- Export Excel --}}
                        <a href="{{ route('products.export') }}"
                           class="btn btn-success">
                            Export Excel
                        </a>

                        <a href="{{ route('products.exportpdf') }}"   class="btn btn-danger">
                            Download Pdf
                        </a>

                        {{-- Add Product --}}
                        <a href="{{ route('products.create') }}"
                           class="btn btn-primary">
                            Add Product
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Card Body --}}
        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Error Message --}}
            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Product Table --}}
            <div class="table-responsive">

                <table class="table table-bordered table-striped nowrap"
                       id="productTable"
                       style="width:100%">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Image</th>

                            <th>Name</th>

                            <th>Description</th>

                            <th>Price</th>

                            <th>Status</th>

                            <th>Created At</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($products as $product)

                            <tr>

                                {{-- ID --}}
                                <td>
                                    <!-- {{ $product->id }} -->
                                     {{ $loop->iteration}}
                                </td>


                                {{-- Image --}}
                                <td>

                                    @if($product->image)

                                        <img src="{{ asset('uploads/products/'.$product->image) }}"
                                             width="70"
                                             height="70"
                                             class="rounded"
                                             style="object-fit: cover;">

                                    @else

                                        <span class="text-muted">
                                            No Image
                                        </span>

                                    @endif

                                </td>


                                {{-- Name --}}
                                <td>
                                    {{ $product->name }}
                                </td>


                                {{-- Description --}}
                                <td>
                                    {{ Str::limit($product->description, 50) }}
                                </td>


                                {{-- Price --}}
                                <td>
                                    ₹ {{ number_format($product->price, 2) }}
                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($product->status)

                                        <button type="button"
                                                class="btn btn-success btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#statusModal{{ $product->id }}">

                                            Active

                                        </button>

                                    @else

                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#statusModal{{ $product->id }}">

                                            DeActive

                                        </button>

                                    @endif

                                </td>


                                {{-- Created At --}}
                                <td>
                                    {{ $product->created_at->format('d-m-Y') }}
                                </td>


                                {{-- Action --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- Edit --}}
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-warning btn-sm">

                                            Edit

                                        </a>


                                        {{-- Delete --}}
                                        <a href="{{ route('products.delete', $product->id) }}"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this product?')">

                                            Delete

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



{{-- ========================================= --}}
{{-- Status Confirmation Modals --}}
{{-- ========================================= --}}

@foreach($products as $product)

    <div class="modal fade"
         id="statusModal{{ $product->id }}"
         tabindex="-1"
         aria-labelledby="statusModalLabel{{ $product->id }}"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                {{-- Modal Header --}}
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


                {{-- Modal Body --}}
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


                {{-- Modal Footer --}}
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



@endsection



{{-- ========================================= --}}
{{-- DataTables Script --}}
{{-- ========================================= --}}

@section('scripts')

<script>

    $(document).ready(function () {

        $('#productTable').DataTable({

            responsive: true,

            paging: true,

            searching: true,

            ordering: true,

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],

            language: {

                search: "Search Products:",

                lengthMenu: "Show _MENU_ products",

                info: "Showing _START_ to _END_ of _TOTAL_ products",

                emptyTable: "No products available"

            }

        });

    });

</script>

@endsection