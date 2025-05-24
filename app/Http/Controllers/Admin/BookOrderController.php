<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookOrder;
use App\Models\OrderStatus;
use App\Models\ShippingCharge;
use Toastr;
use Mail;

class BookOrderController extends Controller
{
    public function index($slug,Request $request){
        if($slug == 'all'){
            $order_status = (object) [
                'name' => 'All',
                'orders_count'=> BookOrder::count(),
            ];
            $show_data = BookOrder::latest();
            
           $show_data = $show_data->paginate(10);
        }else{
            $order_status = OrderStatus::where('slug',$slug)->withCount('bookorders')->first();
            $show_data = BookOrder::where(['order_status'=>$order_status->id])->latest()->paginate(10);
        }
        // return $show_data;
        
        return view('backEnd.bookorder.index',compact('show_data','order_status'));
    }

    public function process($id){
        // return "okkdjdn";
        $data = BookOrder::where(['id'=>$id])->with('bookdetails')->first();
        // return $data;
        $shippingcharge = ShippingCharge::where('status',1)->get();
        return view('backEnd.bookorder.process',compact('data','shippingcharge'));
    }

    public function bookorder_process(Request $request)
    {
        $link = OrderStatus::find($request->status);
        // return $link;
        $order = BookOrder::find($request->id);
        // return $order;
        $courier = $order->order_status;
        $order->order_status = $request->status;
         // return $order;
        $order->save();

         Toastr::success('Success', 'Order status change successfully');
         return redirect('admin/bookorder/' . $link->slug);
    }
     public function destroy(Request $request){
        $order = BookOrder::where('id',$request->id)->delete();
        Toastr::success('Success','Order delete success successfully');
        return redirect()->back();
    }



    public function events_index(Request $request)
    {
        $data = EventRegister::orderBy('id','DESC')->get();
        return view('backEnd.eventregister.index',compact('data'));
    }
    public function events_view($id)
    {
        $edit_data = EventRegister::with('event_des')->find($id);
        // return $edit_data;
        return view('backEnd.eventregister.view',compact('edit_data'));
    }
}
