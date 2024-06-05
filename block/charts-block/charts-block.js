function createChartsBlockRoot(){
    var chart = document.createElement('article');
    chart.classList.add('charts-block');
    return chart;
}
export class ChartsBlock{
    constructor(albums, root = createChartsBlockRoot()){
        this.albums = albums;
        this.root = root;
    }
    html(){
        for (var i = 0; i < this.albums.length; ++i) {
            var position = document.createElement('div');
            position.classList.add('charts-block__positions');
            position.innerText = i+1;
            var chart_place = document.createElement('div');
            chart_place.classList.add('charts-block__placeholder');
            chart_place.append(this.albums[i], position);
            this.root.append(chart_place);
        }
        return this.root;
    }
}