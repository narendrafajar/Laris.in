<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CostTransaction;
use App\Models\DetailCostTransaction;
use Illuminate\Http\Request;
use Auth;
use DB;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $tables = array('cost_transaction');
    protected CostTransaction $pembelian;
    protected DetailCostTransaction $detailPembelian;

    public function __construct(
        CostTransaction $pembelian,
        DetailCostTransaction $detailPembelian,
    )
    {
        $this->perPage = 15;
        $this->pembelian = $pembelian;
        $this->detailPembelian = $detailPembelian;
    }
    public function index()
    {
        $data['tables'] = $this->tables;
        $data['main'] = $this->pembelian->paginate($this->perPage);
        return view('pembelian.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('pembelian.form-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $strCostTransaction = DB::transaction(function () use ($request) {
            $currentTime = date('H:i:s');
            $transactionDate = $request->dateCost.' '.$currentTime;
            $transactionDateTime = new \DateTime($transactionDate);
            $costCode = $this->getCostCode();
            $storeCost = $this->pembelian->create([
                'cost_code' => $costCode,
                'cost_date' => $transactionDateTime,
                'vendor_name' => $request->vendorName,
                'vendor_name' => $request->vendorName,
            ]);

            $costList = $request->daftarCost;
            $totalCostAmount = 0;
            foreach ($costList as $key => $value) {
                
                $totalCostAmount += $value['costPrice'];
                
                $storeDetail = $this->detailPembelian->create([
                    'cost_id' => $storeCost->id,
                    'items_name' => $value['costProduct'],
                    'items_type' => $value['costType'],
                    'items_amount' => $value['costQty'],
                    'items_volume' => $value['costVol'],
                    'items_price' => $value['costPrice']
                ]);
            }

            $updateTotalAmount = $this->pembelian->where('id',$storeCost->id)
            ->update([
                'cost_total_amount' => $totalCostAmount
            ]);

            return 'success';
        });
        if ($strCostTransaction) {
            return json_encode('success');
        } 
        else {
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CostTransaction $costTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostTransaction $costTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CostTransaction $costTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostTransaction $costTransaction)
    {
        //
    }

    public function getCostCode()
    {
        $nextCode = '000001';

        $getCode = $this->pembelian->latest()->orderBy('cost_code','desc')->first();

        if($getCode){
            $getNumberCode = substr($getCode->cost_code,-6);
            $nextCode = sprintf("%06d", (int)$getNumberCode + 1);
            // dd($getNumberProduct);
        }

        $getNextNumberCode = 'TRC'. date('Y') . date('m'). $nextCode;
        // dd($getNexProductNumber);
        return $getNextNumberCode;
    }

    public function detail($id)
    {
        $data['main'] = $this->pembelian->find($id);
        $totalItems = 0;
        if ($data['main']) {
            $data['detail'] = $this->detailPembelian->where('cost_id',$data['main']->id)->get();
            foreach ($data['detail'] as $key => $value) {
               $totalItems += $value->items_amount;
            }
        }
        return view('pembelian.detail-pembelian',['data'=>$data,'totalItems'=>$totalItems]);
    }
}
