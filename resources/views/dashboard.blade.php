@extends('tema')
@section('body')

<div class="container my-2">
    @foreach ($timetable as $o)
    <h4>{{ $o->data_ordinazione }}</h4>
    <div class="row">
        @foreach ($bookings as $b)
        @if ($b->data_ordinazione == $o->data_ordinazione)
        <div class="col-sm-3 mb-2">
            <div class="card text-center">
                <img src="{{ asset('foto_menu/prova.jpg') }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title" style="height: 2.5rem;">{{ $b->data_ordinazione }} - {{ $b->nome_cliente }}</h5>
                    <span class="card-text"><b>Totale:</b>€ {{ number_format($b->totale_ordinazione, 2) }}</span>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endforeach
</div>


</div>

@endsection