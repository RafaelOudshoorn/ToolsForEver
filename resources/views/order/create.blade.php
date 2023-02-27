@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h4>Bestelling</h4>
            <div class="w-100 mb-5">
                <div class="p-2" style="width:35%;margin-left:auto;margin-right:auto;">
                    <?php
                        echo "<script>";
                        echo "let countTotal = ";
                        foreach($winkelwagen as $cItem){
                            echo "$cItem->total + ";
                        }
                        echo "0;";

                        echo "let subtotal = ";
                        foreach($winkelwagen as $wItem){
                            echo "($wItem->price * $wItem->total) + ";
                        }
                        echo "0;";
                        echo "</script>";
                    ?>
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
                            <a href="order/proceed" class="btn btn-primary w-100">Plaats bestelling</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection