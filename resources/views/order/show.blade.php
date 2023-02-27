@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h4>Bestelling: Betaling</h4>
            <div class="w-100 mb-5">
                <div class="card p-2" style="margin-left:auto;margin-right:auto;">
                    <div class="card-body">
                        <div class="card-title">
                            <p>
                                Bedrijf: ToolsForEver <br>
                                Addres: laan 5 <br>
                                Postcode: 1234 EF <br>
                                www.ToolsForEver.nl
                            </p>
                            <p>
                                {{ Auth::user()->name; }} <br>
                                {{ Auth::user()->email; }}
                            </p>
                            <p>
                                Order: #{{ $order->id }} <br>
                                Date: {{ $order->created_at }}
                            </p>
                        </div>  
                        <hr/>  
                        Bestelling
                        <table class="table">
                            <thead>
                                <th>Product</th>
                                <th>Hoeveelheid</th>
                                <th>Artikelprijs</th>
                                <th>Totaal</th>
                            </thead>
                            <tbody>
                                @foreach ($order_products as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>x{{ $item->total }}</td>
                                        <td>€{{ $item->price }}</td>
                                        <td>€{{ $item->price * $item->total}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>€{{ $order->total }}</th>
                                </tr>
                            </tbody>
                        </table>
                        {!! Form::open(['action' => ['App\Http\Controllers\OrdersController@edit', $order->id], 'method' => 'POST']) !!}
                            <button type="submit" class="btn btn-primary">Betaal</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection