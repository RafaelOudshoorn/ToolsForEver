@extends('layouts.app')

@section('content')
    <div class="container">
        @guest
            <div class="row">
                <div class="card col-sm-12 col-lg-6" style="margin-left:auto;margin-right:auto">
                    <div class="card-header">{{__('Log in of registreer op onze website voor een winkelwagen') }}</div>
                    <div class="card-body">
                        @if (Route::has('login'))
                            <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                        <br>
                        @if (Route::has('register'))
                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <h4>Winkelwagen</h4>
            @if (sizeof($winkelwagen) == 0)
            <p>
                Uw winkelwagen is leeg.
                <br>
                Bekijk onze <a href="./">producten</a>.
            </p>
            @else 
            <div class="w-100 mb-5 row">
                <div id="card-body" class="p-2 col-sm-12 col-lg-8">
                    @foreach ($winkelwagen as $item)
                    <div class="container card mb-2">
                        <div class="card-body row" style="min-height:200px;">
                            <div class="d-flex justify-content-center col-sm-12 col-lg-3">
                                <img src="/uploads/{{ $item->image }}" style="max-width:170px;max-height:170px;">
                            </div>
                            <div class="col-sm-6 col-lg-7">
                                <a href="/product/{{ $item->product_id }}" class="text-dark text-decoration-none"><h3>{{ $item->name }}</h3></a>
                                Aantal:<br>
                                <div class="d-flex" style="width:30%">
                                    {!! Form::open(['action' => ['App\Http\Controllers\CRUDController@updateWTotal',$item->id], 'method' => 'POST','files' => 'false','class' => 'col-sm-12 col-lg-6']) !!}
                                    <select class="form-select" style="width:75px" name="total" onchange="this.form.submit()">
                                        @if($item->total >= 15)
                                        <option value="{{ $item->total + 1 }}">{{ $item->total + 1 }} (+1)</option>
                                        <option selected value="{{ $item->total }}">{{ $item->total }}</option>
                                        <option value="{{ $item->total - 1 }}">{{ $item->total - 1 }} (-1)</option>
                                        <option disabled value=""> . . . </option>
                                        @endif
                                        @for($i = 15;$i >= 1; $i--)
                                        @if($i != $item->total)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @else
                                        <option selected value="{{ $i }}">{{ $i }}</option>
                                        @endif
                                        @endfor
                                    </select>
                                    {!! Form::close() !!}
                                    {!! Form::open(['action' => ['App\Http\Controllers\CRUDController@destroyProductFromShopping_card', $item->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                        <button type="submit" class="btn"><span class="material-symbols-outlined">delete</span></button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <h3 style="float:right;font-weight:bold;font-size:18px">
                                    <script>let num{{$item->id}} = {{$item->total}} * {{$item->price}};document.write('€'+ num{{$item->id}}.toFixed(2));</script>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="p-2 col-sm-12 col-lg-4">
                    @php
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
                    @endphp
                    <div class="card sticky-lg-top" style="top:10px;margin-bottom:7px">
                        <div class="card-title text-center">
                            <br>
                            <h5 style="font-weight: bold">Overzicht</h5>
                        </div>
                        <div class="card-body">
                            <div style="display: grid;grid-template-columns: auto auto">
                                <p>Artikelen (<script>document.write(countTotal)</script>)</p>
                                <p class="float-right text-end" style="font-weight:bold">€<script>document.write(subtotal.toFixed(2))</script></p>
                            </div>
                            <hr class="bg-danger border-2 border-top border-danger">
                            <div style="display: grid;grid-template-columns: auto auto">
                                <p class="float-left">Nog te betalen: </p>
                                <p class="float-right text-end" style="font-weight:bold">€<script>document.write(subtotal.toFixed(2))</script></p>
                            </div>
                            <a href="/order" class="btn btn-primary w-100">Verder naar bestellen</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endguest
    </div>
@endsection