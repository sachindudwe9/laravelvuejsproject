<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\coupon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CouponController extends Controller
{
    //To add Coupon page
    public function AddCoupon()
    {
        return view('addcoupon');
    }

    //to post coupon data
    public function PostCoupon(Request $req)
    {
         $validateData = $req->validate([
             'couponname'=>'required',
             'couponcode'=>'required',
             'discount'=>'required'
         ]);

         if($validateData)
         {
             $couponname = $req->couponname;
             $couponcode = $req->couponcode;
             $discount = $req->discount;
             $coupon = new coupon();
             $coupon->couponname = $couponname;
             $coupon->couponcode = $couponcode;
             $coupon->discount = $discount;
             if($coupon->save())
             {
                 return back()->with('success', 'Coupon Added');
             } 
             else
              {
                 return back()->with('errMsg', 'Coupon Not Added');
             }

         }
    }

    //to show coupon
    public function ShowCoupon()
    {
        $coupon = coupon::all();
        return view('showcoupon',['coupon'=>$coupon]);
    }

    //to delete coupon
    public function DeleteCoupon($id)
    {
        $data = coupon::find($id);
        if($data->delete())
        {
          
                return back()->with('success', 'Coupon deleted');
        
        }
    }

    //to edit coupon
    public function EditCoupon($id)
    {
        $coupondata = coupon::find($id);
        return view('editcoupon',['coupondata'=>$coupondata]);
    }

    //to update coupon

    public function UpdateCoupon(Request $req , $id)
    {

        $validateData = $req->validate(
            [
                'couponname' => 'required',
                'couponcode' =>'required',
                'discount'=>'required'
            ]
        );

        if($validateData)
        {
       $data =  coupon::where('id',$req->id)->update([
            'couponname'=>$req->couponname,
            'couponcode'=>$req->couponcode,
            'discount'=>$req->discount,
        ]);

        if($data)
        {
            return redirect('/showcoupon')->with('success', 'Coupon Updated');
        } 
        else
         {
           return redirect('/showcoupon')->with('errMsg', 'Coupon Not Updated');
         }
    }
  }


}