@extends('layouts.master')

@section('body')

@include('github_ribbon')

<div class="container">
  <div>
    <h1>SaborunaYo</h1>
    <div class="sa_form">
      <div class="field">
        <div class="status">
          <p class="git_status"></p>
        </div>
        <input type="text" id="github_name" placeholder="GitHub name" required>
      </div>
      <div class="field">
        <input type="text" id="yo_name" placeholder="Yo name" required>
      </div>
      <button id="register">Register</button>
    </div>
  </div>
</div>
@stop
