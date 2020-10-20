@extends('app.app')
@section('homeContent')
<script type="text/javascript" src="/js/sale.js"></script>
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center mb-3">Sale | Sale Multiple Product at a time</div>
        <div class="panel-body" ng-app="saleModule" id="saleControllerID"  ng-controller="saleController">
            <div class="row">
                <div class="col-md-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input ng-model="searchKeyword"  id="txtSearchProduct" placeholder="Search Product" class="form-control">
                    </div>
                    <div class="pdz col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-hover col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <tr ng-repeat="item in allproduct  | filter:searchKeyword | limitTo:12">
                                <td style="border:0px solid green;padding:1px;vertical-align: middle;">@{{item.name|limitTo: 12}}@{{item.name.length > 12 ? '...' : ''}} ( @{{item.price }} )</td>
                                <td style="width:33px;border:0px solid green;padding:1px;text-align: right;" >
                                <a href="javascript:void(0);" ng-click="addSaleTemp(item,saleItem);" class="btn btn-primary btn-sm" >></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-8">
                <div id="productList" class="col-md-12 table-responsive text-center">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Plate</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="product in saleItem">
                                <td>@{{product.name}}</td>
                                <td>@{{product.price}}</td>
                                <td><input type="number" class="form-control" min='1' value=" @{{product.plate}}" ng-change="updateSaleTemp(product)" ng-model="product.plate"></td>
                                <td>@{{product.price*product.plate}}</td>
                                <td>  <a href="javascript:void(0)" class="btn btn-sm btn-danger" ng-click="removeSaleTemp(product.id)">X</a> </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <button class="btn btn-sm btn-primary" ng-if="saleItem.length > 0 " ng-click="saleProduct(saleItem)">Sale Product</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection