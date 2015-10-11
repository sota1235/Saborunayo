@extends('layouts.master')

@section('body')
<h1>Welcome to SaborunaYo!</h1>

<label>
  GitHub name:
  <input type="text" id="github_name" placeholder="Enter your GitHub name" required>
</label>
<div class="status">Status: <span class="git_status"></span></div>
<br />
<label>
  Yo name:
  <input type="text" id="yo_name" placeholder="Enter your Yo name" required>
</label>
<br />
<button id="register">Register</button>

@stop
