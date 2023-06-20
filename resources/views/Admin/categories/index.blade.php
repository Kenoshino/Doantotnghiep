@extends('Admin.home')
@section('admin_content')
    
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Loại Sản Phẩm</h1>
    </div>


    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="card mx-auto">
        
                    <div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif
                    </div>
        
                    <div class="card-header">
        
                        <div class="row">
                            <div class="col">
                                <form method="GET" action="{{route('categories.index')}}" >
                                    <div class="form-row align-itema-center">
                                        <div class="col">
                                            <input type="search" name="search" class="form-control mb-2" id="inlineFormInput">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{route('categories.create')}}" class="btn btn-primary mb-2">Create</a>
                            </div>
                        </div>
        
                      
                    
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Mô Tả</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->desc}}</td>
                                        <td>
                                            <img with="50" height="50" class="" src="{{"/storage/$category->image"}}" alt="">
                                        </td>
                                        <td>
                                            <?php
                                            if($category->status ==0) { ?>
                                                <a href="{{route('active-categories',$category->id)}}"><span class="fa fa-lock"></span></a>
                                            <?php }else{ ?>
                                                <a href="{{route('unactive-categories',$category->id)}}"><span class="fa fa-unlock-alt"></span></a>
                                            <?php } ?>                
                                        </td>
                                        
        
                                        <td>
                                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{route('categories.destroy',$category->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete </button>
                                            </form>
                                        </td>
                                    </tr>
        
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

@endsection