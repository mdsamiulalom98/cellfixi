<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use File;
use Str;

class CompanyProfileController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:about-list|about-create|about-edit|about-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:about-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:about-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:about-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = CompanyProfile::orderBy('id', 'DESC')->get();
        return view('backEnd.profile.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.profile.create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'pdf' => 'required|mimes:pdf',
            'status' => 'required',
        ]);

        $input = $request->all();

        
        $fileone = $request->file('pdf');
        $nameone = time().'-'.$fileone->getClientOriginalName();
        $uploadPathone = 'public/uploads/companyprofile/';
        $fileone->move($uploadPathone,$nameone);
        $fileUrlone =$uploadPathone.$nameone;

        $input['pdf'] = $fileUrlone;

        CompanyProfile::create($input);

        Toastr::success('Success', 'Data inserted successfully');
        return redirect()->route('profile.index');
    }



    public function edit($id)
    {
        $edit_data = CompanyProfile::find($id);
        return view('backEnd.profile.edit', compact('edit_data'));
    }

  public function update(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'pdf' => 'nullable|mimes:pdf',
        ]);

        $update_data = CompanyProfile::findOrFail($request->id);
        $input = $request->all();

        $fileone = $request->file('pdf');
        if($fileone){
        $nameone = time().'-'.$fileone->getClientOriginalName();
        $uploadPathone = 'public/uploads/companyprofile/';
        $fileone->move($uploadPathone,$nameone);
        $fileUrlone =$uploadPathone.$nameone;

        $input['pdf'] = $fileUrlone;
        }else{
            $fileUrlone = NULL;
        }

        $input['status'] = $request->status ? 1 : 0;
        $input['pdf'] = $fileUrlone;

        $update_data->update($input);

        Toastr::success('Success', 'Data updated successfully');
        return redirect()->route('profile.index');
    }




    public function inactive(Request $request)
    {
        $inactive = CompanyProfile::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = CompanyProfile::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = CompanyProfile::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
