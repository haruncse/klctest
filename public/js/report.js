(function(){
    var app = angular.module('reportModule', [ ]);

    app.controller("reportController", [ '$scope', '$http', function($scope, $http) {
        
        console.log("anguler");

        $scope.newsalesaletemp = { };
        
		$scope.reportItem = [ ];
        $scope.inputData = [ ];        

        $scope.getSelReport=function(inputData){
            console.log(inputData);

            $http({
                method: 'POST',
                dataType: "JSON",
                url: '/get-report',
                data: {
                    'inputData':inputData
                    }
            })
            .success(function (result) {
                $scope.reportItem =result;
                console.log('true',result);
            })
            .error(function(){
                console.log('false');
            });
        }

        
        $scope.sumTotalPrice = function(list) {
            var total=0;
            angular.forEach(list , function(item){
                total+= parseFloat(item.total_price);
            });
            return total;
        }
        
        $scope.sumTotalQty = function(list) {
            var total=0;
            angular.forEach(list , function(item){
                total+= parseFloat(item.number_of_plates);
            });
            return total;
		}

    }]);
})();