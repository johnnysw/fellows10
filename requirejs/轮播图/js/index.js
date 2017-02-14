require(["carousel"], function(Carousel){
    var imgArr1 = ["img/1.jpg", "img/2.jpg", "img/3.jpg", "img/4.jpg"];
    var settings1 = {
        selector : "#container1",//表示轮播图显示的位置
        imgs : imgArr1,//表示显示的图片
        buttonStyle : "circle",//square 表示索引的样式
        arrowPos : "bottom",//center 表示前后按钮的位置
        speed : 500//表示图片轮换的速度
    };
    var carousel1 = new Carousel();
    carousel1.init(settings1);

    var imgArr2 = ["img/1.jpg", "img/2.jpg", "img/3.jpg"];
    var settings2 = {
        selector : "#container2",//表示轮播图显示的位置
        imgs : imgArr2,//表示显示的图片
        buttonStyle : "square",//square 表示索引的样式
        arrowPos : "center",//center 表示前后按钮的位置
        speed : 1000//表示图片轮换的速度
    };
    var carousel2 = new Carousel();
    carousel2.init(settings2);

});