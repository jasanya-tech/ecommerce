@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Membuat Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                            <li class="breadcrumb-item active">Membuat Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('message'))
                            <div class="mb-5 alert alert-{{ session('status') }} alert-dismissible">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="btn btn-sm btn-dark">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card card-primary">
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama Product</label>
                                        <input type="text" class="form-control" value="{{ old('name') }}"
                                            id="name" name="name" placeholder="Masukan Name">
                                        @error('name')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stock Product</label>
                                        <input type="number" class="form-control" min="0"
                                            value="{{ old('stock') }}" id="stock" name="stock"
                                            placeholder="Masukan Stock">
                                        @error('stock')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Harga Product</label>
                                        <input type="number" class="form-control" min="0"
                                            value="{{ old('price') }}" id="price" name="price"
                                            placeholder="Masukan price">
                                        @error('price')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Product</label>
                                        <input type="text" class="form-control" value="{{ old('thumbnail') }}"
                                            id="thumbnail" name="thumbnail" placeholder="Masukan thumbnail">
                                        @error('thumbnail')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Image</label>
                                        <div class="dropzone" id="kt_dropzonejs_example_1">
                                            <div class="dz-message needsclick">
                                                <div class="ms-4">
                                                    <h3 class="required dfs-3 fw-bold text-gray-900 mb-1">Drop files here or
                                                        click to upload image product</h3>
                                                    <span class="fw-semibold fs-4 text-muted">Upload up to 10
                                                        files</span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('image*')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="file" hidden id="file_input" name="image[]" multiple />
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'), {})
                .catch(error => {
                    console.error(error);
                });
        </script>

        <script>
            let dataTransfer = new DataTransfer();
            Dropzone.autoDiscover = false;
            new Dropzone("#kt_dropzonejs_example_1", {
                paramName: "file",
                maxFilesize: 2,
                maxFiles: 10,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictRemoveFile: "Hapus",
                url: "your-upload-url",
                init: function() {
                    this.on("addedfile", function(file) {
                        console.log("File added: " + file.name);

                        var input = document.getElementById('file_input');

                        dataTransfer.items.add(file);

                        input.files = dataTransfer.files;
                        console.log(input.files)
                    });

                    this.on("removedfile", function(file) {
                        console.log("File removed: " + file.name);

                        var input = document.getElementById('file_input');
                        var files = input.files;
                        if (files) {
                            var index = Array.prototype.indexOf.call(files, file);
                            if (index !== -1) {
                                var newFileList = new DataTransfer();
                                for (var i = 0; i < files.length; i++) {
                                    if (i !== index) {
                                        newFileList.items.add(files[i]);
                                    }
                                }
                                input.files = newFileList.files;
                            }
                        }
                    });
                },
            });
        </script>
    @endpush
@endsection
