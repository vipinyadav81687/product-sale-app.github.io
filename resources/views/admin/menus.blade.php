@extends('layouts.admin-layout')
@section('content')
<h2 class="mb-4">Menus</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMenuModal">
  Create Menu
</button>

<!-- Modal -->
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="createMenuForm">
        @csrf
        <div class="modal-body px-4 py-3">
        <div class="form-group mb-3">
        <label>Menu Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Menu Name" required>
        </div>
      
      <div class="form-group mb-3">
      <label>URL:</label>
        <input type="text" class="form-control" name="url" placeholder="URL" required>
      </div>
      <div class="form-group mb-3">
        <label>Is External Link:</label>
        <input type="checkbox" class="mr-1" name="is_external" value="1">
      </div>
      <div class="form-group mb-3">
        <label>Position:</label>
        <select class="form-control" name="position" required>
        <option value="main">Main</option>
        <option value="quick_links_1">Quick Links 1</option>
        <option value="quick_links_2">Quick Links 2</option>
        </select>
      </div>
      <div class="form-group mb-3">
        <label>Parent Menu (Optional):</label>
        <select class="form-control" name="parent_id">
        <option value="">None</option>
        @foreach ($parentMenus as $menu)
        <option value="{{$menu->id }}">{{$menu->name}}</option>
        @endforeach
        </select>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary createBtn">Create</button>
      </div>
</form>
    </div>
  </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function(){
      $('#createMenuForm').submit(function(e){
        e.preventDefault();
        $('.createBtn').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.menu.store') }}",
            type:"POST",
            data:formData,
            success:function(res){
               alert(res.msg);
               $('.createBtn').prop('disabled',false);
               if(res.success){
                location.reload();
               }
            }
        })
      });
    });
    
</script>

@endpush