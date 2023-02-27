<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\shopping_card;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'naam', 'nullable',
            'categorie', 'nullable',
            'orderBy', 'nullable'
        ]);
        $filter = array([
            'zoek'=>$request->input('naam'),
            'category_id'=>$request->input('categorie'),
            'orderBy'=>$request->input('orderBy')
        ]);
        $saveInput = "";
        $collumn = "!=";
        $value = "";
        $orderByWhat = "id";
        $orderBy = "ASC";
        if(isset($request)){
            $saveInput = htmlspecialchars(ucfirst($request->input('naam')));
            if($request->input('categorie') != 0){
                $collumn = "=";
                $value = $request->input('categorie');
            }
            if($request->input('orderBy') != 'd'){
                if($request->input('orderBy') == 'p-asc'){
                    $orderByWhat = "price";
                    $orderBy = "ASC";
                }
                if($request->input('orderBy') == 'p-desc'){
                    $orderByWhat = "price";
                    $orderBy = "DESC";
                }
            }
        }
        $producten = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->select('products.*','categories.category as category')
            ->where('name', 'LIKE', '%'.$saveInput.'%')
            ->where("category_id", $collumn, $value)
            ->orderBy($orderByWhat, $orderBy)
            ->paginate(9);
        $categorys = Category::all();
        return view('index', ['producten'=>$producten,'categorys'=>$categorys,'filter'=>$filter]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image | required',
            'naam' => 'required',
            'categorie' => 'required',
            'beschrijving' => 'required',
            'prijs' => 'required'
        ]);
        $file = $request->file('image');
        if($file){
            $afbeelding = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
        }
        else{
            $afbeelding = "";
        }
        $product = new Product;
        $product->image = $afbeelding;
        $product->name = $request->input('naam');
        $product->price = $request->input('prijs');
        $product->description = $request->input('beschrijving');
        $product->category_id = $request->input('categorie');
        $product->created_at = now();
        $product->updated_at = now();
        $product->save();
        return redirect('/product/' . $product->id)->with("success", $product->name. " toegevoegd aan producten lijst");
        return redirect('/aanmaken')->with("error", "Kon geen nieuw product maken");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        return view('product.show',['product'=>$product, 'category'=>$category]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForEdit($id)
    {
        $product = Product::find($id);
        $categorys = Category::all();
        return view('product.update', ['product'=>$product, 'categorys'=>$categorys]);
    }
    public function showForWinkelwagen()
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
        return view('winkelwagen')->with(['winkelwagen'=>$winkelwagen]);
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
        $this->validate($request, [
            'image' => 'image | nullable',
            'naam' => 'required',
            'categorie' => 'required',
            'beschrijving' => 'required',
            'prijs' => 'required'
        ]);
        $product = Product::find($id);
        $file = $request->file('image');
        if($file){
            $afbeelding = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $product->image = $afbeelding;
        }
        else{
            $afbeelding = "";
        }
        $product->name = $request->input('naam');
        $product->category_id = $request->input('categorie');
        $product->description = $request->input('beschrijving');
        $product->price = $request->input('prijs');
        $product->updated_at = now();
        $product->save();

        return redirect('/product/' . $product->id)->with("success", "Product is geupdated");
        return redirect('/admin/product/'. $product->id)->with("error", "Kon product niet updaten");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWTotal(Request $request, $id)
    {
        $this->validate($request, [
            'total' => 'required'
        ]);
        $product = shopping_card::find($id);
        $product->total = $request->input('total');
        $product->updated_at = now();
        $product->save();

        return redirect('/winkelwagen');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToWinkelwagen (Request $request, $id)
    {
        $this->validate($request, [
            'total' => 'required'
        ]);
        $checkDupe = shopping_card::select('*')
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->get();
        if(sizeof($checkDupe) == 0){
            $card = new shopping_card;
            $card->user_id = Auth::user()->id;
            $card->product_id = $id;
            $card->total = $request->input('total');
            $card->save();
        }else{
            $checkDupe[0]->total = $checkDupe[0]->total + $request->input('total');
            $checkDupe[0]->save();
        }
        $productName = Product::find($id);

        return redirect('/product/' . $id)->with("success", $productName->name." is toegevoegd aan uw winkelwagen.");
        return redirect('/product/' . $id)->with("error", "Kon product niet toevoegen!");
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
        return redirect('/')->with("success", "Product is verwijderd");
    }
    public function destroyProductFromShopping_card($id)
    {
        $product = shopping_card::find($id);
        $product->delete();
        $productName = Product::find($product->product_id);
        return redirect('/winkelwagen')->with(["success" => $productName->name." is verwijderd uit uw winkelwagen!"]);
    }
}