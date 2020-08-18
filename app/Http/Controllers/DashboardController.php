<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

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


    public function index()
    {
        $sales = $this->sale->all();
        $products = $this->product->all();
        $customers = $this->customer->all();

        return view('dashboard', compact('sales', 'products', 'customers'));
    }
}
