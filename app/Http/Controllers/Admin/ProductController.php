<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Product;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    public function getSubcategory(Request $request)
    {
        $subcategory = DB::table("subcategories")
            ->where("category_id", $request->category_id)
            ->pluck('name', 'id');
        return response()->json($subcategory);
    }

    public function index(Request $request)
    {
        $data = Product::latest()->select('id', 'name', 'category_id', 'new_price', 'best_selling', 'status', 'image', 'stock')->with( 'category');
        if ($request->keyword) {
            $data = $data->where('name', 'LIKE', '%' . $request->keyword . "%");
        }
        $data = $data->paginate(50);
        return view('backEnd.product.index', compact('data'));
    }



    public function create()
    {
        $categories = Category::where('status', 1)->select('id', 'name', 'status')->get();

        return view('backEnd.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        if ($image != NULL) {
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/product/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "";
            $height = "";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
        } else {
            $imageUrl = NULL;
        }


        $max_id = DB::table('products')->max('id');
        $max_id = $max_id ? $max_id + 1 : '1';
        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/[\/\s]+/', '-', $request->name . '-' . $max_id));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['image'] = $imageUrl;
        $input['status'] = $request->status ? 1 : 0;
        $input['stock_status'] = $request->stock_status ? 1 : 0;

        Product::create($input);

        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $edit_data = Product::find($id);
        $categories = Category::where('status', 1)->select('id', 'name', 'status')->get();
        $subcategory = Subcategory::where('category_id', '=', $edit_data->category_id)->select('id', 'name', 'category_id', 'status')->get();
        return view('backEnd.product.edit', compact('edit_data', 'categories', 'subcategory'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $update_data = Product::find($request->id);
        $input = $request->except(['image', 'product_type', 'files', 'sizes', 'colors', 'purchase_prices', 'old_prices', 'new_prices', 'stocks', 'images', 'up_id', 'up_sizes', 'up_colors', 'up_purchase_prices', 'up_old_prices', 'up_new_prices', 'up_stocks', 'up_images', 'pro_barcodes', 'up_pro_barcodes']);


        $last_id = Product::orderBy('id', 'desc')->select('id')->first();


        $image = $request->file('image');
        if ($image) {
            // image with intervention
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/product/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "";
            $height = "";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
            File::delete($update_data->image);
        } else {
            $input['image'] = $update_data->image;
        }

        $input['slug'] = strtolower(preg_replace('/[\/\s]+/', '-', $request->name . '-' . $update_data->id));
        $input['status'] = $request->status ? 1 : 0;
        $input['best_selling'] = $request->best_selling ? 1 : 0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('products.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Product::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Product::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Product::find($request->hidden_id);
        foreach ($delete_data->variables as $variable) {
            File::delete($variable->image);
            $variable->delete();
        }
        foreach ($delete_data->images as $pimage) {
            File::delete($pimage->image);
            $pimage->delete();
        }
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
    public function imgdestroy(Request $request)
    {
        $delete_data = Productimage::find($request->id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
    public function pricedestroy(Request $request)
    {
        $delete_data = ProductVariable::find($request->id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Product price delete successfully');
        return redirect()->back();
    }
    public function update_deals(Request $request)
    {
        $products = Product::whereIn('id', $request->input('product_ids'))->update(['best_selling' => $request->status]);
        return response()->json(['status' => 'success', 'message' => 'Hot deals product status change']);
    }
    public function update_feature(Request $request)
    {
        $products = Product::whereIn('id', $request->input('product_ids'))->update(['feature_product' => $request->status]);
        return response()->json(['status' => 'success', 'message' => 'Feature product status change']);
    }
    public function update_status(Request $request)
    {
        $products = Product::whereIn('id', $request->input('product_ids'))->update(['status' => $request->status]);
        return response()->json(['status' => 'success', 'message' => 'Product status change successfully']);
    }
    public function barcode_update(Request $request)
    {
        $products = ProductVariable::whereIn('id', $request->input('product_ids'))->update(['status' => $request->status]);
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function barcodess(Request $request)
    {
        $products = ProductVariable::get();
        foreach ($products as $product) {
            $product->pro_barcode = str_pad($product->id, 8, '1', STR_PAD_LEFT);
            $product->save();
        }
    }

    public function purchase_list()
    {
        $purchase = PurchaseDetails::with('product')->latest()->paginate(100);
        return view('backEnd.product.purchase_list', compact('purchase'));
    }
    public function purchase_create()
    {
        $data = Product::select('id', 'name', 'status', 'new_price', 'type')->latest()->get();
        return view('backEnd.product.purchase_create', compact('data'));
    }
    public function purchase_store(Request $request)
    {
        $product = Product::select('id', 'name', 'old_price', 'status', 'purchase_price', 'new_price', 'type')->where('id', $request->product_id)->first();
        if ($product) {
            $product = Product::select('id', 'name', 'old_price', 'status', 'purchase_price', 'new_price', 'type')->where('id', $request->product_id)->first();
            $product->stock = +$request->qty;
            $product->save();

            $parchase = new PurchaseDetails();
            $parchase->product_id = $product->id;
            $parchase->purchase_price = $product->purchase_price;
            $parchase->old_price = $product->old_price;
            $parchase->new_price = $product->new_price;
            $parchase->stock = $request->qty;
            $parchase->save();

        } else {
            $product = ProductVariable::where('id', $request->product_id)->first();
            $product->stock = +$request->qty;
            $product->save();

            $parchase = new PurchaseDetails();
            $parchase->product_id = $product->product_id;
            $parchase->color = $product->color;
            $parchase->size = $product->size;
            $parchase->purchase_price = $product->purchase_price;
            $parchase->old_price = $product->old_price;
            $parchase->new_price = $product->new_price;
            $parchase->stock = $request->qty;
            $parchase->save();
        }
        Toastr::success('Success', 'Product purchase successfully');
        return redirect()->back();
    }

}
