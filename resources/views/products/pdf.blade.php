<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Product List</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .active {
            color: green;
            font-weight: bold;
        }

        .inactive {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Product List</h2>

    <table>

        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>

            @foreach($products as $key => $product)

            <tr>

                {{-- Counter --}}
                <td>
                    {{ $key + 1 }}
                </td>

                {{-- Product Image --}}
                <td>

                    @if($product->image && file_exists(public_path('uploads/products/' . $product->image)))

                        <img
                            src="{{ public_path('uploads/products/' . $product->image) }}"
                            class="product-image"
                        >

                    @else

                        No Image

                    @endif

                </td>

                {{-- Product Name --}}
                <td>
                    {{ $product->name }}
                </td>

                {{-- Description --}}
                <td>
                    {{ $product->description }}
                </td>

                {{-- Price --}}
                <td>
                    $ {{ number_format($product->price, 2) }}
                </td>

                {{-- Status --}}
                <td>

                    @if($product->status == 1)

                        <span class="active">
                            Active
                        </span>

                    @else

                        <span class="inactive">
                            DeActive
                        </span>

                    @endif

                </td>

                {{-- Created At --}}
                <td>
                    {{ $product->created_at->format('d-m-Y') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>