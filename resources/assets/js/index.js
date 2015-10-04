/**
 * index.js
 */

$ = require('jquery');

$(() => {
  console.log('test');

  $.ajax({
    url: 'http://vagrant.dev:3000/check/git',
    data: {
      git_name: 'sota1235'
    },
    success: (data) => {
      console.log(data);
    },
    type: 'POST'
  });

  $.ajax({
    url: 'http://vagrant.dev:3000/check/git',
    data: {
      git_name: 'hoogehgoe'
    },
    success: (data) => {
      console.log(data);
    },
    type: 'POST'
  });
});
