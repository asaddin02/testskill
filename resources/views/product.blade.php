@extends('layout')

@section('main')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if (count($products) > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambah-product">
                                <i class="fas fa-plus"></i> Tambah Product
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    {{-- form search --}}
                                    <form action="{{ route('search.product') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="product_search" class="form-control float-right"
                                                placeholder="Cari Nama">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- form search --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-bordered text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($products)
                                            @foreach ($products as $product)
                                                <tr class="text-center">
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->stok }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#edit-product{{ $product->id }}" title="Edit">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <div class="modal fade" id="edit-product{{ $product->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Product</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form class="form-horizontal"
                                                                        action="{{ route('edit.product', $product->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-group row">
                                                                                <label for="edit-nama-product"
                                                                                    class="col-sm-4 col-form-label">
                                                                                    Product Name</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" name="name"
                                                                                        class="form-control"
                                                                                        id="edit-nama-product"
                                                                                        value="{{ $product->name }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="edit-price"
                                                                                    class="col-sm-4 col-form-label">Price
                                                                                </label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="number" name="price"
                                                                                        class="form-control" id="edit-price"
                                                                                        value="{{ $product->price }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="edit-stok"
                                                                                    class="col-sm-4 col-form-label">Stok</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="number" name="stok"
                                                                                        class="form-control" id="edit-stok"
                                                                                        value="{{ $product->stok }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="edit-description"
                                                                                    class="col-sm-4 col-form-label">Description</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" name="description"
                                                                                        class="form-control"
                                                                                        id="edit-description"
                                                                                        value="{{ $product->description }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal">Tutup</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#hapus-product{{ $product->id }}" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <div class="modal fade" id="hapus-product{{ $product->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        Hapus Product
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('delete.product', $product->id) }}">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <h4 class="modal-title">Yakin mau hapus?
                                                                                {{ $product->name }}</h4>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @else
        <div class="text-center">
            <div class="alert alert-warning" role="alert">
                Tidak ada data yang bisa ditampilkan!
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-product">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-product">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('add.product') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="add-nama-product" class="col-sm-4 col-form-label">
                                Product Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="add-nama-product">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="add-price" class="col-sm-4 col-form-label">Price
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control" id="add-price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="add-stok" class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" name="stok" class="form-control" id="add-stok">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="add-description" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input type="text" name="description" class="form-control" id="add-description">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection
