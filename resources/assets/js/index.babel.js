/**
 * index.js
 */

var $ = require('jquery');
import Ajax from './ajax.babel.js';

$(() => {
  console.log('test');

  // test to check git name
  let appUrl = location.protocol + '//' + location.host;
  let ajax = new Ajax(appUrl + '/check/git');
  console.log(ajax.request({ git_name: 'sota1235' }));
  console.log(ajax.request({ git_name: 'hogeee' }));
});
