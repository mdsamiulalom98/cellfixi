<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\ServiceQuality;


class ServiceQualityController extends Controller
{

    function __construct()
    {
        // $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = ServiceQuality::orderBy('id', 'DESC')->get();
        return view('backEnd.servicequality.index', compact('data'));
    }
    public function create()
    {
        return view('backEnd.servicequality.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        ServiceQuality::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('servicequalities.index');
    }

    public function edit($id)
    {
        $edit_data = ServiceQuality::find($id);
        return view('backEnd.servicequality.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $update_data = ServiceQuality::find($request->id);
        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('servicequalities.index');
    }

    public function inactive(Request $request)
    {
        $inactive = ServiceQuality::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = ServiceQuality::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = ServiceQuality::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

}
