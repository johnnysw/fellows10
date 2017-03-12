var ImgFigure = React.createClass({
    render : function(){
        return (
            <figure className="img-figure">
                <img src={"img/" + this.props.info.fileName}/>
                <figcaption>
                    <h2>{this.props.info.title}</h2>
                    <h3></h3>
                </figcaption>
            </figure>
        );
    }
});
var Controller = React.createClass({
    render : function(){
        return (
            <span></span>
        );
    }
});

var Photowall = React.createClass({
    render : function(){
        var imgFigureArr = [];
        var controllerArr = [];
        imgDatas.forEach(function(value, index, arr){
            imgFigureArr.push(<ImgFigure key={index} info={value}/>);
            controllerArr.push(<Controller key={index}/>);
        });
        return (
            <section className="stage">
                <section>
                    {imgFigureArr}
                </section>
                <section>
                    {controllerArr}
                </section>
            </section>

        );
    }
});

ReactDOM.render(
    <Photowall/>,
    document.getElementById("photowall")
);

function getRandom(low, high){
    return Math.ceil(Math.random() * (high - low) + low); 
}











