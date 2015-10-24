@extends('layouts.master')

@section('body')
<div class="container">
  <div>
    <h1>SaborunaYo</h1>
    <div class="sa_form">
      <input type="text" id="github_name" placeholder="GitHub name" required>
      <div class="status"><span class="git_status"></span></div>
      <input type="text" id="yo_name" placeholder="Yo name" required>
      <button id="register">Register</button>
    </div>
  </div>
</div>
@stop
