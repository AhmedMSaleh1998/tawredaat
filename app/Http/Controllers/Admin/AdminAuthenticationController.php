<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\Company;
use App\Models\Unit;
use App\Models\Area;
use App\Models\Country;
use App\Models\Category;
use App\Models\Promocode;
use App\Models\Advertising;
use App\Models\Brand;
use App\Models\Order;
class AdminAuthenticationController extends Controller
{
    public function login()
    {
    	if (Auth::guard('admin')->check())
			return back();
		return view('Admin.auth.login');
	}
	public function home()
	{
        $orders_count = Order::where('cancelled',0)->count();
        $orders_value = Order::where('cancelled',0)->where('order_status_id',4)->sum('total');
		return view('Admin.home',compact('orders_count','orders_value'));
	}

	public function checkLogin()
	{
		$remember = request('rememberme') == 1 ? true: false;
		if(auth()->guard('admin')->attempt(['email'=>request('email'),'password'=>request('password')],$remember)){
			return redirect('admin');
		}else{
			session()->flash('error',"Email and password dosn't match ");
			return redirect('admin/login');
		}
	}
	public function logout()
	{
		auth()->guard('admin')->logout();
		return redirect('admin/login');
	}
}
