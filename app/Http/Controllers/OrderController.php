<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $pagination = $request->has('pagination') ? $request->pagination : 10;
        if ($q) {
            $orders = Order::where('title', 'like', '%' . $q . '%')->paginate($pagination);
        } else {
            $orders = Order::paginate($pagination);
        }
        // return $orders;
        return view('pages.order', compact('orders', 'q', 'pagination'));
    }
}
