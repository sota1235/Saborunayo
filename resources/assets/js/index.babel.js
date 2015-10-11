/**
 * index.js
 */

var $ = require('jquery');
var Promise = require('es6-promise').Promise;
import Ajax from './ajax.babel.js';

$(() => {
  console.log('test');

  // test to check git name
  let appUrl = location.protocol + '//' + location.host;
  let ajax = new Ajax(appUrl + '/check/git');

  ajax.request({ git_name: 'sota1235' })
    .then(result => console.log(result))
    .catch(error => console.log(error));
  ajax.request({ git_name: 'hogeee' })
    .then(result => console.log(result))
    .catch(error => console.log(error));
});
