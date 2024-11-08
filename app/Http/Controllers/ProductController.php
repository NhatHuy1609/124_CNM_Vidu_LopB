<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Product\CreateRequest;
use App\Http\Requests\Web\Product\UpdateProductRequest;
use App\Http\Requests\Web\Product\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = $this->productService->getList();
        return view('products.list', ['items' => $products]);
    }

    public function create() {
        $categories = $this->categoryService->getList();
        return view('products.create', ['categories' => $categories]);
    }

    public function edit(Product $product) {
        $categories = $this->categoryService->getList();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function store(StoreProductRequest $storeRequest)
    {
        $requests = $storeRequest->validated();
        $result = $this->productService->create($requests);

        if ($result) {
            return redirect()->route('products.index');
        }

        return redirect()->route('products.index')->with('error', 'Error when creating');
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Product $product, UpdateProductRequest $updateRequest)
    {
        $request = $updateRequest->validated();
        $result = $this->productService->update($product, $request);

        if ($result) {
            return redirect()->route('products.index');
        }

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'msg'=> 'Deleted success',
            'data' => true
        ], 200);
    }
}
