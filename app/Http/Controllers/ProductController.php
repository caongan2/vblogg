<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products =Product::all();
        return view('shop.list',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('shop.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $path = $request->file('image')->store('images','public');
        $product->img =$path;
        $product->name =$request->input('name');
        $product->price =$request->input('price');
        $product->category_id=$request->input('categories');
        $product->user_id=$request->input('user_id');
        $product->save();
        return redirect()->route('product.list');

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
        $product = Product::find($id);
        return  view('shop.update',compact('product'));
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
        $product = Product::find($id);
        if (!$request->hasFile('image')){
            $path = $product->img;
        }else{
            $path = $request->file('image')->store('images','public');
        }
        $data=[
            'name'=>$request->name,
            'price'=>$request->price,
            'category_id'=>$request->categories,
            'user_id'=>$request->user_id,
            'img'=>$path
        ];
        DB::table('products')->where('id',$id)->update($data);
        return redirect()->route('product.list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'Delete success']);
    }
    public function productByCate($id)
    {
        $products = Product::all()->where('category_id',$id);
        return view('shop.list',compact('products'));
    }

    public function productOfUser($id)
    {
        $products =Product::where('user_id',$id)->get();
        return view('shop.list',compact('products'));
    }

    public function search(Request $request)
    {
        $text = $request->name;
        $products = Product::where('name', 'LIKE', '%'.$text.'%')->get();
        return view('shop.result_search', compact('products'));
    }
}
