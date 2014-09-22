express = require 'express'
app = express()

app.set 'view engine', 'jade'
app.set 'views', __dirname + '/views'

app.use express.static(__dirname + '/public')

app.get '/', (req, res) ->
  res.render 'index', { title: 'Saborunayo' }

app.listen 3000
console.log 'Saborunayo running'
