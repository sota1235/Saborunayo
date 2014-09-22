express = require 'express'
app = express()

app.get '/', (req, res) ->
  res.send 'Hello, saborunayo'

app.listen 3000
