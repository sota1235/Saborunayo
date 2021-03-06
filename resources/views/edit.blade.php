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
        <input type="text" id="phone-number" value="{{ $phoneNumber or null}}" placeholder="Enter your phone number" required>
      </div>
      <button id="update">Update</button>
      <a href="/">
        <button id="back">Back to Main page</button>
      </a>
    </div>
  </div>
</div>
@stop
