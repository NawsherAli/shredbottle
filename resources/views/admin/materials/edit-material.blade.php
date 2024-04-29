@extends('admin.layouts.layout')
@section('contents')
<!-- <div class="col-12"> -->
    <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="d-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                <img src='{{asset("assets/images/materials/$material->image")}}' alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 title-responsive">Hello,{{$material->name}} </h2>
                            <p class="text-dark m-b-20">{{$material->name}}</p>
                            <label for="image" class="btn btn-primary">Upload Picture</label>

                        </div>
                    </div>
                </div>
            </div>
    
<!-- </div> -->
    <form method="POST" action="{{route('materials.update',['id' => $material->id])}}"  enctype="multipart/form-data">
        @csrf
         @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name" class="text-primary">Material Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Charity Name" name="name" value="{{$material->name}}">
            </div>
            <!-- <div class="form-group col-md-6">
                <label for="image" class="text-primary">Picture</label>
                <input type="file" class="form-control" id="image" name="image">
            </div> -->
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="short_desc" class="text-primary">Short Descriptions</label>
                <textarea name="short_desc" class="form-control"  id="short_desc">{{$material->short_desc}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="long_desc" class="text-primary">Long Descriptions</label>
                <textarea name="long_desc" class="form-control" id="long_desc">{{$material->long_desc}}</textarea>
                <input type="file" hidden class="form-control" id="image" name="image">
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
                uploadUrl:'{{route('ckeditor.upload.material').'?_token='.csrf_token()}}'
            }

        })
        
        .then( editor => {
            console.log(editor);
        })

        .catch( error => {
            console.error( error );
        });
</script>
<!-- </div> -->
@endsection