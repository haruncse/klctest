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
        $scope.addproduct=function(productData){
            console.log(productData);
            /*setTimeout(function(){ 
                $scope.$apply();
                addproduct(productData);
            });*/
            $http({
                method: 'POST',
                dataType: "JSON",
                url: '/store-product',
                data: {
                    'product':productData
                    }
            })
            .success(function (result) {
                console.log('true',result);
            })
            .error(function(){
                console.log('false');
            });
        }

        $scope.deleteproduct=function(productData){
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

                    }
                })
                .error(function(){
                    console.log('false');
                });
            }
        }

        
        $scope.detailproduct=function(productData){
            $("#productDetail").css("display","block");
            $("#productCreateForm").css("display","none");
            $("#productModifyForm").css("display","none");
                        
            console.log(productData);
            $scope.productDetailData=productData;
        }
        
        $scope.modifyproduct=function(productData){
            console.log(productData);
            $("#productCreateForm").css("display","none");
            $("#productModifyForm").css("display","block");
            $scope.productModifyData=productData;
        }
        
    }]);
})();