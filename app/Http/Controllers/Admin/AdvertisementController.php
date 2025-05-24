<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use File;

class AdvertisementController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:advertisement-list|advertisement-create|advertisement-edit|advertisement-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:advertisement-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:advertisement-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:advertisement-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Advertisement::orderBy('id', 'DESC')->get();
        return view('backEnd.advertisement.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.advertisement.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $image = $request->file('image');
        $name = time() . '-' . $image->getClientOriginalName();
        $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
        $name = strtolower(preg_replace('/\s+/', '-', $name));
        $uploadpath = 'public/uploads/advertisement/';
        $imageUrl = $uploadpath . $name;
        $img = Image::make($image->getRealPath());
        $img->encode('webp', 90);
        $width = "";
        $height = "";
        $img->height() > $img->width() ? ($width = null) : ($height = null);
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($imageUrl);
        
        
        $image2 = $request->file('image2');
        $name2 =  time().'-'.$image2->getClientOriginalName();
        $name2 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp',$name2);
        $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
        $uploadpath2 = 'public/uploads/advertisement/';
        $image2Url = $uploadpath2.$name2; 
        $img2=Image::make($image2->getRealPath());
        $img2->encode('webp', 90);
        $width2 = '';
        $height2 = '';
        $img2->height() > $img2->width() ? $width2=null : $height2=null;
        $img2->resize($width2, $height2);
        $img2->save($image2Url);
        
        $input['image'] = $imageUrl;
        $input['image2'] = $image2Url;

        $input = $request->except('files');

        $input['image'] = $imageUrl;
        // dd($input);
        Advertisement::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('advertisements.index');
    }

    public function edit($id)
    {
        $edit_data = Advertisement::find($id);
        return view('backEnd.advertisement.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $update_data = Advertisement::find($request->id);

        $input = $request->except('files');
        $image = $request->file('image');
        if($image){
            // image with intervention
            $name =  time().'-'.$image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp',$name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/advertisement/';
            $imageUrl = $uploadpath.$name;
            $img=Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "";
            $height = "";
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
            File::delete($update_data->image);
        }else{
            $input['image'] = $update_data->image;
        }
        
        $image2 = $request->file('image2');
        if($image2){
            // image with intervention 
            $image2 = $request->file('image2');
            $name2 =  time().'-'.$image2->getClientOriginalName();
            $name2 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp',$name2);
            $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
            $uploadpath2 = 'public/uploads/advertisement/';
            $image2Url = $uploadpath2.$name2; 
            $img2=Image::make($image2->getRealPath());
            $img2->encode('webp', 90);
            $width2 = '';
            $height2 = '';
            $img2->height() > $img2->width() ? $width2=null : $height2=null;
            $img2->resize($width2, $height2);
            $img2->save($image2Url);
            $input['image2'] = $image2Url;
        }else{
            $input['image2'] = $update_data->image2;
        }
        
        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);


        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('advertisements.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Advertisement::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Advertisement::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Advertisement::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
