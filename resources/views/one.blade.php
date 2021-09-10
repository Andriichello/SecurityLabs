<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>One</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>

<div class="row" style="margin-top: 50px">
    <form class="col s4" method="get" action="{{ url('/one') }}" style="margin-top: 50px">
        <div class="row">
            <div class="input-field col s8 offset-s2">
                <input id="m" name="m" value="{{ $m ?? '' }}" type="number" step="1">
                <label for="m">Modulo</label>

                @if(isset($fails) && isset($fails['m']))
                    @foreach($fails['m'] as $fail)
                        <p style="color: red">{{ $fail }}</p>
                    @endforeach
                @endif
            </div>

            <div class="input-field col s8 offset-s2">
                <input id="a" name="a" value="{{ $a ?? '' }}" type="number" step="1">
                <label for="a">Multiplier</label>

                @if(isset($fails) && isset($fails['a']))
                    @foreach($fails['a'] as $fail)
                        <p style="color: red">{{ $fail }}</p>
                    @endforeach
                @endif
            </div>

            <div class="input-field col s8 offset-s2">
                <input id="c" name="c" value="{{ $c ?? '' }}" type="number" step="1">
                <label for="c">Increment</label>

                @if(isset($fails) && isset($fails['c']))
                    @foreach($fails['c'] as $fail)
                        <p style="color: red">{{ $fail }}</p>
                    @endforeach
                @endif
            </div>

            <div class="input-field col s8 offset-s2">
                <input id="x" name="x" value="{{ $x ?? '' }}" type="number" step="1">
                <label for="x">Initial</label>

                @if(isset($fails) && isset($fails['x']))
                    @foreach($fails['x'] as $fail)
                        <p style="color: red">{{ $fail }}</p>
                    @endforeach
                @endif
            </div>

            <div class="input-field col s8 offset-s2">
                <input id="n" name="n" value="{{ $n ?? 10 }}" type="number" step="1">
                <label for="n">Number</label>

                @if(isset($fails) && isset($fails['n']))
                    @foreach($fails['n'] as $fail)
                        <p style="color: red">{{ $fail }}</p>
                    @endforeach
                @endif
            </div>

            <button class="col s8 offset-s2 btn waves-effect waves-light" type="submit">
                Submit
            </button>

            <div class="input-field col s8 offset-s2" style="margin-top: 20px">
                <input disabled value="{{ $period ?? '' }}" id="period" type="number">
                <label for="period">Period</label>
            </div>
        </div>
    </form>

    <div class="col s8">
        @if(isset($numbers))
            <h5 class="center">Numbers</h5>
            <ol class="collection" id="numbers" style="column-count: 4">
                @foreach($numbers as $number)
                    <li class="collection-item">{{ $number }}</li>
                @endforeach
            </ol>
        @endif
    </div>
</div>

</body>

<style>
    li {
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
        break-inside: avoid;
    }
</style>

</html>
