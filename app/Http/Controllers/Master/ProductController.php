<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MasterCompany;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $tables = array('master_product');
    protected Product $product;
    protected MasterCompany $company;

    public function __construct(
        Product $product,
        MasterCompany $company,
    )
    {
        $this->perPage = 15;
        $this->product = $product;
        $this->company = $company;
    }

    public function index()
    {
        $data['tables'] = $this->tables;
        $data['main'] = $this->product->paginate($this->perPage);
        $data['company'] = $this->company->all();
        return view('product.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if($user){
            $data['main'] = $this->product->paginate($this->perPage);
            $data['company'] = $this->company->all();
            return view('product.form-create',['data'=>$data]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request) {
            $productCode = $this->getCodeByCompany($request->productcompany);
            // dd($productCode);
            $normalizeBuyPrice = str_replace('.', '', $request->buyPrice); // Hapus titik
            $normalizeSalePrice = str_replace('.', '', $request->salePrice); // Hapus titik
            $addProduct = $this->product->create([
                'product_company_id' => $request->productcompany,
                'product_code' => $productCode,
                'product_name' => $request->productname,
                'product_vol' => $request->productvol,
                'product_price' => $normalizeBuyPrice,
                'product_sale_price' => $normalizeSalePrice
            ]);

            if ($addProduct) {
                return redirect()->route('product')->with('success', 'Data / Produk Berhasil ditambahkan');
            } else {
                return redirect()->route('product')->with('error', 'Data / Produk Gagal ditambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getCodeByCompany($idCompany)
    {
        $nextCode = '000001';
        $findIdComp = $this->company->find($idCompany);
        $companyCode = $findIdComp->company_code;

        $getProductCode = $this->product->latest()->orderBy('product_code','desc')->first();

        if($getProductCode){
            $getNumberProduct = substr($getProductCode->product_code,-6);
            $nextCode = sprintf("%06d", (int)$getNumberProduct + 1);
            // dd($getNumberProduct);
        }

        $getNexProductNumber = $companyCode. date('Y') . date('m'). $nextCode;
        // dd($getNexProductNumber);
        return $getNexProductNumber;
    }
}
