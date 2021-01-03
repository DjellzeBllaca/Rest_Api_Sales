<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'category' => 'required|max:255',
                'name' => 'required|min:2|max:255',
                'barcode' => 'required|unique:products',
                'description' => 'max:255',
                'price' => 'required',
                'status' => 'boolean',
            ]);

            $product = new Product;
            $product->category = $request->input('category');
            $product->name = $request->input('name');
            $product->barcode = $request->input('barcode');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->status = $request->input('status');
            $product->save();

            $code = 201;
            $output = [
                'code'=> $code,
                'message'=>"Product has been created successfully."
            ];
        }catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Error: Product could not be created."
            ];
        }
        return response()->json($output, $code);
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
            $product = Product::find($id);
            if (!$product) {
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Product does not exist!"
                ];
            }
            else {
                $this->validate($request, [
                    'category' => 'required|max:255',
                    'name' => 'required|min:2|max:255',
                    'barcode' => 'required|unique:products',
                    'description' => 'max:255',
                    'price' => 'required',
                    'status' => 'boolean'
                ]);

                $product->category = $request->input('category');
                $product->name = $request->input('name');
                $product->barcode = $request->input('barcode');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->status = $request->input('status');
                $product->update();

                $code = 201;
                $output = [
                    'code' => $code,
                    'message' => "Product updated successfully!"];
            }
        }catch (\Exception $e) {
            $code = 409;
            $output = [
                'code'=> $code,
                'message'=>"Could not update product"
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
            $product = Product::find($id);

            if ($product->delete()){
                $code = 201;
                $output = [
                    'code'=> $code,
                    'message'=>"Product deleted successfully!"
                ];
            }
            else{
                $code = 409;
                $output = [
                    'code'=> $code,
                    'message'=>"Product failed to delete!!"
                ];
            }
        } catch (\Exception $e) {
            $code = 400;
            $output = [
                'code'=> $code,
                'message'=>"Product failed to delete!"
            ];
        }
        return response()->json($output, $code);
    }
}
