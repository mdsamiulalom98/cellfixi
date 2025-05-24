<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisitorContact;

class BookingController extends Controller
{
    public function index(Request $request){
        $show_data   = VisitorContact::where(['category' => $request->type ]);

        if($request->keyword){
            $show_data->orWhere('phone',$request->keyword)->orWhere('name',$request->keyword);
        }
        
        $show_data = $show_data->latest();
         //return $show_data->get();
        $show_data = $show_data->paginate(100)->withQueryString();

        return view('backEnd.booking.index',compact('show_data'));
    } 
    public function profile(Request $request){

        $profile = VisitorContact::with('course')->find($request->id);
        //  return $profile;

        return view('backEnd.booking.profile',compact('profile'));
    }
}
