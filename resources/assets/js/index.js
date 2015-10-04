/**
 * index.js
 */

$ = require('jquery');

$(() => {
  console.log('test');

  $.ajax({
    url: 'http://vagrant.dev:3000/check/git',
    data: {
      hoge: 'fuga'
    },
    success: (data) => {
      console.log(data);
    },
    type: 'POST'
  });
});
