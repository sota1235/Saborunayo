@extends('layouts.master')

@section('body')

@include('github_ribbon')

<div class="container">
  <div class="login">
    <h1>Welcome to SaborunaYo</h1>
    <h3>Let's Signup!!</h3>
    <div class="sa_form">
      <a href="/auth">
        <button id="login">
          GitHub Login
          <i class="fa fa-github"></i>
        </button>
      </a>
    </div>
  </div>
</div>
@stop
