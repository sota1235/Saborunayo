express = require 'express'
async   = require 'async'

Db_Handler = require(__dirname + '/public/js/db_handler')
handle = new Db_Handler()

app = express()

app.set 'view engine', 'jade'
app.set 'views', __dirname + '/views'

app.use express.static(__dirname + '/public')

app.get '/', (req, res) ->
  res.render 'index', { title: 'Saborunayo' }

app.listen 3000
console.log 'Saborunayo running'

funcs = [
  (callback) ->
    handle.writeData 'test', 'sota1236', (err, data) ->
      console.log 'Result:' + data
      callback null, 'one'
  (callback) ->
    handle.getGithubName 'test', (err, data) ->
      console.log 'Result:' + data
      callback null, 'two'
]

async.series funcs
