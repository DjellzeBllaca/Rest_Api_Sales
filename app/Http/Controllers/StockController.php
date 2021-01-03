<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Stock::all(), 200);
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
            $this->validate($request, [
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|numeric|min:0',
                'status' => 'boolean',
            ]);

            $stock = new Stock;
            $stock->product_id = $request->input('product_id');
            $stock->quantity = $request->input('quantity');
            $stock->status = $request->input('status');
            $stock->save();

            $code = 201;
            $output = [
                'code'=> $code,
                'message'=>"Stock has been created."];

        }catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Stock could not be created"
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
            $stock = Stock::find($id);
            if (!$stock) {
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Stock does not exist!"
                ];
            }
            else {
                $this->validate($request, [
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|numeric|min:0',
                    'status' => 'boolean',
                ]);

                $stock->product_id = $request->input('product_id');
                $stock->quantity = $request->input('quantity');
                $stock->update();

                $code = 201;
                $output = [
                    'code' => $code,
                    'message' => "Stock updated successfully!"
                ];
            }
        }catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Stock could not updated!"
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
            $stock = Stock::find($id);

            if ($stock->delete()){
                $code = 201;
                $output = [
                    'code'=> $code,
                    'message'=>"Stock deleted successfully!"
                ];
            }
            else{
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Stock failed to delete!!"
                ];
            }
        } catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Stock failed to delete!"
            ];
        }
        return response()->json($output, $code);
    }
}
