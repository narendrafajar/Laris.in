<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\ConsignorSale;
use App\Models\DetailConsignorSale;
use App\Models\MasterCompany;
use App\Models\Product;
use App\Models\Kontak;
use Auth;
use DB;
use Illuminate\Http\Request;

class ConsignorSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $tables = array('consignors_sale');
    protected Kontak $kontak;
    protected ConsignorSale $titipJual;
    protected MasterCompany $company;
    protected Product $product;
    protected DetailConsignorSale $detail;

    public function __construct(
        Kontak $kontak,
        ConsignorSale $titipJual,
        MasterCompany $company,
        Product $product,
        DetailConsignorSale $detail,
    )
    {
        $this->perPage = 15;
        $this->kontak = $kontak;
        $this->titipJual = $titipJual;
        $this->company = $company;
        $this->product = $product;
        $this->detailTitip = $detail;
    }

    public function index()
    {

        $data['tables'] = $this->tables;
        $data['main'] = $this->titipJual->paginate($this->perPage);
        foreach ($data['main'] as $key => $value) {
            $idConsignor = $value->id;
            $totalPenjualan = 0;
            $subtotal = 0;
            $findDetail = $this->detailTitip->where('consignor_id',$idConsignor)->where('sold','>',0)->get();
            foreach ($findDetail as $keyDetail => $valueDetail) {
                $subtotal = $valueDetail->price * $valueDetail->sold;
                $totalPenjualan += $subtotal;
                $data['main'][$key]['totalPenjualan'] = $totalPenjualan;
            }
            $subtotal = 0;
        }
        return view('penjualan-titip.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['company'] = $this->company->all();
        $data['kontak'] = $this->kontak->all();
        return view('penjualan-titip.form-create',['data'=>$data]);
    }

    public function getProduct(Request $request,$id)
    {
        $jsonGetProduct = [];

        $jsonGetProduct['product'] = $this->product->where('product_company_id',$id)->get();

        return json_encode( $jsonGetProduct);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $storeTransaction = DB::transaction(function () use ($request) {
            $transactionDate = now();
            $csgCode = $this->getConsignorCode();

            $storeConsignor = $this->titipJual->create([
                'consignor_code' => $csgCode,
                'contact_id' => $request->vendorId,
                'consignor_date_store' => $transactionDate
            ]);

            $totalConsignor = 0;
            $totalItem = count($request->daftarProduk);
            foreach ($request->daftarProduk as $key => $value) {
                $subtotal = $value['productQty'] * $value['productPrice'];
                $totalConsignor += $subtotal;
                $storeDetail = $this->detailTitip->create([
                    'consignor_id' => $storeConsignor->id,
                    'product_id' => $value['idProduct'],
                    'qty' => $value['productQty'],
                    'price' => $value['productPrice'],
                    'subtotal' => $subtotal,
                ]);
                $subtotal = 0;
            }

            $updateConsignor = $this->titipJual->where('id',$storeConsignor->id)->update([
                'consignor_total_amount' => $totalConsignor,
                'consignor_item_total' => $totalItem,
            ]);
            return 'success';
        });
        if ($storeTransaction) {
            return json_encode('success');
        } 
        else {
            return false;
        }
    }

    public function complete_consignors(Request $request,$id)
    {
        // dd($id);
        $data['main'] = $this->titipJual->find($id);
        $data['detail'] = $this->detailTitip->where('consignor_id',$id)->get();
        return view('penjualan-titip.complate-consignor',['data'=>$data]);
    }

    public function updateComplete(Request $request)
    {
        // dd($request->soldQty);
        $soldQuantities = $request->soldQty;
        
        foreach ($soldQuantities as $id => $soldQty) {
            $detail = DetailConsignorSale::find($id);
            $remainingQty = $detail->qty - $soldQty; // Hitung sisa
            $updateDetail = $this->detailTitip->where('id',$id)->update([
                'sold' => $soldQty,
                'remaining' => $remainingQty
            ]);
        }

        $updateConsignor = $this->titipJual->where('id',$request->idConsignor)->update([
            'consignor_stats' => 'CLEAR',
            'consignor_date_pickup' => date(now())
        ]);

        if ($updateConsignor) {
            return redirect()->route('jual_titip')->with('success', 'Titipan Penjualan Berhasil di selesaikan');
        } else {
            return redirect()->route('product')->with('error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsignorSale $consignorSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsignorSale $consignorSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsignorSale $consignorSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsignorSale $consignorSale)
    {
        //
    }

    public function detail_consignors($id)
    {
        $data['main'] = $this->titipJual->find($id);
        if($data['main']){
            $data['detail'] = $this->detailTitip->where('consignor_id',$id)->get();
        }
        return view('penjualan-titip.detail-cosignor',['data'=>$data]);
    }

    public function getConsignorCode()
    {
        $nextCode = '000001';

        $getCode = $this->titipJual->latest()->orderBy('consignor_code','desc')->first();

        if($getCode){
            $getNumberCode = substr($getCode->consignor_code,-6);
            $nextCode = sprintf("%06d", (int)$getNumberCode + 1);
            // dd($getNumberProduct);
        }

        $getNextNumberCode = 'CSG'. date('Y') . date('m'). $nextCode;
        // dd($getNexProductNumber);
        return $getNextNumberCode;
    }

    public function delete(Request $request)
    {
        // dd($request->all());
        $findTransaction = $this->titipJual->find($request->id);
        if($findTransaction){
            $deleteTransaction = DB::transaction(function() use ($findTransaction){

                if($findTransaction){
                    $getDetail = $this->detailTitip->where('consignor_id',$findTransaction->id)->delete();
                    $findTransaction->delete();
                    return $findTransaction->id;
                }
            });

            if($deleteTransaction){
                return response()->json([
                    'message' => 'Transaksi berhasil dihapus',
                    'url' => '/consignor-sale'
                ]);
            }
            return response()->json([
                'message' => 'Transaksi gagal dihapus'
            ], 400);
        }
        return response()->json([
            'message' => 'Transaksi tidak ditemukan'
        ], 404);
    }
}
