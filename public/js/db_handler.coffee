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

module.exports = class Db_Handler

  constructor: ->
    @db_url = process.env.DATABASE_URL
    @db_name = "user_list"
    @client = new pg.Client @db_url

  # Send query to database
  sendQuery: (command, callback = ->) ->
    client = new pg.Client @db_url
    client.connect (err) ->
      if err
        calback [err, null]
        return
      client.query command, (err, result) ->
        if err
          callback [err, null]
          return
        callback [null, result.rows]
        return

  # Get data from database
  getGithubName: (yo_name, callback = ->) ->
    query = "SELECT github_name FROM #{@db_name} WHERE yo_name='#{yo_name}';"
    @sendQuery query, (data) ->
      callback data[0], data[1]
      return

  # Insert data to database
  # yo_name -> yo_name
  # github_name -> github_name
  writeData: (yo_name, github_name, callback = ->) ->
    query = "INSERT INTO #{@db_name} (yo_name, github_name) values ('#{yo_name}', '#{github_name}');"

    # TODO: Yoアカウントがあるかどうか検証
    # TODO: githubアカウントが実在するかどうか検証
    @sendQuery query, (data) ->
      callback data[0], data[1]
      return

  # Delete data in database
  deleteData: (yo_name, callback = ->) ->
    query = "DELETE FROM #{@db_name} WHERE yo_name='#{yo_name}';"
    @sendQuery query, (data) ->
      callback data[0], data[1]
      return
