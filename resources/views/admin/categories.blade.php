@extends('layouts.admin-layout')
@section('content')
<h2 class="mb-4">Categories</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
  Add Category
</button>


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

     
    });
</script>
@endpush