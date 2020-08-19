<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{

    private $sale;

    private $product;

    private $customer;

    /**
     * DashboardController constructor.
     * @param Sale $sale
     * @param Product $product
     * @param Customer $customer
     */
    public function __construct(Sale $sale, Product $product, Customer $customer)
    {
        $this->sale = $sale;
        $this->product = $product;
        $this->customer = $customer;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sales = $this->sale->with("product")->get();
        $products = $this->product->all();
        $customers = $this->customer->all();

        return view('dashboard', compact('sales', 'products', 'customers'));
    }
}
