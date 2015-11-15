@extends('layouts.master')

@section('body')

@include('github_ribbon')

<div class="container">
  <div>
    <h1>
      Hello, {{ \Auth::driver('github')->user()->__get('nickname') }}!!<br />
      Welcome to SaborunaYo
    </h1>
    <div class="sa_form">
      <a href="/edit">
        <button id="edit">Edit phone number</button>
      </a>
      <a href="/logout">
        <button id="logout">Logout</button>
      </a>
    </div>
  </div>
</div>
@stop
