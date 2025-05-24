<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
     function __construct()
    {
        $this->middleware('permission:video-list|video-create|video-edit|video-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:video-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:video-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:video-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Video::orderBy('id', 'DESC')->get();
        return view('backEnd.video.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.video.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'video' => 'required',
            'status' => 'required',
        ]);


        $input = $request->all();

        // dd($input);
        Video::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('videos.index');
    }

    public function edit($id)
    {
        $edit_data = Video::find($id);
        return view('backEnd.video.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'video' => 'required',
            'status' => 'required',
        ]);
        $update_data = Video::find($request->id);

        $input = $request->all();

        $input['status'] = $request->status?1:0;
        $update_data->update($input);


        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('videos.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Video::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Video::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Video::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
