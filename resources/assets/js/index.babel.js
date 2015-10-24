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
  let $submitButton  = $('#register');

  let appUrl = location.protocol + '//' + location.host;
  let gitCheckAjax = new Ajax(appUrl + '/check/git');
  let registerAjax = new Ajax(appUrl + '/register/user');

  /* Functions */
  // draw GitHub user name status
  let showStatus = (status, isValid) => {
    $gitNameStatus.text(status);
    $gitNameStatus.css('color', isValid ? 'lightgreen' : 'red');
  };

  let checkStatus = () => {
    $gitNameStatus.text('Checking...');
    $gitNameStatus.css('color', 'blue');
  };

  // parse JSON response and judge it is success
  let checkJson = (json) => {
    return json.status === 'success';
  };

  /* Event Listeners */
  // watch and check GitHub user name
  $gitName.change(() => {
    console.log('Debug: text box changed');
    checkStatus();
    gitCheckAjax.request({ git_name: $gitName.val() })
      .then((result) => {
        return checkJson(result);
      })
      .then((result) => {
        showStatus(result ? 'User name OK!!' : 'invalid user name', result);
      })
      .catch(error => console.log(error));
  });

  // register user
  $submitButton.click(() => {
    console.log('Debug: post request to register user');
    let data = {
      git_name: $gitName.val(),
      yo_name : $yoName.val()
    };
    registerAjax.request(data)
      .then((result) => {
        return checkJson(result);
      })
      .then((result) => {
        alert(result ? 'Register successed!!' : 'Register failed..');
        return false;
      })
      .catch((error) => {
        console.log(error);
        return false;
      });
  });
});
