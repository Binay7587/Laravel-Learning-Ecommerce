<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use DB;
use App\Models\Order;
class FrontendController extends Controller
{
    protected $category = null;
    protected $product = null;
    protected $review = null;
    protected $banner = null;

    public function __construct(Category $category, Product $product, Banner $banner, ProductReview $review)
    {
        $this->category = $category;
        $this->product = $product;
        $this->banner = $banner;
        $this->review = $review;

    }

    public function submitReview(Request $request){
        $this->product = $this->product->find($request->product_id);
        if(empty($request->rate) && empty($request->review)){
            return redirect()->back();
        }

        $data = array(
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'rate' => (int)$request->rate,
            'review' => $request->review,
            'status' => 'active'
        );

        $this->review->fill($data);
        $status = $this->review->save();
        if($status){
            $request->session()->flash('success','Thank you for your review. Your review will be published soon.');
        } else {
            $request->session()->flash('error','Sorry! Your review could not be added at this moment. Please contact our administration.');
        }
        return redirect()->route('product-detail',$this->product->slug);

    }

    public function homepage(){
        $this->banner = $this->banner->where('status','active')->orderBy('id','DESC')->limit(5)->get();
        $parent_cats = $this->category->where('is_parent',1)->where('status','active')->orderBy('title','ASC')->get();
        $this->product = $this->product->where('status','active')->where('is_featured','1')->paginate(20);
        return view('front.index')
            ->with('all_products',$this->product)
            ->with('banner',$this->banner)
            ->with('parent_cats',$parent_cats);
    }


    public function addToCart(Request $request){
        $this->product = $this->product->find($request->product_id);
        if(!$this->product){
            return response()->json(['status'=>false,'data'=>null,'msg'=>"Product not found."]);
        }
        $image = explode(",",$this->product->image);

        $current_item = array(
            'id' => $this->product->id,
            'title' => $this->product->title,
            'link' => route('product-detail',$this->product->slug),
            'org_price' => $this->product->price,
            'image' => asset($image[0])
        );


        // session
        //$request->session()->flush();
        //dd(session('_cart'));
        $cart = session('_cart') ? session('_cart') : null;
        // dd($cart);

        $price = $this->product->price;
        if($this->product->discount > 0){
            $price = ($price - (($price * $this->product->discount) / 100));
        }

        $current_item['price'] = $price;

        $current_item['quantity'] = $request->quantity;
        $current_item['total_amount'] = $request->quantity * $price;

        if($cart){
            //dd('here');
            // exist
            $cart_index = null;
            foreach($cart as $index => $cart_item){
                // dd($cart_item);
                if($cart_item['id'] == $request->product_id){
                    $cart_index = $index;
                    break;
                }
            }
            if($cart_index !== null){
                $cart[$cart_index]['quantity'] = $request->quantity;
                $cart[$cart_index]['total_amount'] = $price * $request->quantity;
                if($cart[$cart_index]['quantity'] <= 0){
                    unset($cart[$cart_index]);
                }
            } else {
                $cart[] = $current_item;
            }
            // foreach($cart)
        } else {
            // dd('there');
            $cart[] = $current_item;
        }

        $request->session()->put('_cart',$cart);

        // dd($request->session('_cart'));

        return response()->json(['status'=>true, 'data'=> $cart,'msg'=>'Product added in the cart']);
    }

    public function signup(){
        if(request()->user()){
            return redirect()->route(request()->user()->role);
        }
        return view('front.signup');
    }

    public function showCart(){
        if(session('_cart')) {
            return view('front.cart');
        } else {
            return redirect()->route('all-products');
        }
    }

    public function checkout(Request $request){
       DB::beginTransaction();
        // DB::transaction(function($request){
            $cart = session('_cart');
            if(!$cart){
                // dd('here');
                return redirect()->route('all-products');
            }
            $cart_id = \Str::random(15);
            $sub_total =0;
            foreach($cart as $cart_items){
                $sub_total += $cart_items['total_amount'];
                $cart = array(
                    'cart_id' => $cart_id,
                    'user_id' => $request->user()->id,
                    'product_id' => $cart_items['id'],
                    'quantity' => $cart_items['quantity'],
                    'after_discount' =>$cart_items['price'],
                    'total_amount' => $cart_items['total_amount'],
                    'status' => 'new'
                );

                $cart_obj = new Cart();
                $cart_obj->fill($cart);
                $cart_obj->save();
            }

            $order_data = array(
                'cart_id' => $cart_id,
                'user_id' => $request->user()->id,
                'sub_total' => $sub_total,
                'delivery_charge' => 150,
                'total_amount' => ($sub_total+150),
                'status' => 'new'
            );
            $order = new Order();
            $order->fill($order_data);
            $status = $order->save();
            if($status){
                session()->forget('_cart');
                $request->session()->flash('success','Thank you for your purchase. You will be shortly notified about the status of your order.');
                DB::commit();

                return redirect()->route($request->user()->role);
                // session()->flush();
            } else {
                DB::rollBack();
                $request->session()->flash('error','Sorry! Your order could not be placed at this moment. Please try again later.');
                return redirect()->route('cart');
            }
            /*if($status){
                DB::commit();
            } else {
                DB::rollBack();
            }*/
        //});
    }

    public function esewaPay(){
        $url = "https://uat.esewa.com.np/epay/main";
        $data =[
            'amt'=> 100,
            'pdc'=> 150,
            'psc'=> 0,
            'txAmt'=> 13,
            'tAmt'=> 263,
            'pid'=>'',
            'scd'=> 'epay_payment',
            'su'=>'http://nayabazar.loc/success?q=su',
            'fu'=>'http://nayabazar.loc/failure?q=fu'
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);  //

    }
}
