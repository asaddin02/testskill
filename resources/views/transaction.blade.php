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

    @if (count($transactions) > 0)
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
                                    <form action="{{ route('search.transaction') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="transaction_search" class="form-control float-right"
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
                                            <th>Reference</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Payment Amount</th>
                                            <th>ID Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($transactions)
                                            @foreach ($transactions as $transaksi)
                                                <tr class="text-center">
                                                    <td>{{ $transaksi->id }}</td>
                                                    <td>{{ $transaksi->references_no }}</td>
                                                    <td>{{ $transaksi->price }}</td>
                                                    <td>{{ $transaksi->quantity }}</td>
                                                    <td>{{ $transaksi->payment_amount }}</td>
                                                    <td>{{ $transaksi->product_id }}</td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        {{ $transactions->links() }}
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

    @endsection
