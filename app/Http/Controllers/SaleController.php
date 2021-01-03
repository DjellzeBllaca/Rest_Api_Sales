<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Sale::get(), 200);
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
        try {
            $this->validate($request,
                [
                    'sale_id' => 'required|numeric',
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|numeric|min:1',
                    'unit_price' => 'required',
                ]);

            $sale = new Sale;
            $sale->sale_id = $request->input('sale_id');
            $sale->product_id = $request->input('product_id');
            $sale->quantity = $request->input('quantity');
            $sale->unit_price = $request->input('unit_price');
            $sale->total_price = $request->input('unit_price') * $request->input('quantity');
            $sale->save();

            $code = 201;
            $output = [
                'code'=> $code,
                'message'=>"Sale has been created."
            ];
            }catch(\Exception $e){
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Sale could not be created"
//                    'message'=>$e->getMessage(),
                ];
            }
        return response()->json($output, $code);
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
        try{
            $sale = Sale::find($id);

            if (!$sale) {
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Sale does not exist!"
                ];
            }
            else {
                $this->validate($request,
                    [
                        'sale_id' => 'required|numeric',
                        'product_id' => 'required|exists:products,id',
                        'quantity' => 'required|numeric|min:1',
                        'unit_price' => 'required',
                    ]);

                $sale->sale_id = $request->input('sale_id');
                $sale->product_id = $request->input('product_id');
                $sale->quantity = $request->input('quantity');
                $sale->unit_price = $request->input('unit_price');
                $sale->total_price = $request->input('unit_price') * $request->input('quantity');
                $sale->update();

                $code = 201;
                $output = [
                    'code' => $code,
                    'message' => "Sale updated successfully!"];
            }
        }catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Could not update sale!"
            ];
        }
        return response()->json($output, $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $sale = Sale::find($id);

            if ($sale->delete()){
                $code = 201;
                $output = [
                    'code'=> $code,
                    'message'=>"Sale deleted successfully!"
                ];
            }
            else{
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Sale failed to delete!!"
                ];
            }
        } catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Sale failed to delete!"
            ];
        }
        return response()->json($output, $code);
    }
}