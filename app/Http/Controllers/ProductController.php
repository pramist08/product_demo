<?php

namespace App\Http\Controllers;

use App\Http\Controllers\unlink;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $products = Product::where('is_delete', 0)->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        if ($id) {
            $product = Product::findOrFail($id);
        } else {
            $product = new Product();
        }
        //
        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jprg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->id) {

            $product = Product::findOrFail($request->id);
        } else {
            $product = new Product();
        }

        $product->name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
            //  $image = $request->file('image');
            // $imageName = time() . '-' . $image->getClientOriginalName();
            $image = time() . '-' . $request->image->extension();

            $request->image->move(public_path('uploads/products'), $image);
            $product->image = $image;
        }

        //         Product::create([
        //             'name' => $request->product_name,
        // 'price' => $request->price,
        // 'status' => $request->status,
        // 'image' => $imageName


        //         ]);

        $product->save();

        return redirect()->route('products.index')->with("success", "product added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function delete($id)
    {

        // $request->validate([
        //     'id'=>'required|integer|exists:products,id',
        // ]);


        // echo $id; die;
        $product = Product::findOrFail($id);

        $product->is_delete = 1;
        $product->save();

        return redirect()->route('products.index')->with('success', 'product deleted successfully');
    }


    public function update_status($id)
    {

        $product = Product::findOrFail($id);
        //echo $id;die;
        if ($product->status == 0) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'status changed successfully');
    }


    public function export(){
        return Excel::download(
            new ProductsExport,'Products.xlsx'
        );
    }
}
