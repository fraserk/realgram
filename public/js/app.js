new Vue ({
    el: '#instagram',

    data: {
        instagrams: ['kim']
    },
    ready: function() {

        self = this;
        // var socket = io('http://realgram.dev:3000');
         var socket = io.connect('http://real.picblocks.com:3000');
         socket.on("test-channel:App\\Events\\EventName", function(message){
             // increase the power everytime we load test route
             self.instagrams.push(message.data);

         });

    }
})
