@extends('tema')
@section('body')

<body>
    <div class="container">
        <h3>Ordinazione</h3>
        <form class="form-control" action="/SendBooking" method="post">
            @csrf
            @foreach ($sec as $s)
            @if ($s->id_sezione < 9)
                <div id="{{'s' . $s->id_sezione }}">
                <h4 class="h4 text-center my-2">{{ $s->nome_sezione }}</h4>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($pro as $p)
                    @if ($p->id_sezione == $s->id_sezione)
                    <div class="col">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('foto_menu/' . 'prova' . '.jpg') }}" alt="{{ $p->prt_nome }}">
                            <div class="card-body">
                                <h5 class="card-title">@if ($p->id_sezione <= 5)
                                        {{ $p->prt_nome }}.
                                        @endif {{ $p->nome_prodotto }}</h5>
                                        <p class="card-text"><span>€ {{ number_format($p->prezzo_prodotto, 2) }}</span></p>
                                        <div class="input-group mt-2">
                                            <button class="btn btn-secondary" type="button" onclick="minus('{{ $p->id_prodotto }}')"><i class="bi bi-dash-lg"></i></button>
                                            <input type="number" name="{{ $p->id_prodotto }}" id="{{ $p->id_prodotto }}" class="form-control text-center" value="1" min="0" max="10" readonly>
                                            <button class="btn btn-primary" type="button" onclick="add('{{ $p->id_prodotto }}')"><i class="bi bi-plus-lg"></i></button>
                                        </div>
                                        <div class="form-floating my-1">
                                            <input type="text" class="form-control" name="n{{ $p->id_prodotto }}" id="n{{ $p->id_prodotto }}">
                                            <label for="n{{ $p->id_prodotto }}">Note</label>
                                        </div>
                                        <input class="btn btn-primary" type="button" onclick="aggiungi('{{ $p->id_prodotto }}', '{{ $p->prt_nome }}', '{{ $p->prezzo_prodotto }}')" value="Aggiungi">
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

    </div>
    @endif
    @endforeach

    <h4 class="text-center" id="s9">Menu fissi</h4>
    <div class="input-group">
        <span class="input-group-text">BIS</span>
        <select name="bis_primo" id="bis_primo" class="form-select" onchange="menu_price('BIS')">
            @foreach ($pro as $p)
            @if ($p->id_sezione == 9)
            <option value="{{ $p->prt_nome }}">{{ $p->nome_prodotto }}</option>
            @endif
            @endforeach
        </select>
        <div class="form-floating">
            <input type="text" class="form-control" name="nbis_primo" id="nbis_primo">
            <label for="nbis_primo">Note</label>
        </div>
        <select name="bis_secondo" id="bis_secondo" class="form-select">
            @foreach ($pro as $p)
            @if ($p->acc_menu == 1)
            <option value="{{ $p->prt_nome }}">@if ($p->id_sezione <= 5 && $p->prt_nome != '白饭')
                    {{ $p->prt_nome }}.
                    @endif {{ $p->nome_prodotto }}</option>
            @endif
            @endforeach
        </select>
        <div class="form-floating">
            <input type="text" class="form-control" name="nbis_secondo" id="nbis_secondo">
            <label for="nbis_secondo">Note</label>
        </div>
        <select class="form-select" id="bis_id" hidden> <!-- ID -->
            @foreach ($pro as $p)
            @if ($p->id_sezione == 9)
            <option value="{{ $p->id_prodotto }}">{{ $p->id_prodotto }}</option>
            @endif
            @endforeach
        </select>
        <select class="form-select" id="bis_prezzo" hidden> <!-- Prezzo -->
            @foreach ($pro as $p)
            @if ($p->id_sezione == 9)
            <option value="{{ number_format($p->prezzo_prodotto, 2) }}">{{ number_format($p->prezzo_prodotto, 2) }}</option>
            @endif
            @endforeach
        </select>
        <span class="input-group-text" id="prezzo_bis">€ 6.50</span>
        <input class="btn btn-primary" type="button" onclick="menu('BIS')" value="Aggiungi">
    </div>
    <div class="input-group mt-2">
        <span class="input-group-text">TRIS</span>
        <span class="input-group-text">Involtino Primavera</span>
        <select name="tris_primo" id="tris_primo" class="form-select" onchange="menu_price('TRIS')">
            @foreach ($pro as $p)
            @if ($p->id_sezione == 10)
            <option value="{{ $p->prt_nome }}">{{ $p->nome_prodotto }}</option>
            @endif
            @endforeach
        </select>
        <div class="form-floating">
            <input type="text" class="form-control" name="ntris_primo" id="ntris_primo">
            <label for="ntris_primo">Note</label>
        </div>
        <select name="tris_secondo" id="tris_secondo" class="form-select">
            @foreach ($pro as $p)
            @if ($p->acc_menu == 1)
            <option value="{{ $p->prt_nome }}">@if ($p->id_sezione <= 5 && $p->prt_nome != '白饭')
                    {{ $p->prt_nome }}.
                    @endif {{ $p->nome_prodotto }}</option>
            @endif
            @endforeach
        </select>
        <div class="form-floating">
            <input type="text" class="form-control" name="ntris_secondo" id="ntris_secondo">
            <label for="ntris_secondo">Note</label>
        </div>
        <select class="form-select" id="tris_id" hidden> <!-- ID -->
            @foreach ($pro as $p)
            @if ($p->id_sezione == 10)
            <option value="{{ $p->id_prodotto }}">{{ $p->id_prodotto }}</option>
            @endif
            @endforeach
        </select>
        <select class="form-select" id="tris_prezzo" hidden> <!-- Prezzo -->
            @foreach ($pro as $p)
            @if ($p->id_sezione == 10)
            <option value="{{ number_format($p->prezzo_prodotto, 2) }}">{{ number_format($p->prezzo_prodotto, 2) }}</option>
            @endif
            @endforeach
        </select>
        <span class="input-group-text" id="prezzo_tris">€ 6.90</span>
        <input class="btn btn-primary" type="button" onclick="menu('TRIS')" value="Aggiungi">
    </div>

    <div class="input-group sticky-bottom p-2">
        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Vai a</button>
        <ul class="dropdown-menu">
            @foreach ($sec as $s)
            @if ($s->id_sezione < 9)
                <li><a class="dropdown-item" href="#s{{ $s->id_sezione }}">{{ $s->nome_sezione }}</a></li>
                @endif
                @endforeach
                <li><a class="dropdown-item" href="#s9">Menu fissi</a></li>
        </ul>
        <span class="input-group-text">Nome</span>
        <input type="text" aria-label="Name" class="form-control" name="nome_cliente" required>
        <span class="input-group-text">Ora ritiro</span>
        <input type="time" name="ora_ritiro" class="form-control" min="11:00" max="21:45">
        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Riepilogo</button>
        <ul class="dropdown-menu" id="riepilogo">
            <li><label class="dropdown-item">Totale: € <span id="totale">0.00</span></label></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <input type="hidden" name="totale_li" id="totale_li" value="0">
            <input type="hidden" name="totale_me" id="totale_me" value="0">
        </ul>
        <button type="submit" class="btn btn-primary">Invia</button>
    </div>
    </form>
    </div>
</body>
<script>
    function add(id) {
        if (Number(document.getElementById(id).value) < 10)
            document.getElementById(id).value = Number(document.getElementById(id).value) + 1;
    }

    function minus(id) {
        if (Number(document.getElementById(id).value) > 0)
            document.getElementById(id).value = Number(document.getElementById(id).value) - 1;
    }

    function aggiungi(id, nome, prezzo) {
        let qt = document.getElementById(id).value;
        let notes = document.getElementById('n' + id).value;

        if (qt > 0) {
            let li = document.createElement('li');

            li.className = 'dropdown-item';
            let s = nome + ' - ' + qt + ' - € ' + (prezzo * qt).toFixed(2);
            if (notes != '') {
                s += ' - ' + notes;
            }

            let y = id + '-' + qt + '-' + notes;

            let hidden = document.createElement('input');
            hidden.setAttribute("type", 'hidden');
            hidden.setAttribute("value", y);
            hidden.setAttribute('name', 'li' + cont);
            cont++;

            li.append(s);
            li.append(hidden);
            document.getElementById('riepilogo').append(li);

            let totale = Number(document.getElementById('totale').textContent) + (prezzo * qt);
            document.getElementById('totale').textContent = totale.toFixed(2);

            document.getElementById('totale_li').value = cont;
        }
    }

    function menu_price(t) {
        if (t == 'BIS') {
            var t = document.getElementById("bis_primo");
            let prezzo = document.getElementById('bis_prezzo').options[t.selectedIndex].value;

            document.getElementById("prezzo_bis").innerHTML = '€ ' + Number(prezzo).toFixed(2);
        } else if (t == 'TRIS') {
            var t = document.getElementById("tris_primo");
            let prezzo = document.getElementById('tris_prezzo').options[t.selectedIndex].value;

            document.getElementById("prezzo_tris").innerHTML = '€ ' + Number(prezzo).toFixed(2);
        }
    }

    let cont = 0;
    let cont_me = 0;

    function menu(t) {
        let id = 0;
        let nome = '';
        let prezzo = 0;
        let y = '';
        if (t == 'BIS') {
            var t = document.getElementById("bis_primo");
            prezzo = Number(document.getElementById('bis_prezzo').options[t.selectedIndex].value);

            id = document.getElementById('bis_id').options[t.selectedIndex].value;

            nome = 'BIS: ' + document.getElementById('bis_primo').value.substr(1);
            if (document.getElementById('nbis_primo').value != '') {
                nome += '(' + document.getElementById('nbis_primo').value + ')';
            }
            nome += ' + ' + document.getElementById('bis_secondo').value;
            if (document.getElementById('nbis_secondo').value != '') {
                nome += '(' + document.getElementById('nbis_secondo').value + ')';
            }

            y = id + '-1-' + nome.substring(5);
        } else if (t == 'TRIS') {
            var t = document.getElementById("tris_primo");
            prezzo = Number(document.getElementById('tris_prezzo').options[t.selectedIndex].value);

            id = document.getElementById('tris_id').options[t.selectedIndex].value;

            nome = 'TRIS: ' + document.getElementById('tris_primo').value.substr(1);
            if (document.getElementById('ntris_primo').value != '') {
                nome += '(' + document.getElementById('ntris_primo').value + ')';
            }
            nome += ' + ' + document.getElementById('tris_secondo').value;
            if (document.getElementById('ntris_secondo').value != '') {
                nome += '(' + document.getElementById('ntris_secondo').value + ')';
            }
            y = id + '-1-' + nome.substring(6);
        }

        let li = document.createElement('li');
        li.className = 'dropdown-item';

        let hidden = document.createElement('input');
        hidden.setAttribute("type", 'hidden');
        hidden.setAttribute("value", y);
        hidden.setAttribute('name', 'me' + cont_me);
        cont_me++;

        let s = nome + ' - € ' + (prezzo).toFixed(2);

        li.append(s);
        li.append(hidden);

        document.getElementById('riepilogo').append(li);

        let totale = Number(document.getElementById('totale').textContent) + (prezzo);
        document.getElementById('totale').textContent = totale.toFixed(2);

        document.getElementById('totale_me').value = cont_me;
    }
</script>
@endsection