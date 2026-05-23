@extends('layouts.admin-layout')
@section('content')
<h2 class="mb-4">Menus</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMenuModal">
  Create Menu
</button>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Menu</th>
      <th scope="col">URL</th>
      <th scope="col">External</th>
      <th scope="col">Position</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($menus as $menu)
    <tr>
       <td scope="row">{{$menu->id}} </td>
       <td scope="row">{{$menu->name}} </td>
       <td scope="row">{{$menu->url}} </td>
       <td scope="row">{{$menu->is_external == 1?'Yes':'NO'}} </td>
       <td scope="row">{{$menu->position}} </td>
       <td>
        <button class="btn btn-danger deleteBtn" data-id="{{$menu->id}}" data-toggle="modal" data-target="#deleteMenuModal">
          Delete
        </button>
         <button class="btn btn-primary editBtn" data-obj="{{$menu}}" data-toggle="modal" data-target="#updateMenuModal">
          Edit
        </button>
       </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center">
{{ $menus->links('pagination::bootstrap-4')}}
</div>


<!--Create Modal -->
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="deleteMenuForm">
        @csrf
        <input type="hidden" name="id" id="deleteMenuId">
        <div class="modal-body">
        <p> Are you sure, You Want to delete the Menu?</p>
        
        </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger btnDelete">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateMenuModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="updateMenuForm">
        @csrf
        <input type="hidden" name="id" id="updateMenuId">
        <div class="modal-body px-4 py-3">
        <div class="form-group mb-3">
        <label>Menu Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Menu Name" id="menuName" required>
        </div>
      
      <div class="form-group mb-3">
      <label>URL:</label>
        <input type="text" class="form-control" name="url" placeholder="URL" id="url" required>
      </div>
      <div class="form-group mb-3">
        <label>Is External Link:</label>
        <input type="checkbox" class="mr-1" name="is_external" id="is_external" value="1">
      </div>
      <div class="form-group mb-3">
        <label>Position:</label>
        <select class="form-control" name="position" is="position" required>
        <option value="main">Main</option>
        <option value="quick_links_1">Quick Links 1</option>
        <option value="quick_links_2">Quick Links 2</option>
        </select>
      </div>
      <div class="form-group mb-3">
        <label>Parent Menu (Optional):</label>
        <select class="form-control" name="parent_id" id="parent_id">
        <option value="">None</option>
        @foreach ($parentMenus as $menu)
        <option value="{{$menu->id }}">{{$menu->name}}</option>
        @endforeach
        </select>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary updateBtn">Update</button>
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


      $('.deleteBtn').click(function(){
        var id = $(this).data('id');
        $('#deleteMenuId').val(id);
      });

      $('#deleteMenuForm').submit(function(e){
        e.preventDefault();
        $('.btnDelete').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.menu.destroy') }}",
            type:"DELETE",
            data:formData,
            success:function(res){
               alert(res.msg);
               $('.btnDelete').prop('disabled',false);
               if(res.success){
                location.reload();
               }
            }
        })
      });

      //edit work
       $('.editBtn').click(function(){
        var data = $(this).data('obj');
        console.log(data);
        $('#updateMenuId').val(data.id);
        $('#menuName').val(data.name);
        $('#url').val(data.url);
        if(data.is_external){
        $('#is_external').prop('checked',true);
        }
        else{
          $('#is_external').prop('checked',false);
        }
        $('#position').val(data.position);
        $('#parentId').val(data.parent_id);
       });

      $('#updateMenuForm').submit(function(e){
        e.preventDefault();
        $('.updateBtn').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.menu.update') }}",
            type:"PUT",
            data:formData,
            success:function(res){
               alert(res.msg);
               $('.updateBtn').prop('disabled',false);
               if(res.success){
                location.reload();
               }
            }
        })
      });
    });
    
</script>

@endpush