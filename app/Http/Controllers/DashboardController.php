<?php

namespace App\Http\Controllers;

use App\Models\ConsignorSale;
use App\Models\DetailConsignorSale;
use App\Models\CostTransaction;
use App\Models\DetailCostTransaction;
use Illuminate\Http\Request;
use Auth;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $tables = array('consignors_sale');
    protected ConsignorSale $titipJual;
    protected DetailConsignorSale $detail;
    protected CostTransaction $pengeluaran;
    protected DetailCostTransaction $detailPengeluaran;

    public function __construct(
        ConsignorSale $titipJual,
        DetailConsignorSale $detail,
        CostTransaction $pengeluaran,
        DetailCostTransaction $detailPengeluaran,
    )
    {
        $this->titipJual = $titipJual;
        $this->detailTitip = $detail;
        $this->pengeluaran = $pengeluaran;
        $this->detailPengeluaran = $detailPengeluaran;
    }

    public function index()
    {
        $data = DB::table('consignors_sale')
        ->join('contact', 'consignors_sale.contact_id', '=', 'contact.id')
        ->join('detail_consignor', 'consignors_sale.id', '=', 'detail_consignor.consignor_id')
        ->join('master_product', 'detail_consignor.product_id', '=', 'master_product.id')
        ->select(
            'contact.contact_name AS Toko',
            'master_product.product_name AS Produk',
            DB::raw('SUM(detail_consignor.sold) AS Terjual'),
            DB::raw('ROUND(AVG(detail_consignor.sold), 6) AS AverageDays'),
            DB::raw('CEIL(AVG(detail_consignor.sold) * 1.2) AS Rekomendasi')
        )
        ->whereRaw('MONTH(consignors_sale.consignor_date_store) = MONTH(CURDATE())') // Bulan berjalan
        ->whereRaw('YEAR(consignors_sale.consignor_date_store) = YEAR(CURDATE())')   // Tahun berjalan
        ->groupBy('consignors_sale.contact_id', 'detail_consignor.product_id','contact.contact_name','master_product.product_name')
        ->orderBy('contact.contact_name')
        ->get();

        // Hitung total pendapatan keseluruhan
        $totalPendapatan = DB::table('detail_consignor')
        ->join('consignors_sale', 'detail_consignor.consignor_id', '=', 'consignors_sale.id')
        ->whereRaw('MONTH(consignors_sale.consignor_date_store) = MONTH(CURDATE())')
        ->whereRaw('YEAR(consignors_sale.consignor_date_store) = YEAR(CURDATE())')
        ->sum(DB::raw('detail_consignor.sold * detail_consignor.price'));
        
        $currentMonth = date('m');
        $currentYear = date('Y');
        $cost = $this->pengeluaran
        ->whereMonth('cost_date', '>=', $currentMonth)
        ->whereYear('cost_date', '=', $currentYear)
        ->sum('cost_total_amount');

        // dd($data);
        return view('dashboard', ['data'=>$data,'totalPendapatan' => $totalPendapatan,'cost'=>$cost]);
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
}
