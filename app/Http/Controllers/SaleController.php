<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\SaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * @var Product
     */
    private $product;
    /**
     * @var Sale
     */
    private $sale;
    /**
     * @var Customer
     */
    private $customer;

    /**
     * SaleController constructor.
     * @param Sale $sale
     * @param Product $product
     * @param Customer $customer
     */
    public function __construct(Sale $sale, Product $product, Customer $customer)
    {
        $this->product = $product;
        $this->sale = $sale;
        $this->customer = $customer;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = $this->product->all();
        $sales = $this->sale->all();

        return view('crud_sales', compact('products', 'sales'));
    }


    public function store(SaleRequest $saleRequest, CustomerRequest $customerRequest)
    {
        $customer = $this->customer->create($customerRequest->all());
        $customer->save();

        $customer_id = $this->customer->customerId();

        $sale = $this->sale->create([
            'product_id' => $saleRequest->product_id,
            'customer_id' => $customer_id,
            'saleDate' => $saleRequest->saleDate,
            'quantity' => $saleRequest->quantity,
            'discount' => $saleRequest->discount,
            'status'    => $saleRequest->status
        ]);

        $sale->save();

        return redirect()->route('dashboard');

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $sale = $this->sale->find($id);
        $customer = $this->customer->find($id);
        $sales = $this->sale->all();
        $products = $this->product->all();

        return view('crud_sales', compact('sale', 'customer', 'sales', 'products'));
    }

    /**
     * @param SaleRequest $saleRequest
     * @param CustomerRequest $customerRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaleRequest $saleRequest, CustomerRequest $customerRequest, $id)
    {
        $sale = $this->sale->find($id);
        $sale->update($saleRequest->all());

        $customer = $this->customer->find($id);
        $customer->update($customerRequest->all());

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
