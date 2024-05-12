export class SideshowBlock{
    constructor(cover, altCover, text){
        this.cover = cover;
        this.altCover = altCover;
        this.text = text;
    }
    html(){
        var block = document.createElement('div');
        block.classList.add('sideshow__block', 'sideshow__block_no-text');
        block.innerHTML = `
        <img src="${this.cover}" alt="${this.altCover}" class="sideshow__images">
        <div class="sideshow__text">${this.text}</div>
        `;
    }

}