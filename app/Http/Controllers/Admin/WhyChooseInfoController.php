<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\WhyChooseInfo;

class WhyChooseInfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:whychooseinfo-list|whychooseinfo-create|whychooseinfo-edit|whychooseinfo-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:whychooseinfo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:whychooseinfo-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:whychooseinfo-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = WhyChooseInfo::orderBy('id', 'DESC')->get();
        return view('backEnd.whychoose.info.index', compact('show_data'));
    }

    public function create()
    {
        return view('backEnd.whychoose.info.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subtitle' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $input = $request->all();
        $user = WhyChooseInfo::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('whychooseinfos.index');
    }

    public function edit($id)
    {
        $edit_data = WhyChooseInfo::find($id);
        return view('backEnd.whychoose.info.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'subtitle' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $input = $request->except('hidden_id');
        $update_data = WhyChooseInfo::find($request->hidden_id);
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('whychooseinfos.index');
    }

    public function inactive(Request $request)
    {
        $inactive = WhyChooseInfo::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = WhyChooseInfo::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = WhyChooseInfo::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
