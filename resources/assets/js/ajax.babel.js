/**
 * ajax.js
 *
 * Description
 *  format and wrap ajax process
 *
 * Author
 *  sota1235
 */

var $ = require('jquery');

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
    $.ajax({
      url: this.url,
      data: data,
      success: (res) => {
        return res;
      },
      type: 'POST'
    });
  }
}
