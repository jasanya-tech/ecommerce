@extends('customer.main')

@section('containers')
    <main id="main">
        <section id="cart" class="portfolio mt-5">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>Checkout</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <img src="{{ FileHelper::getImage('products/' . $product->name . '/' . $product->image[0]->image) }}"
                                        class="img-fluid" alt="{{ $product->name }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="cart-item-details ms-3">
                                            <a href="{{ route('product.user.show', $product->id) }}">
                                                <h5 class="cart-item-title">{{ $product->name }}</h5>
                                            </a>
                                            <p class="card-text">
                                                <strong>Stock:</strong> {{ $product->stock }} pcs
                                                <br>
                                                {{ GlobalHelper::formatRupiah($product->price) }}
                                            </p>
                                            <div class="d-flex align-items-center">
                                                <div class="mb-3 d-flex align-items-center">
                                                    <label for="quantity" class="me-2">Quantity:</label>
                                                    <div class="input-group quantity-input">
                                                        <button type="button" class="quantity-button minus"
                                                            onclick="decreaseQuantity()">-</button>
                                                        <input type="number" id="quantity" class="form-control"
                                                            min="1" value="1" max="{{ $product->stock }}">
                                                        <button type="button" class="quantity-button plus"
                                                            onclick="increaseQuantity({{ $product->stock }})">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="cart-summary-title">Cart Summary</h5>
                                <p class="cart-summary-total" id="subtotal">Total:
                                    {{ GlobalHelper::formatRupiah($product->price) }}
                                </p>
                                <small>*Anda dapat menghubungi kami di nomor telepon berikut jika mengalami kendala:
                                    <strong>0895322021652</strong></small> <br> <br>
                                <button type="button" class="btn btn-success" id="openPaymentModal">Checkout</button>
                            </div>
                        </div>
                    </div>
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
                    <form action="{{ route('user.order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-3">
                            <label for="quantity_modal" class="form-label">Quantity:</label>
                            <input type="text" class="form-control" id="quantity_modal" name="quantity"
                                value="{{ old('quantity') }}" required readonly>
                            @error('quantity')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
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
                        <button type="submit" class="btn btn-success">Confirm Order</button>
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
                    var quantityInput = document.getElementById("quantity");
                    quantityInput.value = "{{ old('quantity') }}"
                    updateSubtotal(quantityInput);
                }

                $('#openPaymentModal').click(function() {
                    $('#paymentModal').modal('show');
                    var quantityInput = document.getElementById("quantity");
                    setModalQuantity({{ $product->stock }});
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
            const quantityInput = document.getElementById("quantity");
            quantityInput.addEventListener("change", function() {
                fixQuantity();
                updateSubtotal(quantityInput);
            });

            function updateSubtotal(quantityInput) {
                var price = {{ $product->price }};
                var subtotal = price * quantityInput.value;
                var subtotalElement = document.getElementById("subtotal");
                var formattedSubtotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(subtotal);
                subtotalElement.textContent = "Total: " + formattedSubtotal.split(',')[0];
            }

            function decreaseQuantity(productId) {
                var quantityInput = document.getElementById("quantity");
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
                updateSubtotal(quantityInput);
            }

            function increaseQuantity(stock) {
                var quantityInput = document.getElementById("quantity");
                if (!parseInt(quantityInput.value) >= stock) {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                } else if (parseInt(quantityInput.value) >= stock) {
                    quantityInput.value = stock;
                } else {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                }
                updateSubtotal(quantityInput);
            }

            function setModalQuantity(stock) {
                var quantityInput = document.getElementById("quantity");
                const quantityInputModal = document.getElementById("quantity_modal");
                if (!parseInt(quantityInput.value) >= stock) {
                    quantityInputModal.value = quantityInput.value;
                } else if (parseInt(quantityInput.value) >= stock) {
                    quantityInputModal.value = stock;
                    quantityInput.value = stock;
                } else if (quantityInput.value < 1) {
                    quantityInputModal.value = 1;
                    quantityInput.value = 1;
                } else {
                    quantityInputModal.value = quantityInput.value;
                }
                updateSubtotal(quantityInput);
            }

            function fixQuantity() {
                const quantity = parseInt(quantityInput.value);
                if (quantity < 1) {
                    quantityInput.value = 1;
                } else if (quantity > {{ $product->stock }}) {
                    quantityInput.value = {{ $product->stock }};
                }
            }
        </script>
    @endpush
@endsection
