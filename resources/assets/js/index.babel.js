/**
 * index.js
 */

var $ = require('jquery');
var Promise = require('es6-promise').Promise;
import Ajax from './ajax.babel.js';

$(() => {
  /* Variables */
  let $gitName       = $('#github_name');
  let $yoName        = $('#yo_name');
  let $gitNameStatus = $('.git_status');

  let appUrl = location.protocol + '//' + location.host;
  let gitCheckAjax = new Ajax(appUrl + '/check/git');
  let registerAjax = new Ajax(appUrl + '/register/user');

  /* Functions */
  // draw GitHub user name status
  let showStatus = (status) => {
    $gitNameStatus.text(status);
  };

  // parse JSON response and judge it is success
  let checkJson = (json) => {
    return json.status === 'success';
  };

  /* Event Listeners */
  // watch and check GitHub user name
  $gitName.change(() => {
    console.log('Debug: text box changed');
    gitCheckAjax.request({ git_name: $gitName.val() })
      .then((result) => {
        return checkJson(result);
      })
      .then((result) => {
        showStatus(result ? 'user name is valid' : 'invalid user name');
      })
      .catch(error => console.log(error));
  });
});
