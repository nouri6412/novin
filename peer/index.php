<html>

<head>
  <script src="https://unpkg.com/peerjs@1.3.2/dist/peerjs.min.js"></script>
</head>

<body>
  <div></div>
  <script>
    var peer = new Peer();
    peer.on('open', function(id) {
      console.log('My peer ID is: ' + id);
    });

    function start() {
      var conn = peer.connect('dest-peer-id');
      conn.on('open', function() {
        // Receive messages
        conn.on('data', function(data) {
          console.log('Received', data);
        });

        // Send messages
        conn.send('Hello!');
      });
    }
  </script>
</body>

</html>