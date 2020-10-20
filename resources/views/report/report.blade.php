@extends('app.app')
@section('homeContent')
<script type="text/javascript" src="/js/report.js"></script>

<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center mb-3">Report | Retrive Selling information</div>
        <div class="panel-body" ng-app="reportModule" id="reportControllerID"  ng-controller="reportController">
            <div class="col-md-12">
                <div class="col-md-12 form-inline d-flex justify-content-center bd-highlight mb-3">
                    {{--<label class="sr-only" for="inlineFormInputName2">Pasta Name</label>
                    <input type="text" ng-model="inputData.name" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Pasta Name">

                    <label class="sr-only" for="inlineFormInputGroupUsername2">Date</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Date</div>
                        </div>
                        <input type="datetime-local" ng-model="inputData.date" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Date">
                    </div>--}}
                    <button ng-click="getSelReport(inputData)" class="btn btn-primary mb-2"> Get Report</button>
                </div>
                <div id="report" class="col-md-12 table-responsive">

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-right">Number of Plates</th>
                                <th scope="col" class="text-right">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="report in reportItem">
                                <td>@{{report.name}}</td>
                                <td class="text-right">@{{report.number_of_plates}}</td>
                                <td class="text-right">@{{report.total_price}}</td>
                            </tr>
                            <tr ng-if="reportItem.length > 0 ">
                                <th>Total</th>
                                <th class="text-right">@{{sumTotalQty(reportItem)}}</th>
                                <th class="text-right">@{{sumTotalPrice(reportItem)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection