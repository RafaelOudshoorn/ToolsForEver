<?php
    // Als een user geen admin role heeft dan wordt de user terug gestuurt naar de index
    if(Auth::user()->role_id != 2){
        header("location:../../");
        die;
    }
?>
@extends('layouts.app')

@section('content')
<div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-lg-6">
                        {!! Form::open(['action' => ['App\Http\Controllers\CRUDController@update', $product->id], 'method' => 'POST','files' => 'true','class' => 'pull-right']) !!}
                            <h4>Product aanpassen</h4>
                            {{ Form::label('Gereedschap') }}
                            {{ Form::text('naam', $product->name ,['class'=>'form-control','maxlength'=>'40']) }}
                            {{ Form::label('categorie ⇩') }}
                            <select name="categorie" class="form-control">
                                @foreach($categorys as $cats)
                                    @if($product->category_id != $cats->id)
                                    <option value="{{ $cats->id }}">{{ $cats->category }}</option>
                                    @else
                                    <option selected value="{{ $cats->id }}">{{ $cats->category }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{ Form::label('Beschrijving') }}
                            {{ Form::textarea('beschrijving', $product->description,['class'=>'form-control','rows'=>'2','maxlength'=>'199'])}}
                            {{ Form::label('Prijs') }}
                            {{ Form::number('prijs', $product->price,['placeholder'=>'€0.00','class'=>'form-control','step'=>'.01']) }}
                            {{ Form::label('Afbeelding') }}
                            <br>
                            <input accept="image/*" name="image" type='file' id="imgInp">
                            <img id="imgShow" src="/uploads/{{ $product->image }}" style="height:150px" />
                            <div class="w-100 mt-5">
                                <input readonly type="text" placeholder="Gecreeërd op {{ $product->created_at }}" class="form-control w-50" style="float:left;">
                                <input readonly type="text" placeholder="Laatst geupdated op {{ $product->updated_at }}" class="form-control w-50">
                            </div>
                            <br>
                            {{ Form::submit('Opslaan', ['class'=>'btn btn-success btn-block']) }}
                        {!! Form::close() !!}
                        <br>
                        {!! Form::open(['action' => ['App\Http\Controllers\CRUDController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                            {{Form::submit('Verwijder', ['class' => 'btn btn-danger mr-5','onclick'=>'return confirm("Weet je zeker dat u '. $product->name .' wil verwijderen?")'])}}
                        {{ Form::close() }}
                    </div>
                    <script>
                        imgInp.onchange = evt => {
                            const [file] = imgInp.files
                            if (file) {
                                imgShow.src = URL.createObjectURL(file)
                            }
                        }
                    </script>
                </div>
            </div>
@endsection