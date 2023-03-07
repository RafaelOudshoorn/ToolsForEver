<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>Proceed Order #{{ $order[0]->id }} | ToolsForEver</title>
        <style>
            .bedrijf-text{
                text-align: start;
            }
            @media screen and (min-width: 720px) {
                .bedrijf-text{
                    text-align: end;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="mt-5 w-100 mb-5">
                    <div class="card p-2" style="margin-left:auto;margin-right:auto;">
                        <div class="row card-title p-3">
                            <p class="col-sm-12 col-lg-6">
                                {{ Auth::user()->name; }} <br> {{-- Naam van klant --}}
                                {{ Auth::user()->email; }} <br> {{-- Email van klant --}}
                                Postcode: 1234 EF {{-- Postcode van klant --}}
                            </p>
                            <div class="bedrijf-text col-sm-12 col-lg-6">
                                <p>
                                    Bedrijf: ToolsForEver <br>
                                    Addres: Laan 5 <br>
                                    Postcode: 1234 EF <br>
                                    Tel: 06 12345678<br>    
                                    www.ToolsForEver.nl
                                </p> 
                                <p>
                                    Order nummer: #{{ $order[0]->id }} <br>
                                    Datum: {{ $order[0]->created_at }}
                                </p>
                            </div>
                        </div> 
                        <div class="card-body"> 
                            <hr/>
                            Bestelling
                            <br>
                            <div class="row fw-bold">
                                <div class="col">
                                    Product
                                </div>
                                <div class="col">
                                    Aantal
                                </div>
                                <div class="col">
                                    Artikelprijs
                                </div>
                                <div class="col">
                                    Totaal
                                </div>
                            </div>
                            @foreach ($order_products as $item)
                                <div class="row">
                                    <div class="col overflow-hidden">
                                        {{ $item->product_name }}
                                    </div>
                                    <div class="col">
                                        {{ $item->total }}
                                    </div>
                                    <div class="col">
                                        €{{ number_format($item->price,2) }}
                                    </div>
                                    <div class="col">
                                        €{{ number_format($item->price * $item->total,2) }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col fw-bold">
                                    €{{ number_format($order[0]->total,2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    {!! Form::open(['action' => ['App\Http\Controllers\OrdersController@edit', $order[0]->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                        <button @if($order[0]->status != 'waiting payment') disabled @endif type="submit" class="btn btn-success">Betaal</button>
                    {{ Form::close() }}
                    <a href="/account/bestellingen" type="button" class="btn btn-primary">Terug</a>
                </div>
            </div>
        </div>
    </body>
</html>