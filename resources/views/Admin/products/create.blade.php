@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Nhãn Hiệu</h1>
    </div>

   
    <div class="container">

        <div class="row justify-content-center">
    
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-3 d-none d-lg-block"></div>
                            <div class="col-lg-6">
                                <div class="p-7">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Thêm Loại Sản Phẩm</h1>
                                    </div>
                                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
            
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Tên Loại Sản Phẩm">
            
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
            
                                            <select name="category_id" class="form-control" aria-label="Default select example">
                                                <option selected>Open this select menu Category</option>

                                               @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                               @endforeach
                                               
                                              </select>
            
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
            
                                            <select name="brand_id" class="form-control" aria-label="Default select example">
                                                <option selected>Open this select menu Brand</option>

                                               @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                               @endforeach
                                               
                                              </select>
            
                                            @error('brand_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        

                                        <div class="form-group">
                                            
                                            <img src="" alt=" " class="img-product" id="file-preview"/> 

                                            <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"
                                                required autocomplete="name" autofocus id="exampleInputName" accept="image/*"
                                                onchange="showFile(event)">
            
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
            
                                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Mô tả">
            
                                            @error('desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
            
                                            <input type="number" class="form-control form-control-user @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Số Lượng">
            
                                            @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
            
                                            <input type="number" class="form-control form-control-user @error('in_price') is-invalid @enderror" name="in_price" value="{{ old('in_price') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Giá Nhập">
            
                                            @error('in_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
            
                                            <input type="number" class="form-control form-control-user @error('out_price') is-invalid @enderror" name="out_price" value="{{ old('out_price') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Giá Bán">
            
                                            @error('out_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            {{-- <label for="exampleFormControlSelect1">Trạng Thái</label> --}}
                                            <select class="form-control" id="exampleFormControlSelect1" name="status" >
                                                <option selected>Bạn có muốn kích hoạt Lĩnh Vực</option>
                                                <option value="1">Kích Hoạt</option>
                                                <option value="0">Không Kích Hoạt</option>
                                            </select>
                                        </div>
                                        


                                            <hr>

                                        <div class="">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    {{ __('Create Product') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showFile() 
        {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function()
                {
                    var dataURL = reader.result;
                    var output = document.getElementById('file-preview');
                    output.src = dataURL;
                }
            reader.readAsDataURL(input.files([0]));
        }
    </script>
    

@endsection