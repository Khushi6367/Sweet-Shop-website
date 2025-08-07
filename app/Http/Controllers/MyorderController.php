<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Billno;
use App\Models\Myorder;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class MyorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Myorder::where('user_id', Auth::user()->id)->orderBy('billno_id', 'desc')->get();
        $billwisedata = [];
        foreach ($data as $info) {
            $billwisedata[$info['billno_id']][0][] = $info;
            $billwisedata[$info['billno_id']][1] = Billno::find($info['billno_id'])['status'];
        }
        return view("myorder.index", ['data' => $billwisedata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Always validate address and payment method
        $request->validate([
            'address' => 'required',
            'payment_method' => 'required|string',
        ]);

        // Additional validation if payment method is Bank
        if ($request->payment_method === 'Bank') {
            $request->validate([
                'utr' => 'required|string',
                'screenshot' => 'required|image',
            ]);
        }

        $billobj = Billno::create([]);
        $data = Cart::where('user_id', Auth::id())->get();

        // Get selected address
        if ($request->address === 'default') {
            $name = Auth::user()->name;
            $address = Auth::user()->address;
            $mobile = Auth::user()->mobile;
        } else {
            $sp = Shipping::find($request->address);
            $name = $sp->name;
            $address = $sp->address;
            $mobile = $sp->mobile;
        }

        // Only upload file if payment method is Bank
        $fileimage = null;
        if ($request->payment_method === 'Bank' && $request->hasFile('screenshot')) {
            $fileimage = time() . "_main_" . $request->screenshot->getClientOriginalName();
            $request->screenshot->move(public_path('images/screenshot'), $fileimage);
        }

        // Store orders
        foreach ($data as $info) {
            Myorder::create([
                'finalprice' => $info->price->finalprice * $info->qty,
                'price' => $info->price->finalprice,
                'discount' => round((($info->price->price - $info->price->finalprice) / $info->price->price * 100), 2),
                'mrp' => $info->price->price,
                'madewith' => $info->price->madewith,
                'weight_type' => $info->price->weight_type,
                'weight' => $info->price->weight,
                'qty' => $info->qty,
                'flavour' => $info->product->flavour,
                'product_name' => $info->product->name,
                'product_id' => $info->product->id,
                'address' => $address,
                'mobile' => $mobile,
                'name' => $name,
                'user_id' => Auth::id(),
                'billno_id' => $billobj->id,
                'payment_method' => $request->payment_method,
                'utr' => $request->payment_method === 'Bank' ? $request->utr : null,
                'screenshot' => $fileimage,
            ]);
        }

        // Clear cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect('/myorder')->with('success', 'Order Placed Successfully!');
    }


    /**
     * Display the specified resource.
     */
    // public function show(Myorder $myorder)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Myorder $myorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Myorder $myorder)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Myorder $myorder)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected,Order Placed,Processing,Dispatched,Delivered',
        ]);

        $myorder = Billno::findOrFail($id);

        $myorder->update(['status' => $request->status]);

        return redirect('/admin/orders')->with('success', 'Order status updated successfully.');
    }

    public function show($billno_id)
    {
        $orders = Myorder::where('billno_id', $billno_id)->get();

        if ($orders->isEmpty()) {
            return redirect('/admin/orders')->with('error', 'Order not found.');
        }

        return view('admin.vieworderdetails', compact('orders'));
    }


    public function downloadInvoice($billno)
    {
        // Get all orders grouped under the billno
        $orders = Myorder::where('billno_id', $billno)
            ->where('user_id', Auth::id()) // ensure user can access only their own invoice
            ->get();

        if ($orders->isEmpty()) {
            abort(404, 'Invoice not found.');
        }

        // Get bill data
        $bill = Billno::findOrFail($billno);

        // Company Info
        $company = [
            'name' => 'Ganpati Industries',
            'address' => 'Road Number 7, Industrial Area, Rani Bazar, Bikaner - 334001, Rajasthan, India',
            'email' => 'gisoanpapdi@gmail.com',
            'phone' => '8239070019, 9887501872',
            'gstin' => '08AOZPP3505Q1ZX',
            'fssai' => '12224017000443',
        ];

        // User info from the first order
        $userInfo = [
            'name' => $orders[0]->name,
            'mobile' => $orders[0]->mobile,
            'address' => $orders[0]->address,
        ];

        // Total calculation
        $total = $orders->sum('finalprice');

        $data = [
            'orders' => $orders,
            'billno' => $billno,
            'userInfo' => $userInfo,
            'company' => $company,
            'total' => $total,
            'created_at' => $bill->created_at,
        ];

        $pdf = FacadePdf::loadView('myorder.invoice', $data)->setPaper('A4');

        return $pdf->download('invoice_' . $billno . '.pdf');
    }

}
