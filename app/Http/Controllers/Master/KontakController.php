<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Auth;
use DB;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $tables = array('contact');
    protected Kontak $kontak;

    public function __construct(
        Kontak $kontak,
    )
    {
        $this->perPage = 15;
        $this->kontak = $kontak;
    }

    public function index()
    {
        $data['tables'] = $this->tables;
        $data['main'] = $this->kontak->paginate($this->perPage);
        return view('kontak.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $auth = Auth::user();
        if($auth){
            return view('kontak.form-create');
        }
        return redirect()->route('kontak')->with('error', 'Anda tidak diizinkan untuk membuka halaman ini!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request) {
            $codeContact = $this->getKontakCode();
            $createKontak = $this->kontak->create([
                'contact_code' => $codeContact,
                'contact_name' => $request->kontakname,
                'contact_store_name' => $request->kontakstore,
                'contact_pic_name' => $request->kontakpic,
                'contact_address' => $request->kontakalamat,
                'contact_number_1' => $request->kontaknumber1,
                'contact_number_2' => $request->kontaknumber2,
                'lattitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            if($createKontak){
                return redirect()->route('kontak')->with('success', 'Kontak Berhasil ditambahkan');
            } else {
                return redirect()->route('product')->with('error', 'Kontak Gagal ditambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kontak $kontak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kontak $kontak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak)
    {
        //
    }

    public function getKontakCode()
    {
        $nextCode = '000001';

        $getCode = $this->kontak->latest()->orderBy('contact_code','desc')->first();

        if($getCode){
            $getNumberCode = substr($getCode->contact_code,-6);
            $nextCode = sprintf("%06d", (int)$getNumberCode + 1);
            // dd($getNumberProduct);
        }

        $getNextNumberCode = 'CNT'. date('Y') . date('m'). $nextCode;
        // dd($getNexProductNumber);
        return $getNextNumberCode;
    }
}
