<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Offer;

class OfferController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:offer-list|offer-create|offer-edit|offer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:offer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:offer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:offer-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Offer::orderBy('id', 'DESC')->get();
        return view('backEnd.offer.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.offer.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'color' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        Offer::create($input);
        Toastr::success('success', 'Data insert offerfully');
        return redirect()->route('offer.index');
    }

    public function edit($id)
    {
        $edit_data = Offer::find($id);
        return view('backEnd.offer.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'color' => 'required',
        ]);
        $input = $request->all();
        $update_data = Offer::find($request->id);
        $update_data->update($input);

        Toastr::success('success', 'Data update offerfully');
        return redirect()->route('offer.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Offer::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('offer', 'Data inactive offerfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Offer::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('offer', 'Data active offerfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Offer::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('offer', 'Data delete offerfully');
        return redirect()->back();
    }
}
