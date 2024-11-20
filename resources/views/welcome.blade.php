@extends('tema')
@section('body')

<body>
    <div class="container">
        <p>Welcome to JiaJia</p>
    </div>
</body>
<script>
    function add(id) {
        if (Number(document.getElementById('qt' + id).value) < 10)
            document.getElementById('qt' + id).value = Number(document.getElementById('qt' + id).value) + 1;
    }

    function minus(id) {
        if (Number(document.getElementById('qt' + id).value) > 0)
            document.getElementById('qt' + id).value = Number(document.getElementById('qt' + id).value) - 1;
    }
</script>
@endsection