@extends('master')

@section('konten')
<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          Overview
        </div>
        <h2 class="page-title">
          Data Product
        </h2>
      </div>
      <!-- Page title actions -->        <div class="btn-list">
          <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import User Data</button>
        </form>
      <div class="col-auto ms-auto d-print-none">
          <div class="pull-right">
            <a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>
          </div>
          <div>
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page body -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Invoices</h3>
    </div>
    <tr>
      <div class="container">
          <a class="btn btn-warning float-end" href="{{ route('users.export') }}">Export Product Data</a>
      </div>
  </tr>
    <div class="card-body border-bottom py-3">
      <div class="d-flex">
        <div class="ms-auto text-muted">
    <form action="{{ route('products.index') }}" method="GET">
        <div class="ms-2 d-inline-block">
            <input type="text" name="search" class="form-control form-control-sm" aria-label="Search invoice" placeholder="Search...">
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Search</button>
    </form>
</div>

      </div>
    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th class="w-1">No.
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M6 15l6 -6l6 6" />
              </svg>
            </th>
            <th>Image</th>
            <th>Name Products</th>
            <th>Details</th> 
            <th>Price</th>
            <th>Stock</th>
            <th width="280px">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/images/{{ $product->image }}" width="100px"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
              <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
              <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
              <button class="btn btn-danger" onclick="showDeleteModal('{{ $product->id }}')">Delete</button>

              <!-- Formulir tersembunyi untuk delete -->
              <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center">No products found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="pagination justify-content-center mt-4"></div>
<!-- Tabler Pagination -->
<div class="pagination justify-content-center">
  <ul class="pagination">
    @if ($products->onFirstPage())
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">Previous</a>
      </li>
    @endif

    @for ($page = 1; $page <= $products->lastPage(); $page++)
      <li class="page-item {{ ($page == $products->currentPage()) ? 'active' : '' }}">
        <a class="page-link" href="{{ $products->url($page) }}">{{ $page }}</a>
      </li>
    @endfor

    @if ($products->hasMorePages())
      <li class="page-item">
        <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
      </li>
    @else
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
      </li>
    @endif
  </ul>
</div>



<!-- Modal untuk konfirmasi delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
  function showDeleteModal(productId) {
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
      keyboard: false
    });
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');
    confirmDeleteButton.onclick = function() {
      document.getElementById('delete-form-' + productId).submit();
    };
    deleteModal.show();
  }
</script>
@endsection