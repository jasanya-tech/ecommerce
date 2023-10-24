@extends('customer.main')

@section('containers')
    <main id="main">
        <section id="profile" class="portfolio mt-5">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>User Profile</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User Information</h5>
                                <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('name', auth()->user()->name) }}" id="name" name="name">
                                        @error('name')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control"
                                            value="{{ old('email', auth()->user()->email) }}" id="email" name="email">
                                        @error('email')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Nomor Handphone:</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('phone_number', auth()->user()->phone_number) }}"
                                            id="phone_number" name="phone_number">
                                        @error('phone_number')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" id="openChangePasswordModal">Change
                                            Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Profile Picture</h5>
                                <!-- Tampilkan gambar profil pengguna -->
                                <img src="{{ FileHelper::getImage('users/' . auth()->user()->image) }}" alt="User Image"
                                    class="img-fluid">
                                <button type="button" class="btn btn-primary" id="openImageModal">Edit
                                    Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="updateImageModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateImageModalLabel">Update Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk memperbarui gambar profil -->
                    <form action="{{ route('profile.update.image', auth()->user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload New Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengganti kata sandi -->
                    <form action="{{ route('profile.update.password', auth()->user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password:</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            @error('old_password')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                            @error('password_confirmation')
                                <span class="help-block" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Periksa jika ada pesan kesalahan yang berkaitan dengan input 'old_password' atau 'password'
                var hasError = {{ $errors->has('image') ? 'true' : 'false' }};

                if (hasError) {
                    // Jika ada pesan kesalahan, aktifkan modal saat halaman dimuat
                    $('#updateImageModal').modal('show');
                }

                // Atur penanganan klik untuk membuka modal dengan tombol
                $('#openImageModal').click(function() {
                    $('#updateImageModal').modal('show');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Periksa jika ada pesan kesalahan yang berkaitan dengan input 'old_password' atau 'password'
                var hasError = {{ $errors->has('old_password') || $errors->has('password') ? 'true' : 'false' }};

                if (hasError) {
                    // Jika ada pesan kesalahan, aktifkan modal saat halaman dimuat
                    $('#changePasswordModal').modal('show');
                }

                // Atur penanganan klik untuk membuka modal dengan tombol
                $('#openChangePasswordModal').click(function() {
                    $('#changePasswordModal').modal('show');
                });
            });
        </script>
    @endpush
@endsection
