export class Sideshow{
    constructor(blocks){
        this.blocks = blocks
        this.active = 0;
    }
    move(target, direct){
        this.blocks.at(this.active + direct).classList.toggle('.sideshow__block_position_left');
        this.blocks.at(this.active + direct).classList.toggle('.sideshow__block_position_center');
        this.blocks.at(this.active).classList.toggle('.sideshow__block_position_center');
        this.blocks.at(this.active - direct).classList.toggle('.sideshow__block_position_right');
        this.active += direct;
        var end = (this.blocks.length - 1) * (1 + direct) / 2;
        if( direct * (this.active - end) >= 0 && !target.classList.contains('sideshow__mover_inactive')) 
        target.classList.add('sideshow__mover_inactive');
        else if(this.active - end > 0 && target.classList.contains('sideshow__mover_inactive'))
        target.classList.remove('sideshow__mover_inactive');
    }
    html(){
        var sideshow = document.createElement('article');
        sideshow.classList.add('sideshow');
        var aleft = document.createElement('div');
        aleft.classList.add('sideshow__mover', 'sideshow__mover_theme_circle', 'sideshow__mover_background_arrow-left');
        if(!this.active) aleft.classList.add('sideshow__mover_inactive');
        aleft.onclick = e=>this.move(aleft, -1);
        var aright = document.createElement('div');
        aright.classList.add('sideshow__mover', 'sideshow__mover_theme_circle', 'sideshow__mover_background_arrow-right');
        if(this.active>=this.blocks.length-1) aright.classList.add('sideshow__mover_inactive');
        aright.onclick = e=>this.move(aright, 1);
        sideshow.append(aleft,aright);
        var blocks = document.createElement('div');
        blocks.classList.add('sideshow__blocks');
        this.blocks[this.active].classList.add('sideshow__block_position_center');
        blocks.append(this.blocks);
    }
}