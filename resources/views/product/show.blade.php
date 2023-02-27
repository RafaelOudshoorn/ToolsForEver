@extends('layouts.app')

@section('content')
<style>
    .product-info{
        font-weight: 500;
    }
    .product-info p{
        font-size: 20px
    }
    .product-info p span{
        color: red;
        font-weight: 900;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead class="bg-primary text-white">
                <th class="w-50"><h4>{{ $product->name }}</h4></th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><img src="/uploads/{{ $product->image }}" alt="{{ $product->name }}" class="w-75"></td>
                    <td class="product-info">
                        Product informatie
                        <p>
                            {{ $product->name }} 
                            <br>
                            <span>€{{ $product->price }}</span> 
                            <br>
                        </p>
                        Categorie:
                        <p>{{ $category->category }}</p>
                        Beschrijving: 
                        <p>
                            {{ $product->description }}
                        </p>
                        @guest
                        <span><a href="../login">Log in</a> / <a href="../register">Registreer</a> om &quot;{{ $product->name }}&quot; te kunnen toevoegen aan je winkelwagen</span>
                        @else
                        {!! Form::open(['action' => ['App\Http\Controllers\CRUDController@addToWinkelwagen',$product->id], 'method' => 'POST','files' => 'true','class' => 'col-sm-12 col-lg-6']) !!}
                            {!! Form::label('Aantal:') !!}
                            <select name="total">
                                @for($i = 15;$i >= 1; $i--)
                                    @if ($i != 1)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @else
                                    <option selected value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                            <br>
                            {{ Form::hidden('user_id', Auth::user()->id) }}
                            <br>
                            {{ Form::submit('Voeg toe aan winkelwagen', ['class'=>'btn btn-success btn-block']) }}
                        {!! Form::close() !!}
                        <br>
                        @if (Auth::user()->role_id != 2)
                        @else
                        Product <a href="/admin/product/{{ $product->id }}">Aanpassen</a>  
                        @endif
                        
                        @endguest
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection