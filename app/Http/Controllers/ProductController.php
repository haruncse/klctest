<?php

namespace App\Http\Controllers;

use App\Models\product;
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
        return view("product.product");
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
        $request->validate([
            'name' => 'required|max:255|unique:products',
            'price' => 'required|numeric',
        ]);
        //return $request;
        //dd($request->all());
        try{
            Product::create($request->all());
            return Product::all();
        }catch(Exception $e){
            return $e->getMessage();
        }
        
        //return json_encode($request);
        //return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $id=$request->input('id');
        $request->validate([
            'name' => 'required|max:255|unique:products,name,'.$id,
            'price' => 'required|numeric',
        ]);

        /*$this->validate($request,[
            'name' => 'required|max:255|unique:products,name,'.$id,
            'price' => 'required|numeric',
        ]);*/
    
        //dd($request->input('id'));
        try{
            $product=Product::findorfail($request->input('id'));

            /*
                $product->name=$request->input('name');
                $product->price=$request->input('price');
                $product->save();
            */

            $product->update($request->all());
            //return redirect('/product');
            return Product::all();
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = Product::findorfail($id);
            if($product){
                $product = Product::destroy($id);
                return Product::all();
            }else{
                return "false";
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    public function productList()
    {
        return Product::all();
    }
}
