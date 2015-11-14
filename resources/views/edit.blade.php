@extends('layouts.master')

@section('body')

@include('github_ribbon')

<div class="container">
  <div class="edit">
    <h1>Edit your Phone number</h1>
    <h3>
      <p>Enter your phone number.</p>
      <p>SaborunaYo called it when you do not develop!</p>
    </h3>
    <div class="sa_form">
      <div class="field">
        <input type="text" id="github_name" value={{ $githubName }} required>
      </div>
      <div class="field">
        <input type="text" id="yo_name" value="{{ $phoneNumber or null}}" placeholder="Enter your phone number" required>
      </div>
      <button id="register">Edit</button>
    </div>
  </div>
</div>
@stop
