<html>

<head>
  <script src="https://unpkg.com/peerjs@1.3.2/dist/peerjs.min.js"></script>
  <script src="jquery.min.js"></script>
</head>

<body>
  <div>
    <input id="cid" name="cid" value="" placeholder="my id" />
    <br>
    <input id="did" name="did" value="" placeholder="dest id" />
    <br>
    <button onclick="start_connection()">Start connection</button>
    <br>
    <textarea id="mes-box" name="mes-box"></textarea>
    <button onclick="send_message()">send message</button>
    <br>
    <div id="res-box"></div>
  </div>
  <script>
    var peer = new Peer();
    peer.on('open', function(id) {
      console.log('My peer ID is: ' + id);
      $('#cid').val(id);
    });

    let conn;

    function start_connection() {
      conn = peer.connect($('#did').val());
      conn.on("open", () => {
        conn.send("hi!");
      });
    }

    function send_message()
    {
      conn.send($('#mes-box').val());
    }

    peer.on("connection", (conn1) => {
      console.log(conn1);
      conn1.on("data", (data) => {
        // Will print 'hi!'
        console.log(data);
      });
    });
  </script>
</body>

</html>