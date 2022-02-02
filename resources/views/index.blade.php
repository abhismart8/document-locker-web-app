@extends('layouts.main')

@push('css')
<style>
    .upload-file {
        float: right;
    }
</style>
@endpush

@section('content')
<div class="row" style="background: aliceblue;">
    <div class="col-sm-12">
        <a href="/logout" class="btn btn-danger btn-sm mt-15 mb-15" style="float: right;"> Logout </a>
    </div>
</div>
<div class="row" style="background: #cfd1d3;">
    <div class="col-sm-3 mt-15">
        <div class="row">
            <div class="col-sm-6">
                <h5> Files </h5>
            </div>
            <div class="col-sm-6">
                <input type="file" class="hide file" id="file" />
                <a href="{{route('upload-files')}}" style="color: gray; text-decoration: none;" class="upload-file"> Upload <i class="fa fa-upload" aria-hidden="true"></i> </a>
            </div>
        </div>
    </div>
    <div class="col-sm-9" style="background: blue;" id="show-file-name">
        <h4 class="mt-2" style="color: white;">
            @if($uploads->count())
            {{($uploads[0]->name)}}
            @endif
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 column scrolldown" style="padding-right: 0px; padding-left: 0px;">
        @if($uploads->count())
        @foreach($uploads as $upload)
        <div class="row mt-2 @if($loop->iteration === 1) active @endif" style="border: grey solid 1px; padding: 20px 20px;">
            <a href="{{asset($upload->path)}}" class="view-file" style="text-decoration: none;">
                <div class="col-sm-12">
                    <h5> {{$upload->name}} </h5>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
    <div class="col-sm-9" style="padding-left: 0px;">
        @if($uploads->count())
        <iframe src="{{asset($uploads[0]->path)}}" frameborder="0" scrolling="no" id="file_iframe" width="100%" height="540px"></iframe>
        @else
        <h5 class="mt-30 text-center"> No files uploaded yet.</h5>
        @endif
    </div>
</div>
@endsection

@push('post-scripts')
<script src="{{ asset('js/index.js') }}"></script>
@endpush