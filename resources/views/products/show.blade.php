@extends('master')

@section('konten')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <p class="text-muted">{{ $product->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Details:</strong>
                        <p class="text-muted">{{ $product->detail }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Image:</strong>
                        <div>
                            <img src="/images/{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
