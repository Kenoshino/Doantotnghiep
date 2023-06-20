@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Loại Sản Phẩm</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Loại Sản Phẩm
                        <a href="{{route('products.index')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
    
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$product->name) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="products">
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>

                        <div class="form-group">
                                            
                            <img with="50" height="50" src="{{"/storage/$product->image"}}" alt="">
                            <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" name="image"
                                required autocomplete="name" autofocus id="exampleInputName"
                                onchange="preview_image(event,'output_image')">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">

                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc',$product->desc) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Mô tả">

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" name="status" value="{{$product->status}}"/>

                        <hr>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Update products') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type='text/javascript'>
        function preview_image(event,$id) 
        {
         var reader = new FileReader();
         reader.onload = function()
         {
          var output = document.getElementById($id);
          output.src = reader.result;
         }
         reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    

@endsection