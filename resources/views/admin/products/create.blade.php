@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h5 class="alert alert-success">
                    {{ session('message') }}
                </h5>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2>Add Product
                        <a href="{{ url('admin/products') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                    </h2>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('admin/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotags-tab" data-bs-toggle="tab" data-bs-target="#seotags"
                                    type="button" role="tab" aria-controls="seotags" aria-selected="false">
                                    Seo Tags
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                    type="button" role="tab" aria-controls="details" aria-selected="false">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images"
                                    type="button" role="tab" aria-controls="images" aria-selected="false">
                                    Product Image
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color"
                                    type="button" role="tab" aria-controls="color" aria-selected="false">
                                    Product Color
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane border fade show active mt-3 p-3" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3">
                                    <label class="mb-2">Select Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="0" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Product Name</label>
                                    <input type="text" name="name" class="form-control form-group">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Product Slug</label>
                                    <input type="text" name="slug" class="form-control form-group">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Select Brand</label>
                                    <select name="brand" class="form-control">
                                        <option value="0" disabled selected>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Small Description</label>
                                    <textarea name="small_description" class="form-control form-group" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Long Description</label>
                                    <textarea name="long_description" class="form-control form-group" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane border fade mt-3 p-3" id="seotags" role="tabpanel"
                                aria-labelledby="seotags-tab">
                                <div class="mb-3">
                                    <label class="mb-2">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control form-group">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control form-group" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Meta Description</label>
                                    <textarea name="meta_description" class="form-control form-group" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane border fade mt-3 p-3" id="details" role="tabpanel"
                                aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2">Status</label>
                                        <input type="checkbox" name="status" style="width:20px; height:20px">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2">Trending</label>
                                        <input type="checkbox" name="trending" style="width:20px; height:20px">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2">Featured</label>
                                        <input type="checkbox" name="featured" style="width:20px; height:20px">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2">Original Price</label>
                                        <input type="number" name="original_price" class="form-control form-group">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2">Selling Price</label>
                                        <input type="number" name="selling_price" class="form-control form-group">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2">Quantity</label>
                                        <input type="number" name="quantity" class="form-control form-group">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane border fade mt-3 p-3" id="images" role="tabpanel"
                                aria-labelledby="images-tab">
                                <div class="mb-3">
                                    <label class="mb-2">Upload Product Images</label>
                                    <input type="file" multiple name="images[]" class="form-control form-group">
                                </div>
                            </div>
                            <div class="tab-pane border fade mt-3 p-3" id="color" role="tabpanel"
                                aria-labelledby="color-tab">
                                <div class="mb-3">
                                    <label class="mb-2">Select Color :-</label>

                                    <div class="row ">
                                        @forelse ($colors as $color)
                                            <div class="col-md-6 border p-2">
                                                Color:- <input type="checkbox" name="colors[{{ $color->id }}]" value={{ $color->id }}>
                                                {{ $color->name }}
                                            </div>
                                            <div class="col-md-6 border p-2">
                                                Quantity: <input type="number" name="colorquantity[{{ $color->id }}]"
                                                    style="border: 1px solid; width:250px">
                                            </div>

                                        @empty
                                            <div class="col-md-12">No Colors Available</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
