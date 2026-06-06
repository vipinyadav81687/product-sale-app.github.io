@extends('layouts.admin-layout')

@section('content')
    <h2 class="mb-4">Products</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        Create Product
    </button>


    <!--Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="createForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body px-4 py-3">
                        <div class="form-group mb-3">
                            <label>Images:</label>
                            <input type="file" class="form-control" name="images" placeholder="Product Images" required
                                multiple accept=".jpg, .jpeg, .png, .web">
                        </div>
                        <div class="form-group mb-3">
                            <label>Title:</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Price (INR):</label>
                                    <input type="number" class="form-control" name="inr_price" placeholder="Price (INR)"
                                        required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Price (USD):</label>
                                    <input type="number" class="form-control" name="usd_price" placeholder="Price (USD)"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Stock:</label>
                            <input type="number" min="1" class="form-control" name="stock"
                                placeholder="Enter Stock Quantity" required>
                        </div>
                        <div class="form-group">
                            <label>Categories:</label>
                            <div class="dropdown w-100">
                                <div class="dropdown-btn" onclick="toggleDropdown()">Select Options</div>
                                <div class="dropdown-content">
                                    @foreach (getAllCategories() as $category)
                                        <label>
                                            <input type="checkbox" data-name="{{ $category->name }}"
                                                value="{{ $category->id }}" onchange="updateSelected()">
                                            {{ $category->name }}
                                        </label>
                                        @if ($category->children->isNotEmpty())
                                            @foreach ($category->children as $childCategory)
                                                <label>
                                                    <input type="checkbox" data-name="{{ $childCategory->name }}"
                                                        value="{{ $childCategory->id }}" onchange="updateSelected()">
                                                    {{ $childCategory->name }}
                                                </label>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Variations</label>
                            @foreach (getVariations() as $variation)
                            <div class="mb-3">
                                <label class="form-label">{{$variation->name}}</label>
                                <select name="variations[{{ $loop->index }}][variation_value_ids]" class="form-control" multiple>
                                    @foreach ($variation->values as $value )
                                    <option value="{{ $value->id }}">{{ $value->value}}</option>      
                                    @endforeach
                                </select>
                                <input type="hidden" name="variations[{{ $loop->index}}][variation_id]"
                                value="{{ $variation->id}}">
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group mb-3">
                            <label>Description:</label>
                            <textarea name="description" class="form-control" placeholder="Description" cols="30" rows="10"></textarea>
                        </div>
                         <div class="form-group mb-3">
                            <label>Additional Information:</label>
                            <textarea name="add_information" class="form-control" placeholder="Additional Information" cols="30" rows="10"></textarea>
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
        function toggleDropdown() {
            const dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('open');
        }

        function updateSelected() {
            const checkboxes = document.querySelectorAll('.dropdown-content input[type="checkbox"]');
            const selected = [];
            const showName = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selected.push(checkbox.value);
                    showName.push(checkbox.getAttribute('data-name'))
                }
            });
            document.querySelector('.dropdown-btn').textContent = showName.length > 0 ? showName.join(', ') :
                'Select Options';
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('open');
            }
        });
    </script>
@endpush
