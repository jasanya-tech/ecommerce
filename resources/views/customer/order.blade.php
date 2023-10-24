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
                                                    <label for="quantity_{{ $product->id }}"
                                                        class="me-2">Quantity:</label>
                                                    <div class="input-group quantity-input">
                                                        <button type="button" class="quantity-button minus"
                                                            onclick="decreaseQuantity({{ $product->id }})">-</button>
                                                        <input type="number" id="quantity_{{ $product->id }}"
                                                            name="quantity" class="form-control" min="1"
                                                            value="1" max="{{ $product->stock }}">
                                                        <button type="button" class="quantity-button plus"
                                                            onclick="increaseQuantity({{ $product->id }}, {{ $product->stock }})">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="cart-item-subtotal"><strong>Subtotal:</strong>
                                                123
                                            </p>
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
                                <p class="cart-summary-total">Total:
                                    123
                                    <br><small>*Jika anda membutuhkan bantuan, silahkan hubungi admin kami
                                        <strong>08819238999</strong></small>
                                </p>
                                <button type="button" class="btn btn-success cart-checkout-button" data-bs-toggle="modal"
                                    data-bs-target="#paymentModal"
                                    onclick="setModalQuantity({{ $product->id }}, {{ $product->stock }})">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
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
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="payment_name" class="form-label">Bank Name:</label>
                            <select class="form-select" id="payment_name" name="payment_name" required>
                                <option value="bca">BCA</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="other">Other Bank</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="no_rek" class="form-label">Nomor Rekening:</label>
                            <input type="text" class="form-control" id="no_rek" name="no_rek" readonly required>
                            <small>*Silahkan Transfer Ke Nomor Rekening di atas dan upload bukti pembayaran</small>
                        </div>
                        <div class="mb-3">
                            <label for="payment_proof" class="form-label">Upload Bukti Pembayaran:</label>
                            <input type="file" class="form-control" id="payment_proof" required name="payment_proof">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Detail:</label>
                            <textarea class="form-control" id="address" name="address" required rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="additional_note" class="form-label">Catatan Tambahan:</label>
                            <textarea class="form-control" id="additional_note" name="additional_note" required rows="4"></textarea>
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
            document.addEventListener("DOMContentLoaded", function() {
                const bankDetailsContainer = document.getElementById("bankDetailsContainer");
                const bankNameSelect = document.getElementById("payment_name");
                const bankAccountNumber = document.getElementById("no_rek");
                bankAccountNumber.value = "no rek bca";

                bankNameSelect.addEventListener("change", function() {
                    if (bankNameSelect.value === "bca") {
                        bankAccountNumber.value = "no rek bca";
                    } else if (bankNameSelect.value === "mandiri") {
                        bankAccountNumber.value = "no rek mandiri";
                    }
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

            function setModalQuantity(productId, stock) {
                var quantityInput = document.getElementById("quantity_" + productId);
                const quantityInputModal = document.getElementById("quantity");
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
            }
        </script>
    @endpush
@endsection
