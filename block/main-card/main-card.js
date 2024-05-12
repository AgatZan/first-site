export class MainCard{
    constructor(title, albums, ratio=4){
        this.title = title;
        this.albums = albums;
        this.ratio = ratio;
        this.cur = 0;
    }
    move(x, target, arrow){
        if(0<= x+this.ratio&& x+this.ratio <this.albums.length){
            arrow.classList.remove('arrow_disable');    
            target.style.setProperty('--main-card-albums-cur', x);
            this.cur = x;
        }else arrow.classList.add('arrow_disable');            
    }
    html(){
        var main_card = document.createElement('article');
        main_card.classList.add('main-card');
        var title = document.createElement('h1');
        title.classList.add('main-card__title');
        title.innerText = this.title;
        var albums = document.createElement('section');
        albums.classList.add('main-card__albums');
        albums.classList.remove
        albums.style.setProperty('--main-card-albums-ratio', this.ratio);
        for(var i=0;i<this.albums.length;++i) albums.append(this.albums[i]);
        var aleft = document.createElement('div');
        aleft.classList.add('arrow', 'arrow_direction_left');
        aleft.onclick = e=>this.move(this.cur-1, albums, aleft);
        var aright = document.createElement('div');
        aright.classList.add('arrow', 'arrow_direction_right');
        aright.onclick = e=>this.move(this.cur+1, albums, aleft);
        main_card.append(title, aright, aleft, albums);
        return main_card;
    }
}