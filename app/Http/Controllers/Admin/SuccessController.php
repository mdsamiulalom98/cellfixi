<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Success;

class SuccessController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:success-list|success-create|success-edit|success-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:success-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:success-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:success-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Success::orderBy('id', 'DESC')->get();
        return view('backEnd.success.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.success.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'counter' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        Success::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('success.index');
    }

    public function edit($id)
    {
        $edit_data = Success::find($id);
        return view('backEnd.success.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'counter' => 'required',
            'name' => 'required',
        ]);
        $input = $request->all();
        $update_data = Success::find($request->id);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('success.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Success::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Success::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Success::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
