<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Raja Ongkir</title>
    </head>

    <body class="antialiased">

        <h1>Cek Ongkir</h1>

        <form action="{{ route('cek-ongkir') }}" method="POST">
            @csrf
            <label for="destination">Kota Tujuan:</label>
            <input type="text" name="destination" id="destination" required>
            <button type="submit">Cek Ongkir</button>
        </form>

        @if(isset($results))
            <h2>Hasil Cek Ongkir:</h2>
            @foreach($results as $result)
                <h3>Ekspedisi: {{ $result['name'] }}</h3>
                <ul>
                    @foreach($result['costs'] as $cost)
                        <li>
                            Layanan: {{ $cost['service'] }}<br>
                            Estimasi: {{ $cost['cost'][0]['etd'] }} hari<br>
                            Ongkir: Rp {{ $cost['cost'][0]['value'] }}
                        </li>
                    @endforeach
                </ul>
            @endforeach
        @endif

    </body>
</html>
