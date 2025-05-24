<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class GalleryCatController extends Controller
{
   function __construct()
    {
         $this->middleware('permission:gallery-category-list|gallery-category-create|gallery-category-edit|gallery-category-delete', ['only' => ['index','store']]);
         $this->middleware('permission:gallery-category-create', ['only' => ['create','store']]);
         $this->middleware('permission:gallery-category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:gallery-category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = GalleryCategory::orderBy('id','DESC')->get();
        return view('backEnd.gallerycategory.index',compact('data'));
    }
    public function create()
    {
        $categories = GalleryCategory::orderBy('id','DESC')->select('id','name')->get();
        return view('backEnd.gallerycategory.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);
       
        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        GalleryCategory::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('gallerycategory.index');
    }

    public function edit($id)
    {
        $edit_data = GalleryCategory::find($id);
        return view('backEnd.gallerycategory.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $update_data = GalleryCategory::find($request->id);
        $input = $request->all();
        
        $input['status'] = $request->status?1:0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('gallerycategory.index');
    }

    public function inactive(Request $request)
    {
        $inactive = GalleryCategory::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = GalleryCategory::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = GalleryCategory::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
