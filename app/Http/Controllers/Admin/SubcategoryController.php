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

class SubcategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        $category = DB::table("categories")
            ->where("service_category", $request->service_category)
            ->pluck('name', 'id');
        return response()->json($category);
    }

    function __construct()
    {
        $this->middleware('permission:subcategory-list|subcategory-create|subcategory-edit|subcategory-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:subcategory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:subcategory-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:subcategory-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Subcategory::orderBy('id', 'DESC')->select('id', 'name', 'category_id', 'status', 'image')->with('category')->get();
        return view('backEnd.subcategory.index', compact('data'));
    }
    public function create()
    {
        $categories = Category::select('id', 'slug', 'name', 'status')->where('status', 1)->get();
        return view('backEnd.subcategory.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $image = $request->file('image');
        if ($image != NULL) {
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/subcategory/';
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


        $input = $request->all();
        $lastId = Subcategory::max('id') ?? 0;
        $newId = $lastId + 1;
    
        // Generate slug using name and next ID
        $slug = strtolower(preg_replace('/\s+/', '-', $request->name));
        $slug = str_replace('/', '', $slug);
        $slug .= '-' . $newId;
        $input['slug'] = $slug;
        $input['image'] = $imageUrl;
        Subcategory::create($input);
      
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('subcategories.index');
    }

    public function edit($id)
    {
        $edit_data = Subcategory::find($id);
        $categories = Category::select('id', 'slug', 'name', 'status')->where('status', 1)->get();
        return view('backEnd.subcategory.edit', compact('edit_data', 'categories'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
        $update_data = Subcategory::find($request->id);
        $input = $request->all();
        $image = $request->file('image');

        if ($image) {
            // image with intervention
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/subcategory/';
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

        $newId = $request->id;
        $slug = strtolower(preg_replace('/\s+/', '-', $request->name));
        $slug = str_replace('/', '', $slug);
        $input['slug'] = $slug . '-' . $newId;
        $input['status'] = $request->status ? 1 : 0;

        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('subcategories.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Subcategory::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Subcategory::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $subcategory = Subcategory::find($request->hidden_id);
        foreach ($subcategory->childcategories ?? [] as $childCategory) {
            $childCategory->delete();
        }
        foreach ($subcategory->products ?? [] as $product) {
            foreach ($product->variables ?? [] as $variable) {
                File::delete($variable->image);
                $variable->delete();
            }
            foreach ($product->images ?? [] as $image) {
                File::delete($image->image);
                $image->delete();
            }
            foreach ($product->reviews ?? [] as $review) {
                $review->delete();
            }
            foreach ($product->campaigns ?? [] as $campaign) {
                File::delete($product->banner);
                $campaign->delete();
            }
            File::delete($product->image);
            $product->delete();
        }
        File::delete($subcategory->image);
        $subcategory->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
