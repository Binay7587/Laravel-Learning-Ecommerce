<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    protected $product = null;
    protected $category = null;
    protected $user = null;

    public function __construct(Product $product, Category $category, User $user)
    {
        $this->user = $user;
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product->getAllProducts();
        return view('admin.pages.product')->with('product_data',$this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = $this->user->where('role','vendor')->orderBy('name','ASC')->pluck('name','id');
        $parent_cats = $this->category->getAllParents();
        return view('admin.pages.product-form')
            ->with('vendor', $vendor)
            ->with('parent_cats',$parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = $this->product->getRules();
        $request->validate($rules);

        $data = $request->all();
        $data['description'] = htmlentities($data['description']);
        $data['slug'] = $this->product->getSlug($request->title);
        $data['is_featured'] = $request->input('is_featured', 0);

        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            $request->session()->flash('success','Product added Successfully.');
        } else {
            $request->session()->flash('error','Sorry! There was problem while adding product.');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->product = $this->product->getProductBySlug($slug);
        if(!$this->product)
        {
            abort(404);
        }

        $cart_quantity = 1;
        if(session('_cart')){
            foreach(session('_cart') as $cart_items){
                if($cart_items['id'] == $this->product->id){
                    $cart_quantity = $cart_items['quantity'];
                }
            }
        }

        return view('front.product-detail')
            ->with('current_count',$cart_quantity)
            ->with('product_detail',$this->product);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error','Sorry! Invalid product id or has been already deleted.');
            return redirect()->route('product.index');
        }

        $vendor = $this->user->where('role','vendor')->orderBy('name','ASC')->pluck('name','id');
        $parent_cats = $this->category->getAllParents();
        return view('admin.pages.product-form')
            ->with('vendor', $vendor)
            ->with('product_data',$this->product)
            ->with('parent_cats',$parent_cats);
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
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error','Sorry! Invalid product id or has been already deleted.');
            return redirect()->route('product.index');
        }

        $rules = $this->product->getRules();
        $request->validate($rules);

        $data = $request->all();

        $data['description'] = htmlentities($data['description']);
        $data['is_featured'] = $request->input('is_featured', 0);
        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            $request->session()->flash('success','Product updated Successfully.');
        } else {
            $request->session()->flash('error','Sorry! There was problem while updating product.');
        }
        return redirect()->route('product.index');
    }

    public function getAllProducts(){
        $parent_cats = $this->category->where('is_parent',1)->where('status','active')->orderBy('title','ASC')->get();
        $this->product = $this->product->where('status','active')->paginate(32);
        return view('front.product-list')->with('all_products',$this->product)->with('parent_cats',$parent_cats);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error','Sorry! Invalid product id or has been already deleted.');
            return redirect()->route('product.index');
        }

        $status = $this->product->delete();
        if($status){
            request()->session()->flash('success','Product Deleted successfully.');
        } else {
            request()->session()->flash('error','Sorry! There was problem while deleting product');
        }
        return redirect()->route('product.index');
    }
}
