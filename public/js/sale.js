(function(){
    var app = angular.module('saleModule', [ ]);

    app.controller("saleController", [ '$scope', '$http', function($scope, $http) {
        
        console.log("anguler");

        $scope.allproduct=[];
        $http.get('/product/all').success(function(data) {
            $scope.allproduct = data;
        });

        $scope.newsalesaletemp = { };
        
		$scope.saleItem = [ ];
        var saleTempArray=[];

        $scope.addSaleTemp = function(item) {
            //console.log(item,saleTempArray);
            //$scope.saleItem=item;
            var addFlag=1;
            var dataIndex=0;
            for(r in saleTempArray){
                if(saleTempArray[r].id==item.id){
                    addFlag=0;
                    dataIndex=r;
                }
            }

            if(addFlag){
                var itemTemp={};
                itemTemp.id=item.id;
                itemTemp.name=item.name;
                itemTemp.price=item.price;
                itemTemp.plate=1;
                itemTemp.total_price=item.price;
                saleTempArray.push(itemTemp);
            }else{
                saleTempArray[dataIndex].plate=Number(saleTempArray[dataIndex].plate)+1;
                saleTempArray[dataIndex].total_price=Number(saleTempArray[dataIndex].plate)*Number(saleTempArray[dataIndex].price);
            }
            //console.log("Added Buffer","Flag "+addFlag,saleItem);
            $scope.saleItem = saleTempArray;

            setTimeout(function(){ 
                $scope.$apply();
            });
        }

        $scope.updateSaleTemp = function(newsaletemp) {
            var updateFlag=0;
            var dataIndex=null;

            for(r in saleTempArray){
                if(saleTempArray[r].id==newsaletemp.id){
                    //console.log(newsaletemp);
                    updateFlag=1;
                    dataIndex=r;
                    saleTempArray[r].plate=newsaletemp.plate;
                    saleTempArray[r].total_price=Number(saleTempArray[r].plate)*Number(saleTempArray[r].price);
                    break;
                }
            } 

            $scope.saleItem = saleTempArray;

            setTimeout(function(){ 
                $scope.$apply();
            });
        }

        $scope.removeSaleTemp = function(id) {
            var removeFlag=0;
            var dataIndex=null;

            for(r in saleTempArray){
                if(saleTempArray[r].id==id){
                    removeFlag=1;
                    dataIndex=r;
                }
            }

            if(removeFlag){
                saleTempArray.splice(dataIndex,1);
                $scope.saleItem = saleTempArray;
                setTimeout(function(){ 
                    $scope.$apply();
                });
            }  
        }   

        $scope.saleProduct=function(productData){
            console.log(productData);
            if(productData.length==0){
                return 0;
            }
            var zeroQtyCheck=0;

            for (r in productData) { 
                if(productData[r].plate == 0 || productData[r].total_price==0){
                    zeroQtyCheck=1;
                    break;
                }
            } 

            if(zeroQtyCheck){
                alert("Plate can not be zero");
                return 0;
            }

            $http({
                method: 'POST',
                dataType: "JSON",
                url: '/store-sale',
                data: {
                    'product':productData
                    }
            })
            .success(function (result) {
                if(result==1){
                    alert("Product Saled Successfully");
                    $scope.saleItem = [ ];
                    saleTempArray=[];
                }else{
                    alert("Product Sale failed");
                }
                console.log('true',result);
            })
            .error(function(){
                console.log('false');
            });
        }
        
    }]);
})();