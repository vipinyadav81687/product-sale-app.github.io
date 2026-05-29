@extends('layouts.admin-layout')
@section('content')
<h2 class="mb-4">Banners</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
  Add Banner
</button>

     <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Paragraph</th>
      <th scope="col">Heading</th>
      <th scope="col">Button Text</th>
      <th scope="col">Link</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>
    @foreach($banners as $banner)
    <tr>
       <td scope="row">{{ $banner->id }} </td>
       <td><img src="{{asset($banner->image) }}" width="100px" /> </td>
       <td>{{$banner->paragraph}}</td>
       <td>{{$banner->heading}}</td>
       <td>{{$banner->btn_text}}</td>
       <td>{{$banner->link}}</td>
       <td>{{$banner->status?'Enabled':'Disabled'}}</td>
       <td>
       </td>


      
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center">
{{ $banners->links('pagination::bootstrap-4')}}
</div>
 

<!--Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="addForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body px-4 py-3">
        <div class="form-group mb-3">
        <label>Select Banner:</label>
        <input type="file" class="form-control" name="image" required>
        </div> 
        <div class="form-group mb-3">
        <label>Paragraph:</label>
        <input type="text" class="form-control" name="paragraph" placeholder="Paragraph">
        </div> 
         <div class="form-group mb-3">
        <label>Heading:</label>
        <input type="text" class="form-control" name="heading" placeholder="Heading" required>
        </div>
         <div class="form-group mb-3">
        <label>Button Text:</label>
        <input type="text" class="form-control" name="btn_text" placeholder="Button Text">
        </div>
         <div class="form-group mb-3">
        <label>Link:</label>
        <input type="text" class="form-control" name="link" placeholder="Link">
        </div>
         <div class="form-group mb-3">
        <label>Status:</label>
        <select name="status" class="form-control">
            <option value="1">Enable</option>
          <option value="0">Disable</option>
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
      $('#addForm').submit(function(e){
        e.preventDefault();
        $('.addBtn').prop('disabled',true);

        var formData = new FormData(this);

        $.ajax({
            url:"{{ route('admin.banner.store') }}",
            type:"POST",
            data:formData,
            processData: false,
            contentType: false,
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