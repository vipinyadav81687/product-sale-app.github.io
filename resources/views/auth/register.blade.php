@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<div class="container">
  
    <h1 class="mb-5 mt-2 text-center">Register</h1>
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


    <form method="POST" action="{{ route('register')}}">
      @csrf
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Name" required>
     @error('name')
     <span class="error-message">
      {{ $message }}
      </span> 
      @enderror
  </div>

  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter Email" required>
  @error('email')
     <span class="error-message">
      {{ $message }}
     </span> 
  @enderror

  </div>
  <div class="form-group">
    <label>Phone No</label>
    <br>
    <input type="hidden" name="code" id="code">
    <input type="tel" class="form-control" name="phone" value="{{old('phone')}}" id="phone" placeholder="Enter Phone no" required>
       @error('phone')
     <span class="error-message">
      {{ $message }}
     </span> 
       @enderror

  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
        @error('password')
     <span class="error-message">
      {{ $message }}
  </span> 
       @enderror

  </div>

    <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
   @error('password_confirmation')
     <span class="error-message">
      {{ $message }}
     </span> 
   @enderror

  </div>
  
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
@endsection

@push('script')
  <script>
        //for country code mobile

        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "IN",
            separateDialCode: true,
            utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        $(document).ready(function(){
            $('#code').val('+'+phoneInput.getSelectedCountryData().dialCode);
            //for end country code mobile
            const errorMap = [":- Invalid phone number", ":- Invalid country code", ":- Phone Number is Too short", ":- Phone Number is Too long", ":- Invalid phone number"];
            $('#phone').keyup(function(){

                $('#code').val('+'+phoneInput.getSelectedCountryData().dialCode);

            });

            $('.iti__flag-container').click(function(){
                $('#code').val('+'+phoneInput.getSelectedCountryData().dialCode);
            });
        });

    </script>  
@endpush



