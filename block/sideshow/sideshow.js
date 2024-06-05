function createSideshowRoot(){
    var root = document.createElement('article');
    root.classList.add('sideshow');
    return root;
}
export class Sideshow{
    constructor(blocks, root = createSideshowRoot()){
        this.blocks = blocks
        this.active = 0;
        this.root = root;
        this.html();
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
        var aleft = document.createElement('div');
        aleft.classList.add('sideshow__mover', 'sideshow__mover_theme_circle', 'sideshow__mover_background_arrow-left');
        aleft.onclick = e=>this.move(aleft, -1);
        var aright = document.createElement('div');
        aright.classList.add('sideshow__mover', 'sideshow__mover_theme_circle', 'sideshow__mover_background_arrow-right');      
        aright.onclick = e=>this.move(aright, 1);
        var blocks = document.createElement('div');
        blocks.classList.add('sideshow__blocks');
        this.blocks[this.active].classList.add('sideshow__block_position_center');
        aleft.classList.add('sideshow__mover_inactive');
        this.blocks[this.active-1].classList.add('sideshow__block_position_left');
        if(this.active>=this.blocks.length-1) aright.classList.add('sideshow__mover_inactive');
        else this.blocks[this.active+1].classList.add('sideshow__block_position_right');
        blocks.append(this.blocks);
        this.root.append(aleft,aright);
    }
}