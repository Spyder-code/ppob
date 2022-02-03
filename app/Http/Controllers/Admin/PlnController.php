<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlnController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['last_transaction'] = DB::table('table_pln as pl')
            ->leftJoin('table_pln_customer as cs', 'cs.id', '=', 'pl.id_customer')
            ->leftJoin('table_nominal_pln as np', 'np.id', '=', 'pl.id_paket_pln')
            ->select('pl.id', 'np.paket_pln', 'pl.price','cs.nama', 'cs.batas_daya', 'cs.id_pelanggan')
            ->orderBy('pl.created_at','desc')
            // ->limit(3)
            ->paginate(5);
        $data['paket_pln'] = DB::table('table_nominal_pln')->paginate(5);
        $data['customers'] = DB::table('table_pln_customer')->get();
        $data['user'] = DB::table('users')->find(auth()->user()->id);

        return view('admin.datapln.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
