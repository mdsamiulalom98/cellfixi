<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Models\HowItWork;

class HowItWorkController extends Controller
{

    function __construct()
    {
        // $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = HowItWork::orderBy('id', 'DESC')->get();
        return view('backEnd.howitwork.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.howitwork.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $input = $request->all();
        return $input;
        $image = $request->file('image');
        if ($image) {
            $name =  time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/howitwork/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
        } else {
            $imageUrl = null;
        }
        $input['image'] = $imageUrl;
        HowItWork::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('howitworks.index');
    }

    public function edit($id)
    {
        $edit_data = HowItWork::find($id);
        return view('backEnd.howitwork.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = HowItWork::find($request->hidden_id);
        $image = $request->file('image');
        if ($image) {
            // image with intervention
            $name =  time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/howitwork/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::delete($update_data->image);
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
        } else {
            $input['image'] = $update_data->image;
        }
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('howitworks.index');
    }

    public function inactive(Request $request)
    {
        $inactive = HowItWork::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = HowItWork::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = HowItWork::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
