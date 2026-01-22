<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $categorySlug = $request->query('category'); // contoh: coffee / non-coffee / snack
        $search = $request->query('search');

        $products = Product::with('category')
            ->where('is_active', true)
            ->when($categorySlug, function ($query) use ($categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('customer.menu.index', compact('categories', 'products', 'categorySlug', 'search'));
    }
}
