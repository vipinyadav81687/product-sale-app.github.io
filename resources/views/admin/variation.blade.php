@extends('layouts.admin-layout')
@section('content')
<h2 class="mb-4">Variations</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
  Add Variation
</button>

     <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>
    @foreach($variations as $variation)
    <tr>
       <td scope="row">{{ $variation->id }} </td>
       <td scope="row">{{ $variation->name }} </td>

       <td>
         {{-- <button class="btn btn-primary editBtn" data-obj='@json($banner)' data-toggle="modal" data-target="#updateModal">
          Edit
        </button>
        <button class="btn btn-danger deleteBtn" data-id="{{$banner->id}}" data-toggle="modal" data-target="#deleteModal">
          Delete
        </button>     --}}
       </td>


      
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center">
{{ $variations->links('pagination::bootstrap-4')}}
</div>
 

<!--Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Variation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="addForm" >
        @csrf
        <div class="modal-body px-4 py-3">
         <div class="form-group mb-3">
        <label>Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Variation Name" required>
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

      $('#addForm').submit(function(e){
        e.preventDefault();
        $('.addBtn').prop('disabled',true);

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('admin.variation.store') }}",
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