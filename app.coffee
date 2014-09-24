express = require 'express'
pg = require 'pg'
app = express()

app.set 'view engine', 'jade'
app.set 'views', __dirname + '/views'

app.use express.static(__dirname + '/public')

app.get '/', (req, res) ->
  res.render 'index', { title: 'Saborunayo' }

app.listen 3000
console.log 'Saborunayo running'

# databaseの読み出し
# Thanks for http://qiita.com/ta9to/items/f7b55246cfe42ed14743
pg.connect process.env.DATABASE_URL, (err, client, done) ->
  if err
    return console.error 'error fetching client from pool', err

  client.query 'SELECT * FROM post', (err, result) ->
    done()

    if err
      return console.error 'error running query', err

    console.log result.rows
