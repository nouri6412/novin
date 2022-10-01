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
    <video id="vid-box"></video>
  </div>
  <script>
    function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}

    var peer = new Peer(getRndInteger(1,1000));
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

    function send_message() {
      conn.send($('#mes-box').val());
    }

    peer.on("connection", (conn1) => {
      console.log(conn1);
      conn1.on("data", (data) => {
        // Will print 'hi!'
        console.log(data);
      });
    });

    function call() {
      navigator.mediaDevices.getUserMedia({
          video: true,
          audio: true
        },
        (stream) => {
          const call = peer.call($('#did').val(), stream);
          call.on("stream", (remoteStream) => {
            // Show stream in some <video> element.
          });
        },
        (err) => {
          console.error("Failed to get local stream", err);
        },
      );
    }

    function cal_res() {
      peer.on("call", (call) => {
        navigator.mediaDevices.getUserMedia({
            video: true,
            audio: true
          },
          (stream) => {
            call.answer(stream); // Answer the call with an A/V stream.
            call.on("stream", (remoteStream) => {
              // Show stream in some <video> element.
            });
          },
          (err) => {
            console.error("Failed to get local stream", err);
          },
        );
      });
    }
  </script>
</body>

</html>