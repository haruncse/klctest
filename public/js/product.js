(function(){
    var app = angular.module('productModule', [ ]);

    //console.log("anguler");

    app.controller("productController", [ '$scope', '$http', function($scope, $http) {
        
        console.log("anguler");

        $scope.items = [ ];
        $scope.allproduct=[];
        $http.get('/product/all').success(function(data) {
            $scope.allproduct = data;
            //console.log(data);
        });

		
		$scope.saletemp = [ ];
        $scope.newsalesaletemp = { };
        var saleItem=[];
        var totalSaleAmount=0;

        $scope.productNewData=[];
        $scope.productDetailData=[];
        $scope.productModifyData=[];

        $scope.addProduct=function(productData){
            console.log(productData);

            $http({
                method: 'POST',
                dataType: "JSON",
                url: '/product',
                data: {
                    'price':productData.price,
                    'name':productData.name
                    }
            })
            .success(function (result) {
                console.log(result);
                $("#productCreateForm").css("display","none");
                alert("Product added successfully");
                $scope.allproduct = result;
                $scope.productNewData=[];
            })
            .error(function(error){
                console.log(error,'false');
                var errorMessage=error.message;
                var errorList="";
                for (var key in error.errors) {
                    //console.log("Key: " + key);
                    //console.log("Value: " + error.errors[key]);
                    errorList+="\n"+error.errors[key];
                }
                alert(errorMessage+errorList);
            });
        }

        $scope.deleteproduct=function(productData){
            $("#productCreateForm").css("display","none");
            $("#productModifyForm").css("display","none");
            if(confirm("Do you want to delete "+productData.name)){
                $http({
                    method: 'GET',
                    dataType: "JSON",
                    url: "/delete-product/"+productData.id,
                    data: {
                        'product':productData
                        }
                })
                .success(function (result) {
                    console.log('true',result);
                    if(result!="false"){
                        $("#productCreateForm").css("display","none");
                        $("#productModifyForm").css("display","none");
                        $("#productDetail").css("display","none");
                        $scope.allproduct = result;
                    }else{
                        alert("Product delete failed");
                    }
                })
                .error(function(error){
                    console.log(error,'false');
                    var errorMessage=error.message;
                    var errorList="";
                    for (var key in error.errors) {
                        errorList+="\n"+error.errors[key];
                    }
                    alert(errorMessage+errorList);
                });
            }
        }


        $scope.modifyproduct=function(productData){
            console.log(productData);
            $("#productCreateForm").css("display","none");
            $("#productModifyForm").css("display","block");
            $scope.productModifyData=productData;
        }

        $scope.modifyProductByID=function(productData){
            $scope.productModifyData=productData;

            $http({
                method: 'POST',
                dataType: "JSON",
                url: '/modify-product',
                data: {
                    'id':productData.id,
                    'price':productData.price,
                    'name':productData.name
                    }
            })
            .success(function (result) {
                console.log(result);
                $("#productModifyForm").css("display","none");
                alert("Product modified successfully");
                $scope.allproduct = result;
                $scope.productModifyData=[];
            })
            .error(function(error){
                console.log(error,'false');
                var errorMessage=error.message;
                var errorList="";
                for (var key in error.errors) {
                    errorList+="\n"+error.errors[key];
                }
                alert(errorMessage+errorList);
            });
        }
        
    }]);
})();