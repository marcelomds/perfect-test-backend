<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->product->all();

        return view('dashboard', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('crud_products');
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->product->create($request->all());
            $product->save();

            return redirect()->route('dashboard');

        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->product->find($id);

        return view('crud_products', compact('product'));
    }

    /**
     * @param ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = $this->product->find($id);
            $product->update($request->all());

            return redirect()->route('dashboard');

        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $product = $this->product->find($id);
            $product->delete();

            return redirect()->route('dashboard');

        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

}
