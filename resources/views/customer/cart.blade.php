@extends('customer.main')

@section('containers')
    <main id="main">
        <section id="cart" class="portfolio mt-5">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>Keranjang</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    @if ($cartItems->isEmpty())
                        <!-- Pesan ketika keranjang kosong -->
                        <div class="col-md-12">
                            <p>Keranjang Anda kosong. Silakan <a href="{{ route('product.user.index') }}">berbelanja</a>.
                            </p>
                        </div>
                    @else
                        <div class="col-md-8">
                            @foreach ($cartItems as $cartItem)
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <img src="{{ FileHelper::getImage('products/' . $cartItem->product->name . '/' . $cartItem->product->image[0]->image) }}"
                                                class="img-fluid" alt="{{ $cartItem->product->name }}">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="cart-item-details ms-3">
                                                    <a href="{{ route('product.user.show', $cartItem->product->id) }}">
                                                        <h5 class="cart-item-title">{{ $cartItem->product->name }}</h5>
                                                    </a>
                                                    <p class="card-text">
                                                        <strong>Stock:</strong> {{ $cartItem->product->stock }} pcs
                                                        <br>
                                                        {{ GlobalHelper::formatRupiah($cartItem->product->price) }}
                                                    </p>
                                                    <div class="align-items-center">
                                                        <form action="{{ route('user.cart.update', $cartItem->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3 d-flex align-items-center">
                                                                <label for="quantity_{{ $cartItem->id }}"
                                                                    class="me-2">Quantity:</label>
                                                                <div class="input-group quantity-input">
                                                                    <button type="button" class="quantity-button minus"
                                                                        onclick="decreaseQuantity({{ $cartItem->product->id }})">-</button>
                                                                    <input type="number"
                                                                        id="quantity_{{ $cartItem->product->id }}"
                                                                        name="quantity" class="form-control" min="1"
                                                                        value="{{ $cartItem->quantity }}"
                                                                        max="{{ $cartItem->product->stock }}">
                                                                    <button type="button" class="quantity-button plus me-2"
                                                                        onclick="increaseQuantity({{ $cartItem->product->id }}, {{ $cartItem->product->stock }})">+</button>
                                                                    <button type="submit"
                                                                        class="quantity-button plus">&#10003;</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <p class="cart-item-subtotal"><strong>Subtotal:</strong>
                                                        {{ GlobalHelper::formatRupiah($cartItem->product->price * $cartItem->quantity) }}
                                                    </p>
                                                    @if ($cartItem->product->stock < $cartItem->quantity)
                                                        <p>
                                                            <strong class="help-block" style="color:red;">quantity anda
                                                                melebih stock, silahkan perbaiki</strong>
                                                        </p>
                                                    @endif
                                                    <form action="{{ route('user.cart.destroy', $cartItem->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="cart-summary-title">Cart Summary</h5>
                                    <p class="cart-summary-total">Total:
                                        {{ GlobalHelper::formatRupiah($cartSubtotal) }}
                                        <br><small>*Anda dapat menghubungi kami di nomor telepon berikut jika mengalami
                                            kendala:
                                            <strong>0895322021652</strong></small>
                                    </p>
                                    <button type="button" class="btn btn-success" id="openPaymentModal">Checkout</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Lanjutkan Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk memilih dan mengisi detail pembayaran -->
                    <form action="{{ route('user.order.store.from.cart') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment Name:</label>
                            <select class="form-select" id="payment" name="payment" required>
                                <option value="">Select Payment</option>
                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}" @selected(old('payment') == $payment->id)>{{ $payment->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Detail:</label>
                            <textarea required class="form-control" id="address" name="address" rows="2">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="additional_note" class="form-label">Catatan Tambahan:</label>
                            <textarea required class="form-control" id="additional_note" name="additional_note" rows="4">{{ old('additional_note') }}</textarea>
                            @error('additional_note')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <small>*Silahkan Cek Kembali Pesanan Anda</small><br>
                        <button type="submit" class="btn btn-success">Confirm Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                var hasError = {{ $errors->any() ? 'true' : 'false' }};

                if (hasError) {
                    $('#paymentModal').modal('show');
                }

                $('#openPaymentModal').click(function() {
                    var hasTrue = false;
                    @foreach ($cartItems as $cartItem)
                        @if ($cartItem->product->stock < $cartItem->quantity)
                            hasTrue = true;
                        @endif
                    @endforeach
                    if (hasTrue) {
                        $('#paymentModal').modal('hide');
                    } else {
                        $('#paymentModal').modal('show');
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const bankNameSelect = document.getElementById("payment");
                const bankAccountNumber = document.getElementById("no_rek");

                bankNameSelect.addEventListener("change", function() {
                    @foreach ($payments as $payment)
                        if (bankNameSelect.value === "{{ $payment->id }}") {
                            bankAccountNumber.value = "{{ $payment->no_rek }}";
                        }
                    @endforeach
                });
            });
        </script>
        <script>
            function decreaseQuantity(productId) {
                var quantityInput = document.getElementById("quantity_" + productId);
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            }

            function increaseQuantity(productId, stock) {
                var quantityInput = document.getElementById("quantity_" + productId);
                if (!parseInt(quantityInput.value) >= stock) {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                } else if (parseInt(quantityInput.value) >= stock) {
                    quantityInput.value = stock;
                } else {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                }
            }
        </script>
    @endpush
@endsection
