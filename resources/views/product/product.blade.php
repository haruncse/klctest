@extends('app.app')
@section('homeContent')
<script type="text/javascript" src="/js/product.js"></script>
<script>
    $(document).ready(function() {
        $("#productCreateForm").css("display","none");
        $("#productModifyForm").css("display","none");   
    }); 

    function showProductForm(){
        $("#productCreateForm").css("display","block");
        $("#productModifyForm").css("display","none");
    }

    function addProduct(){
        var product="Data"; 

        console.log(product);
        //return 0;
        $.ajax({
            dataType:'json',
            type:'POST',
            url:'/product',  
            data:{
            'name':"name",
            'price':"2150"
            },
            success:function(result){     
            console.log(result);
            if(result!=null){
            
            }
            },
            error: function( req, status, err ) {
            console.log( 'wrong->', status, err );
            alert(err);
            }
        });
    }

</script>

<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Product | Create | Update | Delete</div>
        <div class="panel-body" ng-app="productModule" id="productControllerID"  ng-controller="productController">
            <div class="col-md-12">
                <div class="col-md-12 mb-2">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="showProductForm();">Create New</a>
                </div>
            
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{--<form class="col-md-12" id="productCreateForm" method="POST" action="/product">--}}
                    <div class="col-md-12" id="productCreateForm">
                    @csrf
                    <div class="form-group row">
                        <label for="productName" class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="productName"  value="@{{productNewData.name}}" ng-model="productNewData.name" required placeholder="Product name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="productPrice" class="col-sm-2 col-form-label">Price *</label>
                        <div class="col-sm-10">
                        <input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" name="price" id="productPrice" value="@{{productNewData.price}}" ng-model="productNewData.price" required placeholder="Product Price">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10 ">
                        <button {{--type="submit"--}} {{--onclick="addProduct();"--}} ng-click="addProduct(productNewData);" class="btn btn-primary" >Create Product</button>
                        </div>
                    </div>
                    </div>
                {{--</form>--}}


                {{--<form class="col-md-12" id="productModifyForm" method="POST" action="/modify-product">--}}
                    <div class="col-md-12" id="productModifyForm">
                    @csrf
                    <input type="hidden" name="id" ng-model="productModifyData.id" value="@{{productModifyData.id}}">
                    
                    <div class="form-group row">
                        <label for="productName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="productNameM" value="@{{productModifyData.name}}" ng-model="productModifyData.name" required placeholder="Product name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="productPrice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                        <input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" name="price" id="productPriceM" value="@{{productModifyData.price}}" ng-model="productModifyData.price" required placeholder="Product Price">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10 ">
                        <button {{--type="submit"--}} ng-click="modifyProductByID(productModifyData);" class="btn btn-primary" >Modify Product</button>
                        </div>
                    </div>
                    </div>
                {{--</form>--}}

                <div id="productList" class="col-md-12 table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-right">Price</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="product in allproduct">
                                <td>@{{product.name}}</td>
                                <td class="text-right">@{{product.price}}</td>
                                <td class="text-center"> <a href="javascript:void(0)" ng-click="modifyproduct(product)">Edit</a>   | <a href="javascript:void(0)" ng-click="deleteproduct(product)">Delete</a> </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection