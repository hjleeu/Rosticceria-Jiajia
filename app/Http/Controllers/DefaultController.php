<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Models\Sezione;
use App\Models\Ordinazione;
use App\Models\SpecificaOrdinazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class DefaultController extends Controller
{
    public function ShowProducts()
    {
        $prodotti = DB::table('prodotti')->orderBy('id_prodotto')->get();
        $sezioni = Sezione::all();
        return view('ordinazione', ['sec' => $sezioni, 'pro' => $prodotti]);
    }

    public function ConfirmBooking(Request $r)
    {
        // return dd($r);

        $ordinazione = new Ordinazione();
        $ordinazione->nome_cliente = $r->nome_cliente;
        $ordinazione->data_ordinazione = $r->ora_ritiro;

        $ordinazione->save();

        for($i = 0; $i < $r->totale_li; $i++) {
            $index = 'li' . $i;
            $item = explode('-', $r->$index);
            $sp_ord = new SpecificaOrdinazione();
            $sp_ord->id_ordinazione = $ordinazione->id;
            $sp_ord->id_prodotto = $item[0];
            $sp_ord->quantita = $item[1];
            $sp_ord->note = $item[2];
            $sp_ord->save();
        }

        for($i = 0; $i < $r->totale_me; $i++) {
            $index = 'me' . $i;
            $item = explode('-', $r->$index);
            $sp_ord = new SpecificaOrdinazione();
            $sp_ord->id_ordinazione = $ordinazione->id;
            $sp_ord->id_prodotto = $item[0];
            $sp_ord->quantita = $item[1];
            $sp_ord->note = $item[2];
            $sp_ord->save();
        }

        $ordini = DB::table('specificheordinazioni')
            ->join('ordinazioni', 'specificheordinazioni.id_ordinazione', '=', 'ordinazioni.id_ordinazione')
            ->join('prodotti', 'specificheordinazioni.id_prodotto', '=', 'prodotti.id_prodotto')
            ->select('prodotti.prt_nome AS prodotto', 'specificheordinazioni.quantita AS quantita', 'specificheordinazioni.note AS note', 'prodotti.prezzo_prodotto AS prezzo')
            ->where('ordinazioni.id_ordinazione', '=', $ordinazione->id)
            ->where('prodotti.id_sezione', '<=', 6)
            ->orderBy('prodotti.prt_nome')
            ->orderBy('note')
            ->get();

            $menu = DB::table('specificheordinazioni')
            ->join('ordinazioni', 'specificheordinazioni.id_ordinazione', '=', 'ordinazioni.id_ordinazione')
            ->join('prodotti', 'specificheordinazioni.id_prodotto', '=', 'prodotti.id_prodotto')
            ->select('prodotti.prt_nome AS prodotto', 'specificheordinazioni.quantita AS quantita', 'specificheordinazioni.note AS note', 'prodotti.prezzo_prodotto AS prezzo')
            ->where('ordinazioni.id_ordinazione', '=', $ordinazione->id)
            ->whereBetween('prodotti.id_sezione', [9, 10])
            ->orderBy('prodotti.prt_nome')
            ->orderBy('note')
            ->get();

            $altro = DB::table('specificheordinazioni')
            ->join('ordinazioni', 'specificheordinazioni.id_ordinazione', '=', 'ordinazioni.id_ordinazione')
            ->join('prodotti', 'specificheordinazioni.id_prodotto', '=', 'prodotti.id_prodotto')
            ->select('prodotti.prt_nome AS prodotto', 'specificheordinazioni.quantita AS quantita', 'specificheordinazioni.note AS note', 'prodotti.prezzo_prodotto AS prezzo')
            ->where('ordinazioni.id_ordinazione', '=', $ordinazione->id)
            ->whereBetween('prodotti.id_sezione', [7, 8])
            ->orderBy('prodotti.prt_nome')
            ->orderBy('note')
            ->get();

        $totale = 0;

        foreach ($ordini as $o) {
            $totale += $o->quantita * $o->prezzo;
        }

        foreach ($menu as $o) {
            $totale += $o->quantita * $o->prezzo;
        }
        foreach ($altro as $o) {
            $totale += $o->quantita * $o->prezzo;
        }

        $prova = DB::table('ordinazioni')->where('id_ordinazione', '=', $ordinazione->id)
            ->update(['totale_ordinazione' => $totale]);

        return view('riepilogo', ['name' => $r->nome_cliente, 'orario' => $r->ora_ritiro, 'ordini' => $ordini, 'menu' => $menu, 'altro' => $altro, 'totale' => $totale]);
    }

    public function ShowAll()
    {
        $ordinazioni = DB::table('ordinazioni')->orderBy('data_ordinazione')->get();

        $orari = DB::table('ordinazioni')->selectRaw('DISTINCT data_ordinazione')->get();

        return view('dashboard', ['bookings' => $ordinazioni, 'timetable' => $orari]);
    }
}
