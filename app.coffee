express = require 'express'
app = express()

app.set 'view engine', 'jade'
app.set 'views', __dirname + '/views'

app.use express.static(__dirname + '/public')

app.get '/', (req, res) ->
  res.render 'index', { title: 'Saborunayo' }

app.listen 3000
console.log 'Saborunayo running'

# databaseの読み出し: Postgresql
pg = require 'pg'
conString = 'postgres://postgres:sota1235@localhost/postgres'

pg.connect conString, (err, client, done) ->
  if err
    return console.error 'error fetching client from pool', err

  client.query 'SELECT $1::int AS numbor', ['1'], (err, resulr) ->
    done()

    if err
      return console.error 'error running query', err

    console.log result.rows[0].numbor

