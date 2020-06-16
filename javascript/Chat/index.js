const express = require('express')
const http = require('http')
const morgan = require('morgan')
const bodyParser = require('body-parser')
const socketIo = require('socket.io')

// webpack
const webpack = require('webpack');
const webpackDevMiddleware = require('webpack-dev-middleware')
const webpackConfig = require('./webpack.config')

const app = express()
const server = http.createServer(app)
const io = socketIo(server);

app.set('port', process.env.POR || 3000)

app.use(morgan('dev'))
app.use(express.static(__dirname + '/public'))

app.use(webpackDevMiddleware(webpack(webpackConfig)));
app.use(bodyParser.urlencoded({ extended: false }));
const usuarios =[];

const users = {}

io.on('connection', socket => {
  socket.on('new-user', name => {
    users[socket.id] = name
    socket.broadcast.emit('user-connected', name)
    usuarios.push(name);
    socket.emit('user-borrar', usuarios)
    socket.broadcast.emit('user-borrar', usuarios)
  })
  socket.on('send-chat-message', message => {
    socket.broadcast.emit('chat-message', { message: message, name: users[socket.id] })
  })
  socket.on('disconnect', name => {
    socket.broadcast.emit('user-disconnected', users[socket.id])
    let valor =usuarios.indexOf(name);
    usuarios.splice(valor) 
    socket.emit('user-borrar', usuarios)
    socket.broadcast.emit('user-borrar', usuarios)
    delete users[socket.id]
    

  })
})
server.listen(3000,"www.meteopedroespinosa.es");
