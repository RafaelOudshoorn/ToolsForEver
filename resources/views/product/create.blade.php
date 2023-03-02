{{-- // Als een user geen admin role heeft dan wordt de user terug gestuurt naar de index --}}
@if(Auth::user()->role_id != 2)
    @php
        header("location:../../");
        die;
    @endphp
@endif

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {!! Form::open(['action' => 'App\Http\Controllers\CRUDController@store', 'method' => 'POST','files' => 'true','class' => 'col-sm-12 col-lg-6']) !!}
                <h4>Product toevoegen</h4>
                {{ Form::label('Gereedschap') }}
                {{ Form::text('naam', null,['class'=>'form-control','maxlength'=>'40']) }}
                {{ Form::label('categorie ⇩') }}
                <select name="categorie" class="form-control">
                    @foreach($categorys as $cats)
                        <option value="{{ $cats->id }}">{{ $cats->category }}</option>
                    @endforeach
                </select>
                {{ Form::label('Beschrijving') }}
                {{ Form::textarea('beschrijving', null,['class'=>'form-control','rows'=>'2','maxlength'=>'199'])}}
                {{ Form::label('Prijs') }}
                {{ Form::number('prijs', null,['placeholder'=>'€0.00','class'=>'form-control','step'=>'.01']) }}
                {{ Form::label('Afbeelding') }}
                <br>
                <input accept="image/*" name="image" type='file' id="imgInp">
                <img id="imgShow" src="" style="height:150px" />
                <br>
                <br>
                {{ Form::submit('Voeg toe', ['class'=>'btn btn-success btn-block']) }}
            {!! Form::close() !!}
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