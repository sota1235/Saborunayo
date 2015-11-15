/**
 * index.js
 */

import $           from 'jquery';
import { Promise } from 'es6-promise';
import Ajax        from './ajax.babel.js';

$(() => {
  /* Variables */
  let $gitName       = $('#github_name');
  let $yoName        = $('#yo_name');
  let $gitNameStatus = $('.git_status');
  let $submitButton  = $('#register');
  let $updateButton  = $('#update');

  let appUrl = location.protocol + '//' + location.host;
  let gitCheckAjax   = new Ajax(appUrl + '/check/git');
  let registerAjax   = new Ajax(appUrl + '/register/user');
  let updatePhoneNum = new Ajax(appUrl + '/update/phonenumber');

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
  // update phone number
  $updateButton.click(() => {
    console.log('Debug: update phone number');
    let number = $('#phone-number').val();
    updatePhoneNum.request({ phone_number: number})
      .then((result) => {
        if(result.status === 'success') {
          alert('Update phone number success!');
          return
        }
        alert('Update phone number failed...');
      })
      .catch((error) => {
        alert('Server error. Plese contact @sota1235');
      });
  });

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
