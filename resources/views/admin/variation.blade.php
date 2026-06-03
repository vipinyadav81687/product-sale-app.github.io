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
                <th scope="col">Values</th>
                <th scope="col">Add Value</th>
                <th scope="col">Action</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($variations as $variation)
                <tr>
                    <th scope="row">{{ $variation->id }} </th>
                    <th scope="row">{{ $variation->name }} </th>
                    <th>
                        @foreach ($variation->values as $value)
                            <button class="btn btn-info">{{ $value->value }}
                                <i class="fa fa-times deleteValue" data-id="{{ $value->id }}"></i>
                            </button>
                        @endforeach
                    </th>
                    <th>
                        <button class="btn btn-secondary addVariation" data-id="{{ $variation->id }}"
                            data-name="{{ $variation->name }}" data-toggle="modal" data-target="#addVariationModal">Add
                            Value</button>
                    </th>

                    <td>
                        <button class="btn btn-primary editBtn" data-obj='@json($variation)' data-toggle="modal"
                            data-target="#updateModal">
                            Edit
                        </button>
                        <button class="btn btn-danger deleteBtn" data-obj='@json($variation)' data-toggle="modal"
                            data-target="#deleteModal">
                            Delete
                        </button>
                    </td>



                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $variations->links('pagination::bootstrap-4') }}
    </div>


    <!--Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Variation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="addForm">
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



    <!--Add Variation Value Modal -->
    <div class="modal fade" id="addVariationModal" tabindex="-1" role="dialog" aria-labelledby="addVariationModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add <span id="add-variation-name"></span> Value
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="addVariationForm">
                    @csrf
                    <div class="modal-body px-4 py-3">

                        <input type="hidden" name="variation_id" id="add-variation-id">
                        <div class="form-group mb-3">
                            <label>Value:</label>
                            <input type="text" class="form-control" name="value" placeholder="Value" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addVariationBtn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Variation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="updateForm">
                    @csrf
                    <input type="hidden" name="id" id="edit-id">
                    <div class="modal-body px-4 py-3">
                        <div class="form-group mb-3">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="edit-name" name="name" placeholder="Variation Name" required>
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

    <!--Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Variation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deleteForm">
                    @csrf
                    <input type="hidden" name="id" id="delete-id">
                    <div class="modal-body px-4 py-3">
                       <p>Are you sure you want to delete <b id="delete-name"></b> Variation?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger dltBtn">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('#addForm').submit(function(e) {
                e.preventDefault();
                $('.addBtn').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.variation.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        alert(res.msg);
                        $('.addBtn').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

            //add varition code working  
            $('.addVariation').click(function() {
                $('#add-variation-id').val($(this).data('id'));
                $('#add-variation-name').text($(this).data('name'));

            });

            $('#addVariationForm').submit(function(e) {
                e.preventDefault();
                $('.addVariationBtn').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.variation.value.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        alert(res.msg);
                        $('.addVariationBtn').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });


            $('.deleteValue').click(function() {
                var id = $(this).data('id');
                var confirmDelete = confirm("Are you sure you want to remove this value?");
                var obj = $(this);
                if (confirmDelete) {
                    $.ajax({
                        url: "{{ route('admin.variation.value.destroy') }}",
                        type: "DELETE",
                        data: {
                            id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            alert(res.msg);
                            $('.addVariationBtn').prop('disabled', false);
                            if (res.success) {
                                $(obj).parent().remove();
                            }
                        }
                    });
                }
            });

            $('.editBtn').click(function() {
                var obj = $(this).data('obj');
                $('#edit-id').val(obj.id);
                $('#edit-name').val(obj.name);

            });

              $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.updateBtn').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.variation.update') }}",
                    type: "PUT",
                    data: formData,
                    success: function(res) {
                        alert(res.msg);
                        $('.updateBtn').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

             $('.deleteBtn').click(function() {
                var obj = $(this).data('obj');
                $('#delete-id').val(obj.id);
                $('#delete-name').text(obj.name);
            });

             $('#deleteForm').submit(function(e) {
                e.preventDefault();
                $('.dltBtn').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.variation.destroy') }}",
                    type: "DELETE",
                    data: formData,
                    success: function(res) {
                        alert(res.msg);
                        $('.dltBtn').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

        });
    </script>
@endpush
