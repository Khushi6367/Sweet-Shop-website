<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Price;
use App\Models\Media;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('product.index');
    }
    public function listing()
    {
        //
        $data = Product::with(['price', 'media'])->get();
        return view('product.listing', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->name = trim($request->name);
        $request->validate([
            'name' => 'required|min:3|max:40',
            'flavour' => 'required|min:3|max:40',
            'main_image' => 'required|image',
            'other_image.*' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi',


        ]);
        $fileimage = time() . "_main_" . ($request->main_image->getClientOriginalName());
        $request->main_image->move("./images", $fileimage);
        $productinfo = [
            'name' => $request->name,
            'flavour' => $request->flavour,
            'description' => $request->description,
            'main_image' => $fileimage
        ];
        $productobject = Product::create($productinfo);
        $n = count($request->price['madewith']);
        for ($i = 0; $i < $n; $i++) {
            $priceinfo = [
                'product_id' => $productobject->id,
                'madewith' => $request->price['madewith'][$i],
                'weight' => $request->price['weight'][$i],
                'weight_type' => $request->price['weight_type'][$i],
                'price' => $request->price['price'][$i],
                'finalprice' => $request->price['finalprice'][$i],
                'shelflife' => $request->price['shelflife'][$i],
                'ingredients' => $request->price['ingredients'][$i],
            ];
            Price::create($priceinfo);
        }
        $m = count($request->other_image);
        for ($i = 0; $i < $m; $i++) {
            $fileimage = time() . "_other_" . ($request->other_image[$i]->getClientOriginalName());
            $tpy = $request->other_image[$i]->getClientMimeType();
            $request->other_image[$i]->move("./images", $fileimage);

            $ofile = [
                'product_id' => $productobject->id,
                'file_path' => $fileimage,
                'file_type' => substr($tpy, 0, strpos($tpy, '/'))
            ];
            Media::create($ofile);
        }
        return redirect("/product/adminlisting")->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //

        return view('product.show', ['info' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('product.edit', ['info' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, Product $product)
    {
        // Validation
        $request->validate([
            'name' => 'required|min:3|max:40',
            'flavour' => 'required|min:3|max:40',
            'main_image' => 'nullable|image',
            'other_image.*' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi',
        ]);

        // Update product details
        $product->update([
            'name' => trim($request->name),
            'flavour' => $request->flavour,
            'description' => $request->description,
            'availability' => $request->availability,
        ]);

        // Handling Main Image Update
        if ($request->hasFile('main_image')) {
            // Delete old main image if exists
            if ($product->main_image && file_exists(public_path('images/' . $product->main_image))) {
                unlink(public_path('images/' . $product->main_image));
            }

            // Upload new main image
            $fileimage = time() . "_main_" . $request->main_image->getClientOriginalName();
            $request->main_image->move(public_path('images'), $fileimage);
            $product->update(['main_image' => $fileimage]);
        }

        // Update price details if available
        if (isset($request->price['madewith'])) {
            $n = count($request->price['madewith']);
            foreach ($product->price as $index => $price) {
                if ($index < $n) {
                    $price->update([
                        'madewith' => $request->price['madewith'][$index],
                        'weight' => $request->price['weight'][$index],
                        'weight_type' => $request->price['weight_type'][$index],
                        'price' => $request->price['price'][$index],
                        'finalprice' => $request->price['finalprice'][$index],
                        'shelflife' => $request->price['shelflife'][$index],
                        'ingredients' => $request->price['ingredients'][$index],
                        'availability' => (string) $request->input('availability', 'active'),
                    ]);
                }
            }
        }

        // Handling Other Images Update (Delete old ones before uploading new ones)
        if ($request->hasFile('other_image')) {
            // Delete existing media files
            foreach ($product->media as $media) {
                if (file_exists(public_path('images/' . $media->file_path))) {
                    unlink(public_path('images/' . $media->file_path));
                }
                $media->delete();
            }

            // Upload and store new media files
            foreach ($request->file('other_image') as $file) {
                $fileimage = time() . "_other_" . $file->getClientOriginalName();
                $tpy = $file->getClientMimeType();
                $file->move(public_path('images'), $fileimage);

                Media::create([
                    'product_id' => $product->id,
                    'file_path' => $fileimage,
                    'file_type' => substr($tpy, 0, strpos($tpy, '/')),
                ]);
            }
        }

        return redirect('/product/adminlisting')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    public function adminlisting()
    {
        $data = Product::with(['price', 'media'])->get();

        return view('product.adminlisting', compact('data'));
    }

    public function search()
    {
        $products = Product::all();
        $search = request('query');
        $info = Product::where('name', 'like', '%' . $search . '%')
            ->orWhere('flavour', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereHas('price', function ($query) use ($search) {
                $query->where('madewith', 'like', '%' . $search . '%')
                    ->orWhere('weight', $search);
            })
            ->get();

        // dd($info);
        return view('product.search', compact('products'));
    }
}
