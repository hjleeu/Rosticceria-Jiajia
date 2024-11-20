<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymus">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+SC&display=swap" rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Noto Serif SC', serif;
        font-weight: 400;
        font-size: 1rem
    }

    @media print {

        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }
</style>

<body>
    <div class="container" id="divToPrint">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">菜名</th>
                    <th scope="col">数量</th>
                    <th scope="col">备注</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordini as $o)
                <tr>
                    <td>{{ $o->prodotto }}</td>
                    <td>{{ $o->quantita }}</td>
                    <td>{{ $o->note }}</td>
                </tr>
                @endforeach
                @if (count($menu) > 0)
                <tr class="table-group-divider"></tr>
                @foreach ($menu as $o)
                <tr>
                    <td>
                        @if (substr($o->prodotto, 0, 1) == 'B')
                        BIS
                        <br>
                        <span class="border border-2 rounded-circle border-dark">
                            <?php
                                $s = explode('+', $o->note)[0];
                                echo(substr($s, 0, 2));
                            ?>
                        </span>{{ substr(explode('+',$o->note)[0], 2) }}
                        <br>
                        @if (strlen($o->note) > 2)
                        {{ explode('+',$o->note)[1] }}
                        @endif
                        @elseif (substr($o->prodotto, 0, 1) == 'T')
                        TRIS
                        <br>
                        <span class="border border-2 rounded-circle border-dark">
                            {{ explode('+',$o->note)[0] }}
                        </span>
                        <br>
                        {{ explode('+',$o->note)[1] }}
                        @endif
                    <td>1</td>
                    <td></td>
                    </td>
                </tr>
                @endforeach
                @endif
                @if (count($altro) > 0)
                <tr class="table-group-divider"></tr>
                @foreach ($altro as $o)
                <tr>
                    <td>{{ $o->prodotto }}</td>
                    <td>{{ $o->quantita }}</td>
                    <td>{{ $o->note }}</td>
                </tr>
                @endforeach
                @endif
                <tr class="table-group-divider">
                    <td></td>
                    <th scope="row">Totale</th>
                    <td>€ {{ $totale }}</td>
                </tr>
                <tr class="table-group-divider">
                    <th scope="row" class="text-center" colspan="3">{{ $name }} - {{ $orario }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="/Book" class="btn btn-primary hidden-print">Nuovo ordine</a>
    <button id="btnPrint" class="btn btn-success hidden-print">Print</button>
</body>

<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>