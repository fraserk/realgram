@extends('master')

@section('content')
    <p id="power">0</p>
@stop

@section('footer')

    <script>
        //var socket = io('http://localhost:3000');
        var socket = io('http://real.picblocks.com:3000');
        socket.on("test-channel:App\\Events\\EventName", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt(message.data.power));
        });
    </script>
@stop
