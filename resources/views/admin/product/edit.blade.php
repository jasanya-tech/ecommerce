@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                            <li class="breadcrumb-item active">EDit Product</li>
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
                            <form action="{{ route('product.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama Product</label>
                                        <input type="text" class="form-control" value="{{ old('name', $product->name) }}"
                                            id="name" name="name" placeholder="Masukan Name">
                                        @error('name')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stock Product</label>
                                        <input type="number" class="form-control" min="0"
                                            value="{{ old('stock', $product->stock) }}" id="stock" name="stock"
                                            placeholder="Masukan Stock">
                                        @error('stock')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Harga Product</label>
                                        <input type="number" class="form-control" min="0"
                                            value="{{ old('price', $product->price) }}" id="price" name="price"
                                            placeholder="Masukan price">
                                        @error('price')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Product</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('thumbnail', $product->thumbnail) }}" id="thumbnail"
                                            name="thumbnail" placeholder="Masukan thumbnail">
                                        @error('thumbnail')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select id="category" name="category_id" class="form-control select2">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (old('category_id', $product->category_id) == $category->id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
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
                                                    <span class="fw-semibold fs-4 text-muted">Upload up to 10 files</span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('image*')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="existing-images" style="display: none">
                                        @foreach ($product->image as $image)
                                            {{-- <div class="dz-preview dz-processing dz-image-preview"> --}}
                                            <img src="{{ FileHelper::getImage("products/$product->name/$image->image") }}"
                                                alt="image" />
                                            {{-- </div> --}}
                                        @endforeach
                                    </div>
                                    <input type="file" hidden id="file_input" name="image[]" multiple />
                                </div>

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
            Dropzone.autoDiscover = false;

            function generateRandomString(length) {
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let result = '';
                for (let i = 0; i < length; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    result += characters.charAt(randomIndex);
                }
                return result;
            }

            let imageDetails = [];
            let existingImages = document.querySelectorAll(".existing-images img");
            let existingImagesArray = Array.from(existingImages);

            function fetchImageDetails(image) {
                return new Promise((resolve, reject) => {
                    const url = new URL(image.src);
                    const pathname = url.pathname;
                    fetch(pathname)
                        .then(response => response.blob())
                        .then(blob => {
                            let details = {
                                name: generateRandomString(20),
                                type: blob.type,
                                size: blob.size,
                                url: image.src,
                                blobImage: blob
                            };
                            imageDetails.push(details);
                            resolve();
                        })
                        .catch(error => {
                            console.error(error);
                            reject();
                        });
                });
            }

            let fetchPromises = existingImagesArray.map(fetchImageDetails);
            Promise.all(fetchPromises)
                .then(() => {
                    let dataTransfer = new DataTransfer();
                    new Dropzone("#kt_dropzonejs_example_1", {
                        paramName: "file",
                        maxFilesize: 2,
                        maxFiles: 10,
                        acceptedFiles: "image/*",
                        addRemoveLinks: true,
                        dictRemoveFile: "Hapus",
                        url: "your-upload-url",
                        init: function() {
                            @if (!$errors->any())
                                var dropzone = this;
                                imageDetails.forEach(function(image) {
                                    console.log(image.blobImage)
                                    const mimeType = image.type;
                                    const parts = mimeType.split("/");
                                    let newFile = new File([image.blobImage], image.name + '.' + parts[
                                        1], {
                                        accepted: true,
                                        processing: true,
                                        type: image.type,
                                        size: image.size,
                                        dataURL: image.url
                                    });
                                    dataTransfer.items.add(newFile);
                                    document.getElementById('file_input').files = dataTransfer.files;

                                    dropzone.emit("addedfile", newFile);
                                    dropzone.emit("thumbnail", newFile, image.url);
                                });
                            @endif
                            this.on("addedfile", function(file) {
                                var input = document.getElementById('file_input');
                                dataTransfer.items.add(file);
                                input.files = dataTransfer.files;
                                console.log(input.files)
                            });

                            this.on("removedfile", function(file) {
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
                                        dataTransfer = newFileList;
                                        console.log(input.files)
                                    }
                                }
                            });
                        },
                    });
                })
                .catch(err => {
                    console.error('Ada kesalahan saat mengambil detail gambar:', err);
                });
        </script>
    @endpush
@endsection
