@extends('master')
@section('konten')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Edit Product</h2>
                <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
            </div>
        </div>
    </div>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="edit-form-{{ $product->id }}">
        @csrf
        @method('PUT')
 
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input class="form-control" name="price" placeholder="Price" placeholder="Price" value="{{ $product->price }}"></input>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Stock:</strong>
                    <input class="form-control" name="stock" value="{{ $product->stock }}" placeholder="Stock" placeholder="Stock"></input>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/images/{{ $product->image }}" class="img-fluid mt-2" width="300px">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary" onclick="showEditModal()">Submit</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal for edit confirmation -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to edit this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmEditButton">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showEditModal() {
        var editModal = new bootstrap.Modal(document.getElementById('editModal'), {
            keyboard: false
        });
        var confirmEditButton = document.getElementById('confirmEditButton');
        confirmEditButton.onclick = function() {
            document.getElementById('edit-form-{{ $product->id }}').submit();
        };
        editModal.show();
    }
</script>
@endsection
