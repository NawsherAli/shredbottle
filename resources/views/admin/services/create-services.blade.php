@extends('admin.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-8">
        <h1 class="title-responsive">Add Service</h1>
    </div>
    
</div>
<!-- <div class="row"> -->
    <form method="POST" action="{{route('services.store')}}"  enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name" class="text-primary">Service Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Service Name" name="name">
            </div>
            <div class="form-group col-md-6">
                <label for="image" class="text-primary">Picture</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="short_desc" class="text-primary">Short Descriptions</label>
                <!-- <input type="text" class="form-control" id="short_desc" placeholder=" " name="short_desc"> -->
                <textarea name="short_desc" class="form-control"  id="short_desc"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="long_desc" class="text-primary">Long Descriptions</label>
                <!-- <input type="text" class="form-control" id="long_desc" placeholder="" name="long_desc"> -->
                <textarea name="long_desc" class="form-control" id="long_desc"></textarea>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<!-- </div> -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#long_desc' ),{
            ckfinder:{
                uploadUrl:'{{route('ckeditor.upload.service').'?_token='.csrf_token()}}'
            }

        })
        
        .then( editor => {
            console.log(editor);
        })

        .catch( error => {
            console.error( error );
        });
</script>
@endsection
