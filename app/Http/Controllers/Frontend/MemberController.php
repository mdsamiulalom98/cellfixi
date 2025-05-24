<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Member;
use App\Models\GeneralSetting;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\Notice;
use App\Models\Notification;
use App\Models\ServiceType;
use Carbon\Carbon;

class MemberController extends Controller
{
    private function setting()
    {
        return GeneralSetting::select('name')->first();
    }
    public function register()
    {
        return view('frontEnd.layouts.member.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:members',
            'email' => 'required|unique:members',
            'password' => 'required',
            'agree' => 'required',
            'confirmed' => 'required_with::password|same:password',
        ]);
        $max_id = DB::table('members')->max('id');
        $max_id = $max_id ? $max_id + 1 : '1';
        $verify = rand(1111, 9999);
        $store_data = new Member();
        $store_data->name = $request->name;
        $store_data->slug = strtolower(preg_replace('/[\/\s]+/', '-', $request->name . '-' . $max_id));
        $store_data->email = $request->email;
        $store_data->phone = $request->phone;
        $store_data->agree = $request->agree;
        $store_data->status = 0;
        $store_data->verify = $verify;
        $store_data->password = bcrypt($request->password);
        $store_data->save();

        Session::put('verify_phone', $store_data->phone);
        // verify by sms
        $apiKey = 'mPHNEo5pvdzYOfj7cyLJczoNyrSMZB4g0DGuAzBExOo=';
        $clientId = '37574055-f638-4736-87af-c995ad7200ff';
        $senderId = '8809617611899';
        $message = "Dear $store_data->name, Your account verify OTP is $verify. Thanks for using " . $this->setting()->name;
        $mobileNumbers = "88$store_data->phone";
        $isUnicode = '0';
        $isFlash = '0';
        $message = urlencode($message);
        $mobileNumbers = urlencode($mobileNumbers);
        $url = "http://sms.insafhost.com/api/v2/SendSMS?ApiKey=$apiKey&ClientId=$clientId&SenderId=$senderId&Message=$message&MobileNumbers=$mobileNumbers&Is_Unicode=$isUnicode&Is_Flash=$isFlash";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        Toastr::success('Please check your phone for account verify token');
        return redirect()->route('member.verify');
    }
    public function verify()
    {
        return view('frontEnd.layouts.member.verify');
    }
    public function account_verify(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $auth_check = Member::select('id', 'phone', 'verify')->where('phone', Session::get('verify_phone'))->first();
        if ($auth_check->verify == $request->otp) {
            $auth_check->verify = 1;
            $auth_check->status = 1;
            $auth_check->save();

            Auth::guard('member')->loginUsingId($auth_check->id);
            Toastr::success('Your account verified successfully', 'Congratulations!');
            Session::forget('verify_phone');
            return redirect()->route('member.dashboard');
        } else {
            Toastr::error('Your token does not match', 'Failed!');
            return redirect()->back();
        }
    }

    public function login()
    {
        return view('frontEnd.layouts.member.login');
    }
    // login form
    public function signin(Request $request)
    {
        $this->validate($request, [
            'email_phone' => 'required',
            'password' => 'required',
        ]);
        $auth_check = Member::select('id', 'phone', 'email', 'name', 'password', 'verify', 'status', 'twofa')->where('phone', $request->email_phone)->orWhere('email', $request->email_phone)->first();

        $email_phone = $request->email_phone;
        $credentials = [];
        if (filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $email_phone;
        } else {
            $credentials['phone'] = $email_phone;
        }
        $credentials['password'] = $request->password;

        if ($auth_check) {
            if ($auth_check->verify != 1) {
                $verify = rand(1111, 9999);
                $auth_check->verify = $verify;
                $auth_check->save();

                Session::put('verify_phone', $auth_check->phone);
                // verify by sms
                $apiKey = 'mPHNEo5pvdzYOfj7cyLJczoNyrSMZB4g0DGuAzBExOo=';
                $clientId = '37574055-f638-4736-87af-c995ad7200ff';
                $senderId = '8809617611899';
                $message = "Dear $auth_check->name, Your account verify OTP is $verify. Thanks for using " . $this->setting()->name;
                $mobileNumbers = "88$auth_check->phone";
                $isUnicode = '0';
                $isFlash = '0';
                $message = urlencode($message);
                $mobileNumbers = urlencode($mobileNumbers);
                $url = "http://sms.insafhost.com/api/v2/SendSMS?ApiKey=$apiKey&ClientId=$clientId&SenderId=$senderId&Message=$message&MobileNumbers=$mobileNumbers&Is_Unicode=$isUnicode&Is_Flash=$isFlash";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                Toastr::error('Your account not verified, check your phone for OTP', 'Failed');
                return redirect()->route('member.verify');
            } elseif ($auth_check->status == 0) {
                Toastr::error('Your account not active now', 'Failed');
                return redirect()->back();
            } else {
                if (Auth::guard('member')->attempt($credentials)) {
                    if ($auth_check->twofa == 1) {
                        $auth_check->verify = rand(1111, 9999);
                        $auth_check->save();
                        Session::put('verify_2fa', Auth::guard('member')->user()->phone);
                        // verify by sms
                        $url = "https://msg.elitbuzz-bd.com/smsapi";
                        $data = [
                            "api_key" => "C200817461dd7a25cf3924.89247796",
                            "number" => $auth_check->phone,
                            "type" => 'text',
                            "senderid" => "8809612472619",
                            "message" => "Dear $auth_check->name!\r\nYour account verify OTP is $auth_check->verify \r\nThank you for using " . $this->setting()->name
                        ];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        Toastr::success('Please check your phone and verify Two Factor', 'Success');
                        return redirect()->route('member.twofactor');
                    }
                    Toastr::success('You are login successfully', 'Success');
                    return redirect()->route('member.dashboard');
                } else {
                    Toastr::error('Your password does not match', 'Failed');
                    return redirect()->back();
                }
            }
        } else {
            Toastr::error('message', 'Sorry! You have no account');
            return redirect()->back();
        }
    }

    public function twofa_verify()
    {
        return view('frontEnd.layouts.member.twofa_verify');
    }
    public function twoverify_verify(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $auth_check = Member::select('id', 'phone', 'verify')->where('phone', Session::get('verify_2fa'))->first();
        if ($auth_check->verify == $request->otp) {
            $auth_check->verify = 1;
            $auth_check->status = 1;
            $auth_check->save();

            Auth::guard('member')->loginUsingId($auth_check->id);
            Toastr::success('Your account verified successfully', 'Congratulations!');
            Session::forget('verify_2fa');
            return redirect()->route('member.dashboard');
        } else {
            Toastr::error('Your token does not match', 'Failed!');
            return redirect()->back();
        }
    }

    public function dashboard(Request $request)
    {
        return view('frontEnd.layouts.member.dashboard');
    }

    public function profile()
    {
        $profile = Member::find(Auth::guard('member')->user()->id);
        return view('frontEnd.layouts.member.profile', compact('profile'));
    }
    public function settings()
    {
        $profile = Member::find(Auth::guard('member')->user()->id);
        $areas = [];
        $districts = [];
        return view('frontEnd.layouts.member.settings', compact('profile', 'districts', 'areas'));
    }
    public function basic_update(Request $request)
    {
        $update_data = Member::find(Auth::guard('member')->user()->id);
        $update_image = $request->file('image');
        if ($update_image) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/member/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update_data->image;
        }
        $update_data->name = $request->name ?? $update_data->name;
        $update_data->address = $request->address ?? $update_data->address;
        $update_data->image = $fileUrl;
        $update_data->save();
        Toastr::success('Basic info update successfully', 'Success');
        return redirect()->back();
    }
    public function payment_method(Request $request)
    {
        $update_data = MemberMethod::where('member_id', Auth::guard('member')->user()->id)->first();
        if ($update_data) {
            $update_data->bank_id = $request->bank_id ?? $update_data->bank_id;
            $update_data->branch = $request->branch ?? $update_data->branch;
            $update_data->routing = $request->routing ?? $update_data->routing;
            $update_data->account_name = $request->account_name ?? $update_data->account_name;
            $update_data->account_number = $request->account_number ?? $update_data->account_number;
            $update_data->bkash = $request->bkash ?? $update_data->bkash;
            $update_data->nagad = $request->nagad ?? $update_data->nagad;
            $update_data->rocket = $request->rocket ?? $update_data->rocket;
            $update_data->save();
        } else {
            $data_store = new MemberMethod();
            $data_store->member_id = Auth::guard('member')->user()->id;
            $data_store->bank_id = $request->bank_id;
            $data_store->branch = $request->branch;
            $data_store->routing = $request->routing;
            $data_store->account_name = $request->account_name;
            $data_store->account_number = $request->account_number;
            $data_store->bkash = $request->bkash;
            $data_store->nagad = $request->nagad;
            $data_store->rocket = $request->rocket;
            $data_store->save();
        }

        Toastr::success('Basic info update successfully', 'Success');
        return redirect()->back();
    }
    public function change_pass()
    {
        return view('frontEnd.layouts.member.change_password');
    }

    public function password_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);
        $auth_user = Member::find(Auth::guard('member')->user()->id);
        $hashPass = $auth_user->password;
        if (Hash::check($request->old_password, $hashPass)) {
            $auth_user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            Toastr::success('Password changed successfully!', 'Success');
            return redirect()->route('member.dashboard');
        } else {
            Toastr::error('Old password not match!', 'Failed');
            return redirect()->back();
        }
    }

    public function messages()
    {
        $messages = MemberMessage::with('district', 'thana')->where('member_id', Auth::guard('member')->user()->id)->get();
        return view('frontEnd.layouts.member.message', compact('messages'));
    }
    public function forgot_password()
    {
        return view('frontEnd.layouts.member.forgot_password');
    }

    public function forgot_verify(Request $request)
    {
        $auth_info = Member::where('phone', $request->phone)->first();
        if (!$auth_info) {
            Toastr::error('Your phone number not found', 'Failed');
            return back();
        }
        $auth_info->forgot = rand(1111, 9999);
        $auth_info->save();

        $apiKey = 'mPHNEo5pvdzYOfj7cyLJczoNyrSMZB4g0DGuAzBExOo=';
        $clientId = '37574055-f638-4736-87af-c995ad7200ff';
        $senderId = '8809617611899';
        $message = "Dear $auth_info->name, Your account forgot OTP is $auth_info->forgot. Thanks for using " . $this->setting()->name;
        $mobileNumbers = "88$auth_info->phone";
        $isUnicode = '0';
        $isFlash = '0';
        $message = urlencode($message);
        $mobileNumbers = urlencode($mobileNumbers);
        $url = "http://sms.insafhost.com/api/v2/SendSMS?ApiKey=$apiKey&ClientId=$clientId&SenderId=$senderId&Message=$message&MobileNumbers=$mobileNumbers&Is_Unicode=$isUnicode&Is_Flash=$isFlash";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        session::put('verify_phone', $request->phone);
        Toastr::success('Verify OTP send your phone number', 'Success');
        return redirect()->route('member.forgot.reset');
    }

    public function forgot_reset()
    {
        if (!Session::get('verify_phone')) {
            Toastr::error('Something wrong please try again', 'Failed');
            return redirect()->route('member.forgot.password');
        }
        return view('frontEnd.layouts.member.forgot_reset');
    }
    public function forgot_store(Request $request)
    {

        $auth_info = Member::where('phone', session::get('verify_phone'))->first();
        if ($auth_info->forgot != $request->otp) {
            Toastr::error('Failed', 'Your OTP not match');
            return redirect()->back();
        }
        $auth_info->forgot = 1;
        $auth_info->password = bcrypt($request->password);
        $auth_info->save();
        if (Auth::guard('member')->attempt(['phone' => $auth_info->phone, 'password' => $request->password])) {
            Session::forget('verify_phone');
            Toastr::success('You are login successfully', 'success!');
            return redirect()->route('member.dashboard');
        }
    }

    public function member_payment(Request $request)
    {
        $merchatnpay = MemberMethod::where(['member_id' => Auth::guard('member')->user()->id])->first();
        $paycod = Parcel::where(['member_id' => Auth::guard('member')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->sum('cod');
        $delivery_charge = Parcel::where(['member_id' => Auth::guard('member')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->sum('delivery_charge');
        $cod_charge = Parcel::where(['member_id' => Auth::guard('member')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->sum('cod_charge');

        $payments = Payment::where(['user_id' => Auth::guard('member')->user()->id, 'user_type' => 'member'])->latest();
        switch ($request->filter) {
            case 'today':
                $payments = $payments->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $payments = $payments->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
                break;
            case 'month':
                $payments = $payments->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'last-month':
                $payments = $payments->whereMonth('created_at', Carbon::now()->subMonth()->month);
                break;
            case 'year':
                $payments = $payments->whereYear('created_at', Carbon::now()->year);
                break;
            case 'last-year':
                $payments = $payments->whereYear('created_at', Carbon::now()->subYear()->year);
                break;
            default:
                break;
        }
        $payments = $payments->paginate(30);

        return view('frontEnd.layouts.member.payment', compact('paycod', 'delivery_charge', 'cod_charge', 'merchatnpay', 'payments'));
    }
    public function payable_parcel()
    {
        $parcels = Parcel::where(['member_id' => Auth::guard('member')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->select('id', 'name', 'phone', 'address', 'cod', 'delivery_charge', 'cod_charge', 'payable_amount', 'district_id', 'area_id', 'parcel_id', 'member_invoice', 'status', 'payment_status')->get();
        return view('frontEnd.layouts.member.payable', compact('parcels'));
    }
    public function payment_request(Request $request)
    {
        $parcels = Parcel::where(['member_id' => Auth::guard('member')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->select('id', 'member_id', 'status', 'payment_status', 'cod', 'payable_amount', 'delivery_charge', 'cod_charge')->get();

        $memberpay = MemberMethod::where(['member_id' => Auth::guard('member')->user()->id])->with('bankname')->first();

        if ($parcels->sum('payable_amount') == 0) {
            Toastr::error('You have no payable amount', 'failed!');
            return redirect()->back();
        }

        if ($request->payment_method == 'bank') {
            $user_note = 'Bank Name: ' . ($memberpay->bankname ? $memberpay->bankname->name : '') . ', Account Name: ' . $memberpay->account_name . ', Account Number: ' . $memberpay->account_number . ', Routing: ' . $memberpay->routing;
        } elseif ($request->payment_method == 'bkash') {
            $user_note = 'Receive Number: ' . $memberpay->bkash;
        } elseif ($request->payment_method == 'nagad') {
            $user_note = 'Receive Number: ' . $memberpay->nagad;
        } elseif ($request->payment_method == 'rocket') {
            $user_note = 'Receive Number: ' . $memberpay->rocket;
        }

        $payment = new Payment();
        $payment->invoice_id = $this->invoiceIdGenerate();
        $payment->user_id = Auth::guard('member')->user()->id;
        $payment->user_type = 'member';
        $payment->cod = $parcels->sum('cod');
        $payment->payable_amount = $parcels->sum('payable_amount');
        $payment->delivery_charge = $parcels->sum('delivery_charge');
        $payment->cod_charge = $parcels->sum('cod_charge');
        $payment->payment_method = $request->payment_method;
        $payment->user_note = $user_note;
        $payment->status = 'process';
        $payment->save();

        foreach ($parcels as $parcel) {
            $payment_details = new PaymentDetails();
            $payment_details->payment_id = $payment->id;
            $payment_details->parcel_id = $parcel->id;
            $payment_details->cod = $parcel->cod;
            $payment_details->delivery_charge = $parcel->delivery_charge;
            $payment_details->cod_charge = $parcel->cod_charge;
            $payment_details->payable_amount = $parcel->cod - ($parcel->delivery_charge + $parcel->cod_charge);
            $payment_details->save();
            $parcel->payment_status = 'process';
            $parcel->save();
        }

        Toastr::success('Your payment request has been place successfully', 'success!');
        return redirect()->back();
    }

    public function payment_invoice($invoice_id)
    {
        $payment = Payment::where(['user_id' => Auth::guard('member')->user()->id, 'user_type' => 'member', 'invoice_id' => $invoice_id])->with('paymentdetails.parcel', 'member')->first();
        return view('frontEnd.layouts.member.invoice', compact('payment'));
    }

    public function fraud_checker(Request $request)
    {
        $total_parcel = Parcel::where('phone', $request->phone)->count();
        $total_cancel = Parcel::where(['phone' => $request->phone])->whereIn('status', ['8', '9', '10'])->count();
        return view('frontEnd.layouts.member.fraud_checker', compact('total_parcel', 'total_cancel'));
    }
    public function notice(Request $request)
    {
        $notices = Notice::latest()->get();
        $member = Member::select('id', 'read_notices')->find(Auth::guard('member')->user()->id);
        $member->read_notices = json_encode($notices->pluck('id')->toArray());
        $member->save();
        return view('frontEnd.layouts.member.notice', compact('notices'));
    }
    public function notification(Request $request)
    {
        $notifies = Notification::latest()->where(['user_id' => Auth::guard('member')->user()->id, 'user_type' => 'member'])->paginate(30);
        return view('frontEnd.layouts.member.notification', compact('notifies'));
    }
    public function pricing(Request $request)
    {
        $areas = DB::table('thanas')->select('id', 'name', 'status')->where('status', 1)->get();
        $servicetypes = ServiceType::where('status', 1)->get();
        return view('frontEnd.layouts.member.pricing', compact('areas', 'servicetypes'));
    }

    public function consignment_search(Request $request)
    {
        $keyword = $request->keyword;
        $parcels = Parcel::select('id', 'member_id', 'name', 'phone', 'parcel_id')->where('member_id', Auth::guard('member')->user()->id);
        if ($request->keyword) {
            $parcels = $parcels->where('parcel_id', 'LIKE', '%' . $request->keyword . "%")->orWhere('phone', 'LIKE', '%' . $request->keyword . "%");
        }
        $parcels = $parcels->get();
        if (empty($request->keyword)) {
            $parcels = [];
        }
        return view('frontEnd.layouts.member.search', compact('parcels'));
    }

    public function logout()
    {
        Session::flush();
        Toastr::success('You are logout successfully', 'Logout!');
        return redirect()->route('member.login');
    }
    public function generateShopId()
    {
        $lastMember = Member::orderBy('id', 'desc')->first();
        if ($lastMember) {
            $lastId = (int) substr($lastMember->id, -5);
            $newId = $lastId + 1;
        } else {
            $newId = 1;
        }
        return '10000' . str_pad($newId, 1, '0', STR_PAD_LEFT);
    }
    function invoiceIdGenerate()
    {
        do {
            $uniqueId = 'INV-' . date('dmy') . Str::upper(Str::random(6));
            $exists = Payment::where('invoice_id', $uniqueId)->exists();
        } while ($exists);

        return $uniqueId;
    }
}
