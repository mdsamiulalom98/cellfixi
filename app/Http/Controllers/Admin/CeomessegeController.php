<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ceomessage;
use Toastr;
use Image;
use File;

class CeomessegeController extends Controller
{
     function __construct()
    {
        $this->middleware('permission:ceomessage-list|ceomessage-create|ceomessage-edit|ceomessage-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:ceomessage-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ceomessage-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ceomessage-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Ceomessage::orderBy('id', 'DESC')->get();
        return view('backEnd.ceomessage.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.ceomessage.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $image = $request->file('image');
        $name = time() . '-' . $image->getClientOriginalName();
        $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
        $name = strtolower(preg_replace('/\s+/', '-', $name));
        $uploadpath = 'public/uploads/ceomessage/';
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

        $input = $request->all();
       
        $input['image'] = $imageUrl;
         //dd($input);

        Ceomessage::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('ceomessages.index');
    }

    public function edit($id)
    {
        $edit_data = Ceomessage::find($id);
        return view('backEnd.ceomessage.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $update_data = Ceomessage::find($request->id);

        $input = $request->all();
        $image = $request->file('image');
        if($image){
            // image with intervention 
            $name =  time().'-'.$image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp',$name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/ceomessage/';
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
        
        $input['status'] = $request->status?1:0;
        //return $input;
        $update_data->update($input);


        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('ceomessages.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Ceomessage::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Ceomessage::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Ceomessage::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
