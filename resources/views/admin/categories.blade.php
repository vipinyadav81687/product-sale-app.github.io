@extends('layouts.admin-layout')
@section('content')
<h2 class="mb-4">Categories</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
  Add Category
</button>

     <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Menu</th>
      <th scope="col">Parent Category</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($allCategories as $category)
    <tr>
       <td scope="row">{{$category->id}} </td>
       <td scope="row">{{$category->name}} </td>
       <td scope="row">{{$category->parent?$category->parent->name:'-'}} </td>
       <td>
        <button class="btn btn-danger deleteBtn" data-id="{{$category->id}}" data-toggle="modal" data-target="#deleteCategoryModal">
          Delete
        </button>
         <button class="btn btn-primary editBtn" data-obj='@json($category)' data-toggle="modal" data-target="#updateCategoryModal">
          Edit
        </button>
       </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center">
{{ $allCategories->links('pagination::bootstrap-4')}}
</div>



<!--Create Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="addCategoryForm">
        @csrf
        <div class="modal-body px-4 py-3">
        <div class="form-group mb-3">
        <label>Category Name:</label>
        <input type="text" class="form-control" name="category_name" placeholder="Category Name" required>
        </div> 
        <div class="form-group mb-3">
        <label>Parent Category:</label>
        <select name="parent_id" class="form-control">
            <option value="">None</option>
            @foreach ($categoies as $category)
            <option value="{{ $category->id }}">{{ $category->name}} </option>    
            @endforeach
        </select>
        </div> 
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary addBtn">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="deleteCategoryForm">
        @csrf
        <input type="hidden" name="id" id="deleteCategoryId">
        <div class="modal-body">
        <p> Are you sure, You Want to delete the Category (also deleted child categories)?</p>
        
        </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger btnDelete">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Update Modal -->
<div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="updateCategoryForm">
        @csrf
        <input type="hidden" name="id" id="categoryId">
        <div class="modal-body px-4 py-3">
        <div class="form-group mb-3">
        <label>Category Name:</label>
        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required>
        </div> 
        <div class="form-group mb-3">
        <label>Parent Category:</label>
        <select name="parent_id" id="parent_id" class="form-control">
            <option value="">None</option>
            @foreach ($categoies as $category)
            <option value="{{ $category->id }}">{{ $category->name}} </option>    
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
      $('#addCategoryForm').submit(function(e){
        e.preventDefault();
        $('.addBtn').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.category.store') }}",
            type:"POST",
            data:formData,
            success:function(res){
               alert(res.msg);
               $('.addBtn').prop('disabled',false);
               if(res.success){
                location.reload();
               }
            }
        });
     });

        //delete work
      $('.deleteBtn').click(function(){
        var id = $(this).data('id');
        $('#deleteCategoryId').val(id);
      });

      $('#deleteCategoryForm').submit(function(e){
        e.preventDefault();
        $('.btnDelete').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.category.destroy') }}",
            type:"DELETE",
            data:formData,
            success:function(res){
               alert(res.msg);
               $('.btnDelete').prop('disabled',false);
               if(res.success){
                location.reload();
               }
            }
        });
      });

            //edit work
       $('.editBtn').click(function(){
        var data = $(this).data('obj');
           console.log(data);
        $('#categoryId').val(data.id);
        $('#category_name').val(data.name);

        $('#parent_id').val(data.parent_id);
       });

      $('#updateCategoryForm').submit(function(e){
        e.preventDefault();
        $('.updateBtn').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.category.update') }}",
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