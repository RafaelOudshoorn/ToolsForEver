@extends('layouts.app')

@section('content')
    <x-userMenu>
        <div class="d-flex justify-content-center">
            <h2>Bestellingen</h2>
        </div>
        <hr>
        @if (sizeof($bestellingen) == 0)
        <div class="card">
            <div class="card-body">
                <p>Geen bestelling bekendt.</p>
            </div>
        </div>
        @else
        @endif
        @foreach ($bestellingen as $item)
        <div class="card mb-1">
            <div class="card-title ps-1">
                Ordernummer: #{{ $item->id }}
                |
                Datetime: {{ $item->updated_at }}
            </div>
            <div class="card-body row">
                <div class="col-sm-12 col-lg-3">
                    {{ Auth::user()->name }}
                </div>
                <div class="col-sm-12 col-lg-8">
                    €{{ $item->total }} 
                        @if($item->status != 'payed')
                        <span>({{ ucfirst($item->status) }})</span>
                        @else
                        <span class="bg-success text-light rounded">{{ ucfirst($item->status) }}</span>
                        @endif
                </div>
                <div class="col-sm-12 col-lg-1">
                    <a href="/order/proceed/{{ $item->id }}" class="btn btn-primary w-100"><i class="fa-solid fa-binoculars"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </x-userMenu>  
@endsection