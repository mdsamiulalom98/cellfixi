<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\SuccessRate;

class SuccessRateController extends Controller
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
        $data = SuccessRate::orderBy('id', 'DESC')->get();
        return view('backEnd.successrate.index', compact('data'));
    }
    public function create()
    {
        return view('backEnd.successrate.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'count' => 'required',
            'title' => 'required',
        ]);
        // image with intervention

        $input = $request->all();
        SuccessRate::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('successrates.index');
    }

    public function edit($id)
    {
        $edit_data = SuccessRate::find($id);
        return view('backEnd.successrate.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'count' => 'required',
        ]);
        $update_data = SuccessRate::find($request->id);
        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('successrates.index');
    }

    public function inactive(Request $request)
    {
        $inactive = SuccessRate::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = SuccessRate::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = SuccessRate::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

}
