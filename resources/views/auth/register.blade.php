@extends('layouts.layout')
@section('content')
<div class="container">
  
    <h1 class="mb-5 mt-2 text-center">Register</h1>
    <form>

  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Name" required>
  </div>

  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter Email" required>
  </div>
  <div class="form-group">
    <label>Phone No</label>
    <input type="tel" class="form-control" name="phone" value="{{old('phone')}}" id="phone" placeholder="Enter Phone no" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>

    <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
  </div>
  
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
@endsection





