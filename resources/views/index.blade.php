@extends('layouts.app')

@section('content')
<div class="container">
    <div class="producten_show">
        @if(!isset($producten))
        <p>Kan geen producten vinden</p>
        @else
        <h4>Producten</h4>
        {!! Form::open(['action' => ['App\Http\Controllers\CRUDController@index'], 'method' => 'POST','class' => 'pull-right float-left row mb-3']) !!}
            <div class="col-sm-12 col-lg-3">
                {{ Form::text('naam',$filter[0]['zoek'],['maxlength'=>'20', 'class'=>'form-control','placeholder'=>'Zoek..']) }}
            </div>
            <div class="col-sm-12 col-lg-3">
                <select name="categorie" class="form-select">
                    <option value="0">Alle categorieën</option>
                    @foreach($categorys as $cats)
                        @if($filter[0]['category_id'] != $cats->id)
                        <option value="{{ $cats->id }}">{{ $cats->category }}</option>
                        @else
                        <option selected value="{{ $cats->id }}">{{ $cats->category }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-lg-3">
                <select name="orderBy" class="form-select">
                    @if($filter[0]['orderBy'] != "d")
                    <option value="d">Verschijningsdatum</option>
                    @else
                    <option selected value="d">Verschijningsdatum</option>
                    @endif
                    @if($filter[0]['orderBy'] != "p-asc")
                    <option value="p-asc">Prijs (laag → hoog)</option>
                    @else
                    <option selected value="p-asc">Prijs (laag → hoog)</option>
                    @endif
                    @if($filter[0]['orderBy'] != "p-desc")
                    <option value="p-desc">Prijs (hoog → laag)</option>
                    @else
                    <option selected value="p-desc">Prijs (hoog → laag)</option>
                    @endif
                </select>
            </div>
            <div class="col-sm-12 col-lg-3">
                {{ Form::submit('Filter', ['class'=>'btn btn-primary btn-block w-100']) }}
            </div>
        {!! Form::close() !!}
        <div class="row justify-content-center">
            @foreach($producten as $product)
            <div class="col-sm-12 col-lg-4">
                <div class="card text-center p-2" style="height:600px;margin-bottom:20px;cursor:pointer" onclick="window.location.href = '/product/{{ $product->id }}'">
                    <h5 class="card-title text-primary">{{ $product->name }}</h5>
                    <div class="card-body">
                        <div style="height:290px;overflow:hidden">
                            <img src="/uploads/{{ $product->image }}" class="w-75">
                        </div>
                        <p>Prijs: €{{ $product->price }}</p>
                        <p style="height:100px">Beschrijving: {{ $product->description }}</p>
                        <p>Categorie: {{ $product->category }}</p>
                        <a href="#"><span class="material-symbols-outlined">shopping_cart</span></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $producten->links() }}
        </div>
        @endif
    </div>
</div>
@endsection