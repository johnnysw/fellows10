//数组排序模块
define(["b"], function(isArray){
   function arrSort(arr){
       if(isArray(arr)){
           return arr.sort(function(a, b){
               return a - b;
           });
       }else{
           return "传入参数不是数组";
       }

   }
   return arrSort;
});