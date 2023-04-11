<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monthlySales = DB::table('order_items')
            ->join('order_details', 'order_items.order_id', '=', 'order_details.id')
            ->select(DB::raw('DATE_FORMAT(order_details.created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total_sales'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->first();
        $monthlyOrders = DB::table('order_details')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->first();
        $totalProducts = DB::table('products')->count();
        $totalCustomers = DB::table('users')->count();


        ///CHART DATA
        $sales = DB::table('order_items')
            ->select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as total_sales'))
            ->groupBy('month')
            ->get();
        $newOrders = DB::table('order_details')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total_orders'))
            ->groupBy('month')
            ->get();
        $currentMonthTotal = DB::table('payment_details')
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->sum('amount');
        $lastMonthTotal = DB::table('payment_details')
            ->whereMonth('created_at', '=', Carbon::now()->subMonth(1)->month)
            ->whereYear('created_at', '=', Carbon::now()->subMonth(1)->year)
            ->sum('amount');


        return response()->json([
            'monthlySales' => $monthlySales,
            'monthlyOrders' => $monthlyOrders,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'chart_data' => [
                'sales' => $sales,
                'lastMonthTotal' => $lastMonthTotal,
                'currentMonthTotal' => $currentMonthTotal,
                'newOrders' => $newOrders,
                'totalProducts' => $totalProducts,
            ]
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
