@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Product</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Product</label>
                                    <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock Product</label>
                                    <input type="text" class="form-control" value="{{ $product->stock }} pcs" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="price">Harga Product</label>
                                    <input type="text" class="form-control"
                                        value="{{ GlobalHelper::formatRupiah($product->price) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail Product</label>
                                    <input type="text" class="form-control" value="{{ $product->thumbnail }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div>{!! $product->description !!}</div>
                                </div>

                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <div class="row">
                                        @foreach ($product->image as $image)
                                            <div class="col-md-3">
                                                <img src="{{ FileHelper::getImage("/products/$product->name/$image->image") }}"
                                                    class="img-fluid" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
