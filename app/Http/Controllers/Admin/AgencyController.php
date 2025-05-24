<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Agency;

class AgencyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:agency-list|agency-create|agency-edit|agency-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:agency-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:agency-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:agency-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Agency::orderBy('id', 'DESC')->get();
        return view('backEnd.agency.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.agency.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        Agency::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('agency.index');
    }

    public function edit($id)
    {
        $edit_data = Agency::find($id);
        return view('backEnd.agency.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
        ]);
        $input = $request->all();
        $update_data = Agency::find($request->id);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('agency.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Agency::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Agency::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Agency::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
