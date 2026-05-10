@extends('layouts.admin-layout')

@section('content')

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">App Data</h2>
        </div>
        
         @if(Session::has('success'))
         <div class="alert alert-success" role="alert">
           {{ Session::get('success') }}
         </div>
         @endif
        <div class="card-body">
            <form action="{{ route('updateAppData') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ isset($data->id)?$data->id: '' }}">
                <div class="row">

                    <!-- Logo First Text -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Logo First Text</label>
                            <input type="text" class="form-control" name="logo_first_text" placeholder="Logo First Text" value="{{ isset($data->logo_first_text)?$data->logo_first_text: '' }}">

                            @error('logo_first_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Logo Second Text -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Logo Second Text</label>
                            <input type="text" class="form-control" name="logo_second_text" placeholder="Logo Second Text"  value="{{ isset($data->logo_second_text)?$data->logo_second_text: '' }}">

                            @error('logo_second_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Heading -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control" name="heading" placeholder="Heading" value="{{ isset($data->heading)?$data->heading: '' }}">

                            @error('heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" name="location" placeholder="Location" value="{{ isset($data->location)?$data->location: '' }}" >

                            @error('location')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email"  value="{{ isset($data->email)?$data->email: '' }}">

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone"  value="{{ isset($data->phone)?$data->phone: '' }}" >

                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Site Name -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Site Name</label>
                            <input type="text" class="form-control" name="site_name" placeholder="Site Name" value="{{ isset($data->site_name)?$data->site_name: '' }}">

                            @error('site_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Facebook -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Facebook URL</label>
                            <input type="text" class="form-control" name="facebook" placeholder="Facebook URL" value="{{ isset($data->facebook)?$data->facebook: '' }}">

                            @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Twitter -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Twitter URL</label>
                            <input type="text" class="form-control" name="twitter" placeholder="Twitter URL" value="{{ isset($data->twitter)?$data->twitter: '' }}">

                            @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Linkedin -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Linkedin URL</label>
                            <input type="text" class="form-control" name="linkedin" placeholder="Linkedin URL" value="{{ isset($data->linkedin)?$data->linkedin: '' }}">

                            @error('linkedin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                     <!-- Instagram -->
                     <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Instagram URL</label>
                            <input type="text" class="form-control" name="instagram" placeholder="Instagram URL" value="{{ isset($data->instagram)?$data->instagram: '' }}">

                            @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Youtube -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>YouTube URL</label>
                            <input type="text" class="form-control" name="youtube" placeholder="YouTube URL"  value="{{ isset($data->youtube)?$data->youtube: '' }}">

                            @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                   

                </div>
                 <!-- Contact Touch text -->
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Contact Touch Text</label>
                            <input type="text" class="form-control" name="contact_touch_text" placeholder="Contact Touch Text"  value="{{ isset($data->contact_touch_text)?$data->contact_touch_text: '' }}">

                            @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    </div>

                <!-- Submit Button -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary px-4">
                        Save Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection