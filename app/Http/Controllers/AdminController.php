<?php

namespace App\Http\Controllers;

use App\Models\Billno;
use App\Models\Myorder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function orders(Request $request)
    {
        $query = Myorder::query();

        // Global search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('mobile', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('product_name', 'like', "%$search%")
                    ->orWhere('flavour', 'like', "%$search%")
                    ->orWhere('madewith', 'like', "%$search%")
                    ->orWhere('weight', 'like', "%$search%")
                    ->orWhere('weight_type', 'like', "%$search%")
                    ->orWhere('qty', 'like', "%$search%")
                    ->orWhere('payment_method', 'like', "%$search%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'All') {
            $billIds = Billno::where('status', $request->status)->pluck('id')->toArray();
            $query->whereIn('billno_id', $billIds);
        }

        // Fetch & group orders
        $data = $query->orderBy('billno_id', 'desc')->get();
        $billwisedata = [];

        foreach ($data as $info) {
            $billwisedata[$info['billno_id']][0][] = $info;
            $billwisedata[$info['billno_id']][1] = Billno::find($info['billno_id'])['status'];
        }

        return view('admin.order', [
            'data' => $billwisedata,
            'filters' => $request->all(),
        ]);
    }


    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = Myorder::count();
        $totalRevenue = Myorder::sum('finalprice');

        // Order status summary
        $statuses = ['Pending', 'Approved', 'Rejected', 'Order Placed', 'Processing', 'Dispatched', 'Delivered'];
        $orderStatusSummary = [];

        foreach ($statuses as $status) {
            $billIds = Billno::where('status', $status)->pluck('id');
            $count = Myorder::whereIn('billno_id', $billIds)->distinct('billno_id')->count('billno_id');
            $orderStatusSummary[$status] = $count;
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'orderStatusSummary'
        ));
    }

    public function show($billno_id)
    {
        $orders = Myorder::where('billno_id', $billno_id)->get();

        if ($orders->isEmpty()) {
            return redirect('/admin/orders')->with('error', 'Order not found.');
        }

        return view('admin.vieworderdetails', compact('orders'));
    }
}
