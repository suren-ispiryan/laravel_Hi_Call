const express = require("express");
const app = express();
const http = require("http").Server(app);
const io = require("socket.io")(http, {
    cors: { origin: "http://127.0.0.1:8000" },
});
const port = process.env.PORT || 5000;

app.use(express.static(__dirname + "/public"));

function onConnection(socket) {
    socket.on("drawing", (data) => socket.broadcast.emit("drawing", data));
}

io.on("connection", onConnection);

http.listen(port, () => console.log("listening on port " + port));
