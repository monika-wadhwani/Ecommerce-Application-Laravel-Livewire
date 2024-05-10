@extends('layouts.admin')

@section('title', 'Setting')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h4 class="alert alert-success">{{session('message')}}</h4>
            @endif
            <form action="{{ url('admin/save_setting') }}" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Website Name</label>
                                <input type="text" name="website_name" value="{{$settings->website_name ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Website URL</label>
                                <input type="text" name="website_url"value="{{$settings->website_url ?? ''}}"  class="form-control form-group">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Page Title</label>
                                <input type="text" name="title" value="{{$settings->title ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control form-group" rows="3">{{$settings->meta_keyword ?? ''}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Meta Description</label>
                                <textarea name="meta_description" class="form-control form-group" rows="3">{{$settings->meta_description ?? ''}}</textarea>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website Information
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Address</label>
                                <textarea name="address" class="form-control form-group">{{$settings->address ?? ''}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Phone 1 *</label>
                                <input type="text" name="phone1" value="{{$settings->phone1 ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Phone No. 2</label>
                                <input type="text" name="phone2" value="{{$settings->phone2 ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Email 1 *</label>
                                <input type="email" name="email1" value="{{$settings->email1 ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Email 2</label>
                                <input type="email" name="email2" value="{{$settings->email2 ?? ''}}" class="form-control form-group">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website - Social Media
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Facebook (Optional)</label>
                                <input type="text" name="facebook" value="{{$settings->facebook ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Twitter (Optional)</label>
                                <input type="text" name="twitter" value="{{$settings->twitter ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Instagram (Optional)</label>
                                <input type="text" name="instagram" value="{{$settings->instagram ?? ''}}" class="form-control form-group">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Youtube (Optional)</label>
                                <input type="email" name="youtube" value="{{$settings->youtube ?? ''}}" class="form-control form-group">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <button type="submit" class="btn btn-primary text-white">
                        Save Setting
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
