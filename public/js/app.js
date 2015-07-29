new Vue ({
    el: '#instagram',

    data: {
        instagrams: []
    },
    ready: function() {

        self = this;
        // var socket = io('http://realgram.dev:3000');
         var socket = io('http://45.55.191.139:3000');
         socket.on("test-channel:App\\Events\\EventName", function(message){
             // increase the power everytime we load test route
             self.instagrams.push(message.data);

         });

    }
})
