<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Order_products;
use App\Models\Product;
use App\Models\Category;
use App\Models\shopping_card;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
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
        $gebruiker = User::find($id);
        return view('account.index',['gebruiker'=>$gebruiker]);
    }
    public function bestellingen()
    {
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
        }else{
            $id = 0;
        }
        $bestellingen = Order::whereUser_id($id)->orderBy('id', 'DESC')->get();

        return view('account.bestellingen',['bestellingen'=>$bestellingen]);
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request): RedirectResponse
    {
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
        }else{
            $id = 0;
        }
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);
        $gebruiker = User::find($id);
        if(($gebruiker->name == $request->input('name')) && ($gebruiker->email == $request->input('email'))){
            return redirect('/account/ ');
        }
        else{
            $gebruiker->name = $request->input('name');
            $gebruiker->email = $request->input('email');
            $gebruiker->save();
            return redirect('/account/ ')->with('success','Uw gegevens zijn geüpdate.');
            return redirect('/account/ ')->with('error','Er ging iets mis met het updaten van uw gegevens.');
        }
    }
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
