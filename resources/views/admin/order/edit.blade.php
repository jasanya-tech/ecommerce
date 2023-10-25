@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Pesanan Baru</h1>
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
                                <form method="POST" action="{{ route('order.update', $order->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="no_resi">No Resi</label>
                                        <input type="number" class="form-control" id="no_resi" name="no_resi"
                                            min="1" value="{{ old('no_resi', $order->no_resi) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="user_id">Pilih User</label>
                                        <select class="form-control" id="user_id" name="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if (old('user_id', $order->user_id) == $user->id) selected @endif>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id*')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="product">Pilih Produk</label>
                                        <select class="form-control" id="product" name="product_id">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if (old('product_id') == $product->id) selected @endif>
                                                    {{ $product->name }} ({{ $product->stock }} pcs) -
                                                    {{ GlobalHelper::formatRupiah($product->price) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity">Jumlah Produk</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            min="1" value="{{ old('quantity') }}">
                                    </div>

                                    <div id="selected-products" class="mb-3">
                                        <span>Pesanan Anda:</span>
                                        @foreach (json_decode(old('selected_products')) ?? json_decode($selectedProductsJSON) as $selectedProduct)
                                            <div data-product-id="{{ $selectedProduct->productId }}">
                                                {{ $products->where('id', $selectedProduct->productId)->first()->name }}
                                                ({{ $products->where('id', $selectedProduct->productId)->first()->stock }}
                                                pcs)
                                                - Jumlah: {{ $selectedProduct->quantity }}
                                                - Total:
                                                {{ GlobalHelper::formatRupiah($products->where('id', $selectedProduct->productId)->first()->price * $selectedProduct->quantity) }}
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeProduct({{ $selectedProduct->productId }})">
                                                    X
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('selected_products*')
                                        <p class="help-block" style="color:red;">{{ $message }}</p>
                                    @enderror
                                    <button type="button" class="btn btn-primary" id="add-product">Tambah Produk</button>
                                    <br>
                                    <br>
                                    <input type="hidden" name="selected_products" id="selected_products_input"
                                        value="{{ old('selected_products') ?? $selectedProductsJSON }}">

                                    <div class="form-group">
                                        <label for="payment" class="form-label">Payment Name:</label>
                                        <select class="form-control" id="payment" name="payment" required>
                                            <option value="">Select Payment</option>
                                            @foreach ($payments as $payment)
                                                <option value="{{ $payment->id }}"
                                                    @if (old('payment', $order->payment->id) == $payment->id) selected @endif>
                                                    {{ $payment->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('payment')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="form-label">Alamat Detail:</label>
                                        <textarea required class="form-control" id="address" name="address" rows="2">{{ old('address', $order->address) }}</textarea>
                                        @error('address')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="additional_note" class="form-label">Catatan Tambahan:</label>
                                        <textarea required class="form-control" id="additional_note" name="additional_note" rows="4">{{ old('additional_note', $order->additional_note) }}</textarea>
                                        @error('additional_note')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status Pesanan</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Silahkan Lakukan Pembayaran"
                                                @if (old('status', $order->status) == 'Silahkan Lakukan Pembayaran') selected @endif>Silahkan Lakukan
                                                Pembayaran
                                            </option>
                                            <option value="Pesanan Diproses"
                                                @if (old('status', $order->status) == 'Pesanan Diproses') selected @endif>Pesanan Diproses
                                            </option>
                                            <option value="Pesanan Dikirim"
                                                @if (old('status', $order->status) == 'Pesanan Dikirim') selected @endif>Pesanan Dikirim
                                            </option>
                                            <option value="Pesanan Diterima"
                                                @if (old('status', $order->status) == 'Pesanan Diterima') selected @endif>Pesanan Diterima
                                            </option>
                                            <option value="Pesanan Dibatalkan"
                                                @if (old('status', $order->status) == 'Pesanan Dibatalkan') selected @endif>Pesanan Dibatalkan
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_proof">Unggah Bukti Pembayaran</label>
                                        <input type="file" class="form-control-file" name="payment_proof">
                                        @error('payment_proof')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                        @if (!$order->payment_proof)
                                            <p>Belum mengunggah bukti transaksi</p>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary">Edit Pesanan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    @push('scripts')
        <script>
            function removeProduct(productId) {
                const selectedProductsDiv = document.getElementById('selected-products');
                const productToRemove = selectedProductsDiv.querySelector(`[data-product-id="${productId}"]`);
                if (productToRemove) {
                    selectedProductsDiv.removeChild(productToRemove);

                    const selectedProductsInput = document.getElementById('selected_products_input');
                    const selectedProducts = JSON.parse(selectedProductsInput.value || '[]');

                    selectedProductsInput.value = JSON.stringify(selectedProducts.filter(item => item.productId != productId));
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const selectedProductsDiv = document.getElementById('selected-products');
                const addProductButton = document.getElementById('add-product');

                addProductButton.addEventListener('click', function() {
                    const productId = document.getElementById('product').value;
                    const product = document.getElementById('product').options[document.getElementById(
                        'product').selectedIndex].text;
                    const quantity = document.getElementById('quantity').value;

                    let productWithPrice = {!! json_encode($products->pluck('price', 'id')) !!}
                    const productPrice = productWithPrice[productId];

                    if (productId && quantity > 0) {
                        const productItem = document.createElement('div');
                        const totalHarga = productPrice * quantity; // Hitung total harga
                        var formattedSubtotal = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(totalHarga);
                        removeProduct(productId)
                        productItem.innerHTML = `
                        ${product.split('-')[0]} - Jumlah: ${quantity} - Total: ${formattedSubtotal.split(',')[0]}
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeProduct(${productId})">X</button>
                    `;
                        productItem.setAttribute('data-product-id', productId);
                        selectedProductsDiv.appendChild(productItem);

                        const selectedProductsInput = document.getElementById('selected_products_input');
                        const selectedProducts = JSON.parse(selectedProductsInput.value || '[]');
                        selectedProducts.push({
                            productId,
                            quantity
                        });
                        selectedProductsInput.value = JSON.stringify(selectedProducts);
                    }
                });
            });
        </script>
    @endpush
@endsection
