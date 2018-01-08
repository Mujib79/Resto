<canvas id="lineChart" height="80px"></canvas>

@if(count($datas) > 0)
    <script type="text/javascript">
        var val = new Array(12);
        @foreach ($datas as $val)
            val[parseInt(({{$val->tanggal}}-1))] = {{$val->total}};
        @endforeach
        var tahun = {{$val->tahun}};
        addChart(val, tahun);
    </script>
@endif
