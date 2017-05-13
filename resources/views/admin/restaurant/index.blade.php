@extends('layouts.app')
@section('content')
    <section class="content" ng-controller="RestaurantController">
        <div class="ui segments">
            <div class="ui segment">
                <a href="{{ route('restaurant.create') }}" class="ui small green labeled icon button"><i class="plus icon"></i> Create</a>
                <a data-ng-show="selected" ng-href="@{{ edit_url }}" class="ui small primary labeled icon button"><i class="write icon"></i> Edit</a>
                <a data-ng-show="selected" ng-href="@{{ delete_url }}" class="ui small red labeled icon button"><i class="minus icon"></i> Delete</a>
            </div>
            <div class="ui black segment">
                <table class="ui compact celled definition table">
                    <thead class="full-width">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                        </tr>
                    </thead>
                    <tbody ng-cloak>
                        <tr ng-repeat="restaurant in restaurants track by $index" ng-click="setSelected();" ng-class="{'bg-info lt': restaurant.id === selected.id}">
                            <td>@{{ restaurant.name }}</td>
                            <td>@{{ restaurant.category.name }}</td>
                            <td>@{{ restaurant.longitude }}</td>
                            <td>@{{ restaurant.latitude }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        app.controller('RestaurantController', ['$scope', '$http', function ($scope, $http) {
            $scope.moduleUrl = "{{ route('restaurant.index') }}";

            $scope.setSelected = function() {
                if($scope.selected && $scope.selected.id == this.restaurant.id) {
                    $scope.selected = null;
                } else {
                    $scope.selected = this.restaurant;
                    $scope.edit_url = $scope.moduleUrl + '/' + $scope.selected.id + '/edit';
                    $scope.delete_url = $scope.moduleUrl + '/' + $scope.selected.id + '/delete';
                    $scope.show_url = $scope.moduleUrl + '/' + $scope.selected.id;
                }
            };

            $http.get($scope.moduleUrl + '?ajax=true').then(function (response) {
                $scope.restaurants = response.data;
                console.log(response);
            });

        }]);
    </script>
@endsection

