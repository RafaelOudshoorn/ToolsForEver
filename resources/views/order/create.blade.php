@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Bestelling: Doorlopen</h4>
        <div class="row d-flex justify-content-center">
            <div class="p-2 col-sm-12 col-lg-6">
                @php
                    echo "<script>";
                    echo "let countTotal = ";
                    foreach($winkelwagen as $cItem){
                        echo "$cItem->total + ";
                    }
                    echo "0;";

                    echo "var subtotal = ";
                    foreach($winkelwagen as $wItem){
                        echo "($wItem->price * $wItem->total) + ";
                    }
                    echo "0;";
                    echo "</script>";
                @endphp
                <div class="card" style="margin-bottom:7px;">
                    <div class="card-title text-center">
                        <br>
                        <h5 style="font-weight: bold">Overzicht</h5>
                    </div>
                    <div class="card-body">
                        <div style="display: grid;grid-template-columns: auto auto">
                            <p>Artikelen (<script>document.write(countTotal)</script>)</p>
                            <p class="float-end text-end" style="font-weight:bold">€<script>document.write(subtotal.toFixed(2))</script></p>
                        </div>
                        <div style="display: grid;grid-template-columns: auto auto">
                            @foreach ($winkelwagen as $overzicht)
                                <p>{{ $overzicht->name }}</p>
                                <p class="float-end text-end">x{{ $overzicht->total }}</p>
                            @endforeach
                        </div>
                        <hr class="bg-danger border-2 border-top border-danger"> 
                        <div style="display: grid;grid-template-columns: auto auto">
                            <p class="float-left">Nog te betalen: </p>
                            <p class="float-right text-end" style="font-weight:bold">€<script>document.write(subtotal.toFixed(2))</script></p>
                        </div>
                        {!! Form::open(['action' => ['App\Http\Controllers\OrdersController@store'], 'method' => 'POST', 'class' => 'pull-right']) !!}
                            <input type="hidden" name="total" id="totalValue" value="">
                            <button type="submit" class="btn btn-primary w-100">Verder naar betalen</button>
                        {{ Form::close() }}
                        <script>document.getElementById('totalValue').value = subtotal.toFixed(2)</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection