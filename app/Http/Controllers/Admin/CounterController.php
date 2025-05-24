<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use DB;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:counter-list|counter-create|counter-edit|counter-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:counter-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:counter-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:counter-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Counter::orderBy('id', 'DESC')->get();
        return view('backEnd.counter.index', compact('show_data'));
    }

    public function create()
    {
        return view('backEnd.counter.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'title' => 'required',
        ]);
        $input = $request->all();
        // image with intervention
        $image = $request->file('image');
        $name = time() . '-' . $image->getClientOriginalName();
        $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
        $name = strtolower(preg_replace('/\s+/', '-', $name));
        $uploadpath = 'public/uploads/counter/';
        $imageUrl = $uploadpath . $name;
        $img = Image::make($image->getRealPath());
        $img->encode('webp', 90);
        $width = '';
        $height = '';
        $img->height() > $img->width() ? $width = null : $height = null;
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($imageUrl);
        $input['image'] = $imageUrl;
        Counter::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('counter.index');
    }

    public function edit($id)
    {
        $edit_data = Counter::find($id);
        return view('backEnd.counter.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'title' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = Counter::find($request->hidden_id);
        $image = $request->file('image');
        if ($image) {
            // image with intervention
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/counter/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = '';
            $height = '';
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
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('counter.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Counter::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Counter::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = Counter::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
