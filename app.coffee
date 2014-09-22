express = require 'express'
app = express()

app.set 'view engine', 'jade'
app.set 'views', __dirname + '/views'

app.get '/', (req, res) ->
  res.render 'index', { title: 'Saborunayo' }

app.listen 3000
