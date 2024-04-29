@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Add Category
                        <a href="{{ url('admin/category') }}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Name</label>
                                <input type="text" name="category_name" class="form-control form-group">
                                @error('category_name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Slug</label>
                                <input type="text" name="slug" class="form-control form-group">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Description</label>
                                <textarea name="description" class="form-control form-group"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Image</label>
                                <input type="file" name="images" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Status</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="col-md-12 mb-3">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control form-group">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control form-group"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Meta Description</label>
                                <textarea name="meta_description" class="form-control form-group"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary text-white">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
