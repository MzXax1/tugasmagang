<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
    
    if ($search) {
        $products = Product::where('name', 'LIKE', "%$search%")->latest()->paginate(5);
    } else {
        $products = Product::latest()->paginate(5);
    }

    $i = ($products->currentPage() - 1) * $products->perPage() + 0;
    return view('products.index', compact('products', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
    $request->validate([
        'name' => 'required',
        'detail' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Mendapatkan file gambar yang diunggah
    $image = $request->file('image');
    
    // Mengunggah gambar ke direktori penyimpanan
    $destinationPath = 'images/';
    $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    $image->move($destinationPath, $profileImage);

    // Membuat entri produk baru
    $product = new Product();
    $product->name = $request->name;
    $product->detail = $request->detail;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->image = $profileImage; // Menyimpan nama file gambar dalam kolom 'image'
    $product->save();

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([

            'name' => 'required',

            'detail' => 'required'

        ]);

    
        $input = $request->all();

    
        if ($image = $request->file('image')) {

            $destinationPath = 'images/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $input['image'] = "$profileImage";

        }else{

            unset($input['image']);

        }

            
        $product->update($input);
      
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Menghapus gambar terkait dari sistem file
        if (Storage::disk('public')->exists('images/' . $product->image)) {
            Storage::disk('public')->delete('images/' . $product->image);
        }
        
        // Menghapus produk dari database
        $product->delete();
        
        return redirect()->route('products.index')
                        ->with('success', 'Product deleted successfully');
    }

    
    
}
