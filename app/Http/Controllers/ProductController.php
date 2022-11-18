<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
    	$product = Product::all();
    	return view('welcome', compact('product'));
    }

    public function add()
    {
    	if(Auth::check())
    	{
   			return view('admin.add-product');
   		}
    }

    public function insert(Request $request)
    {
    	if(Auth::check())
    	{
    		$prod = new Product();

    		$prod->name = $request->input('prodname');
    		$prod->slug = $request->input('prodslug');
    		$prod->type = $request->input('prodtype');
    		$prod->amount = $request->input('prodamount');
    		$prod->price = $request->input('prodprice');
    		$prod->description = $request->input('prddesc');

    		$prod->save();

    		return redirect('/')->with('status', "Product Added Successfully");
    	}
    }

    public function edit($id)
    {
    	$products = Product::find($id);
    	return view('admin.edit-product', compact('products'));
    }

    public function update(Request $request, $id)
    {
    	$prod = Product::find($id);

    	$prod->name = $request->input('prodname');
		$prod->slug = $request->input('prodslug');
		$prod->type = $request->input('prodtype');
		$prod->amount = $request->input('prodamount');
		$prod->price = $request->input('prodprice');
		$prod->description = $request->input('prddesc');

		$prod->update();

		return redirect('/')->with('status', "Product Updated Successfully");
    }

    public function delete($id)
    {
    	$prod = Product::find($id);
    	$prod->delete();

    	return redirect('/')->with('status', "Product Deleted Successfully");
    }
}
