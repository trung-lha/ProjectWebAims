<?php

namespace Modules\OrderModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
class OrderModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('ordermodule::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ordermodule::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $data_product = DB::table('order_detail')->get();
        // dd($data_product);
        return view('ordermodule::showOrderForm')->with('products',$data_product);
    }

    public function addToCart(Request $request)
    {
        // Handle save to database 
        $dataInsert['product_id'] = $request->product_id;
        $dataInsert['order_id'] = $request->product_id;
        $dataInsert['price'] = $request->price;
        $dataInsert['quantity'] = $request->product_qty;
        // dd($dataInsert);
        DB::table('order_detail')->insert($dataInsert);
        // $dataInsert_product = DB::table('order_detail')->where('order_id',$dataInsert['order_id'])->get();
        
        return redirect()->action(
            'OrderModuleController@show', ['data'=> $dataInsert]);
        // return view('ordermodule::showOrderForm')->with('products', $data_product);
    }

    public function updateCart(){
        return view('ordermodule::index');
    }
    public function show_detail($product_id){
        $product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        return view('ordermodule::productDetail')->with('show_detail', $product);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ordermodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
