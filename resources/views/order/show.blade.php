<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>Proceed Order #{{ $order->id }} | ToolsForEver</title>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="mt-5 w-100 mb-5">
                    <div class="card p-2" style="margin-left:auto;margin-right:auto;">
                        <div class="card-body">
                            <div class="card-title" style="display: grid;grid-template-columns: auto 30%">
                                <p>
                                    {{ Auth::user()->name; }} <br> {{-- Naam van klant --}}
                                    {{ Auth::user()->email; }} <br> {{-- Email van klant --}}
                                    Postcode: 1234 EF {{-- Postcode van klant --}}
                                </p>
                                <div>
                                    <p>
                                        Bedrijf: ToolsForEver <br>
                                        Addres: Laan 5 <br>
                                        Postcode: 1234 EF <br>
                                        Tel: 06 12345678<br>    
                                        www.ToolsForEver.nl
                                    </p> 
                                    <p>
                                        Order nummer: #{{ $order->id }} <br>
                                        Datum: {{ $order->created_at }}
                                    </p>
                                </div>
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
                                            <td>{{ $item->total }}</td>
                                            <td>€{{ number_format($item->price,2) }}</td>
                                            <td>€{{ number_format($item->price * $item->total,2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>€{{ number_format($order->total,2) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            {!! Form::open(['action' => ['App\Http\Controllers\OrdersController@edit', $order->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                <button type="submit" class="btn btn-primary">Betaal</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>