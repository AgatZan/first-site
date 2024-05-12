export class ChartsBlock{
    constructor(albums){
        this.albums = albums;
    }
    html(){
        var chart = document.createElement('article');
        chart.classList.add('charts-block');
        var position = document.createElement('div');
        position.classList.add('charts-block__positions');
        for (var i = 0; i < this.albums.length; ++i) {
            chart.append(this.albums[i]);
            var elem =document.createElement('span');
            elem.classList.add('charts-block__position');
            elem.innerText = i+1;
            position.append(elem);
        }
        return chart;
    }
}