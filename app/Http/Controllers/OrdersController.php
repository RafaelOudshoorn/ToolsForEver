<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use App\Models\Category;
use App\Models\shopping_card;
use App\Models\Order;
use App\Models\Order_products;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
        }else{
            $id = 0;
        }
        $winkelwagen = DB::table('shopping_cards')
            ->join('products', 'shopping_cards.product_id', 'products.id')
            ->select('shopping_cards.id as id','shopping_cards.total','products.name','products.price','products.id as product_id','products.image')
            ->where('shopping_cards.user_id', $id)
            ->orderBy('id', 'ASC')
            ->get();
        return view('order/create')->with(['winkelwagen'=>$winkelwagen]);
    }

    public function orderView(string $id)
    {
        if(isset(Auth::user()->id)){
            $userId = Auth::user()->id;
        }else{
            $userId = 0;
            return redirect('/');
        }
        $order = Order::whereUser_id($userId)->whereId($id)->get();
        $order_products = Order_products::whereOrder_id($order[0]->id)->get();

        return view('/order/show')->with(['order'=>$order,'order_products'=>$order_products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
        }else{
            $id = 0;
        }
        $this->validate($request, [
            'total' => 'required'
        ]);
        $winkelwagen = DB::table('shopping_cards')
            ->join('products', 'shopping_cards.product_id', 'products.id')
            ->select('shopping_cards.id as id','shopping_cards.total','products.name','products.price','products.id as product_id','products.image')
            ->where('shopping_cards.user_id', $id)
            ->orderBy('id', 'ASC')
            ->get();
        if(sizeof($winkelwagen) == 0){
            return redirect('/')->with('error','Uw winkelwagen was leeg. Probeer het nog een keer.');
        }else{
            $order = new Order;
            $order->user_id = $id;
            $order->status = "waiting payment";
            $order->total = $request->input('total');
            $order->created_at = now();
            $order->updated_at = now();
            $order->save();

            foreach($winkelwagen as $item){
                $order_products = new Order_products;
                $order_products->order_id = $order->id;
                $order_products->product_name = $item->name;
                $order_products->total = $item->total;
                $order_products->price = $item->price;
                $order_products->created_at = now();
                $order_products->updated_at = now();
                $order_products->save();
                $clearWinkelwagen = shopping_card::find($item->id);
                $clearWinkelwagen->delete();
            }
            return redirect("order/proceed")->with('success', 'winkelwagen is naar order tabel verplaatst en wacht nu orders af!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse
    {
        $order = Order::find($id);
        $order->status = "payed";
        $order->updated_at = now();
        $order->save();

        return redirect('/')->with('success','Uw bestelling is aangekomen en wordt zo snel mogelijk verwerkt.');
        return redirect('/')->with('error','Uw bestelling is niet aangekomen! Probeer het nog eens.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}