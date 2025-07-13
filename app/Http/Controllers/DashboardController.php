<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Expense;

class DashboardController extends Controller
{
  public function index()
{
    // Ambil semua produk
    $products = Product::all();

    // Statistik utama
    $productCount = $products->count();

    $monthlyExpense = Expense::whereMonth('date', now()->month)
        ->whereYear('date', now()->year)
        ->sum('amount');

    $recentExpenses = Expense::latest()->take(5)->get();

    // Statistik tambahan
    $lowStockProducts = $products->where('stock', '<=', 5);
    $mostStockProduct = $products->sortByDesc('stock')->first();
    $highestExpense = Expense::orderByDesc('amount')->first();

    // Data untuk Chart.js (pengeluaran per bulan)
    $expensesRaw = Expense::selectRaw('MONTH(date) as month, SUM(amount) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $expenseLabels = $expensesRaw->pluck('month')->map(function ($m) {
        return date('F', mktime(0, 0, 0, $m, 1));
    });

    $expenseData = $expensesRaw->pluck('total');

    return view('dashboard', [
        'productCount' => $productCount,
        'monthlyExpense' => $monthlyExpense,
        'mostStockProduct' => $mostStockProduct,
        'highestExpense' => $highestExpense,
        'lowStockProducts' => $lowStockProducts,
        'recentExpenses' => $recentExpenses,
        'expenseLabels' => $expenseLabels,
        'expenseData' => $expenseData,
        'products' => $products,
    ]);
}

}