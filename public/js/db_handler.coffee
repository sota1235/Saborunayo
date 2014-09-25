# Description:
#   Database handler for postgresql
#   app name: saborunayo
#
# Functions:
#   sendQuery(query)
#   getGithubName(yo_name)
#   writeData(yo_name, github_name)
#
# Author:
#   @sota1235

pg = require 'pg'

Db_Handler = ->
  this.db_url = process.env.DATABASE_URL
  this.db_name = "user_list"
  # Send query to database
  this.sendQuery = (query) ->
    pg.connect this.db_url, (err, client, done) ->
      if err
        return [false, err]
      client.query query, (err, result) ->
        done()
        if err
          return [false, err]
        return [true, result.rows]

# Get data from database
Db_Handler.prototype.getGithubName = (yo_name) ->
  query = "SELECT github_name FROM #{db_name} WHERE yo_name='#{yo_name}';"
  return this.sendQuery query

# Insert data to database
# yo_name -> yo_name
# github_name -> github_name
Db_Handler.prototype.writeData = (yo_name, github_name) ->
  query = "INSERT INTO '#{this.db_name}' (yo_name, github_name) values ('#{yo_name}', '#{github_name}');"

  # TODO: Yoアカウントがあるかどうか検証
  # TODO: githubアカウントが実在するかどうか検証
  return this.sendQuery query

# Delete data in database
Db_Handler.prototype.deleteData = (yo_name) ->
  query = "DELETE FROM #{this.db_name} WHERE yo_name='#{yo_name}';"
  return this.sendQuery query

module.exports = Db_Handler
