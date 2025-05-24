<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Str;


class AppointmentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:appoinment-list|appoinment-create|appoinment-edit|appoinment-delete', ['only' => ['index','store']]);
         $this->middleware('permission:appoinment-create', ['only' => ['create','store']]);
         $this->middleware('permission:appoinment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:appoinment-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Appointment::orderBy('id','DESC')->get();
        return view('backEnd.appointment.index',compact('data'));
    }

    public function destroy(Request $request)
    {
        $delete_data = Appointment::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
