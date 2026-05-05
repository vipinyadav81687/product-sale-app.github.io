@extends('layouts.layout')
@section('content')
<div class="container">
  
    <h1 class="mb-5 mt-2 text-center">Forget Password</h1>
     @if(Session::has('success'))
     <div class="alert alert-success" role="alert">
     {{Session::get('success')}}
     </div>
     @endif
        @if(Session::has('error'))
     <div class="alert alert-danger" role="alert">
     {{Session::get('error')}}
     </div>
     @endif


    <form method="POST" action="{{ route('forgetPassword')}}">
      @csrf
  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter Email" required>
  @error('email')
     <span class="error-message">
      {{ $message }}
     </span> 
  @enderror
  </div>
 
  
  
  <button type="submit" class="btn btn-primary">Forget Password</button>
</form>

</div>
@endsection




