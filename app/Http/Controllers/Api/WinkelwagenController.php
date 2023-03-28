<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WinkelwagenController extends Controller
{
    public function index(Request $request){
        try{
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            $winkelwagen = DB::table('shopping_cards')
                ->join('products', 'shopping_cards.product_id', 'products.id')
                ->select('shopping_cards.id as id','shopping_cards.total','products.name','products.price','products.id as product_id','products.image')
                ->where('shopping_cards.user_id', $user->id)
                ->orderBy('id', 'ASC')
                ->get();

            return response()->json([
                $winkelwagen
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
