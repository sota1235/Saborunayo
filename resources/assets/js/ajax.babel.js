/**
 * ajax.js
 *
 * Description
 *  format and wrap ajax process
 *
 * Author
 *  sota1235
 */

var $       = require('jquery');
var Promise = require('es6-promise').Promise;

export default class Ajax {
  constructor(url) {
    this.url = url;
    // for CSRF token middleware
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
 }

  request (data) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: this.url,
        data: data,
        success: (res) => {
          resolve(res);
        },
        error: (error) => {
          reject(error);
        },
        type: 'POST'
      });
    });
  }
}
