<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
  
<head>  
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.1/angular.min.js"></script>  
    <script type="text/javascript" src="https://cdn.jsdelivr.net/ngstorage/0.3.6/ngStorage.min.js"></script>  
    <script type="text/javascript">  
        var app = angular.module('loginFormApp', ["ngStorage"])  
        app.controller('ExampleController', function($scope, $localStorage, $window)  
        {  
            
                $window.alert("Data from parent page is: " + $localStorage.LocalMessage);  
             
        });  
    </script>  
</head>  
  
<body>  
    <div ng-app="MyApp" ng-controller="ExampleController"> <input type="button" value="Get" ng-click="Get()" /> </div>  
</body>  
  
</html>  
 