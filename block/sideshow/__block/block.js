export class SideshowBlock{
    constructor(cover, altCover, text, link){
        this.cover = cover;
        this.altCover = altCover;
        this.text = text;
        this.link = link
    }
    html(){
        var block = document.createElement('a');
        block.href = this.link;
        block.classList.add('sideshow__block', 'sideshow__block_no-text');
        block.innerHTML = `
        <img src="${this.cover}" alt="${this.altCover}" class="sideshow__images">
        <div class="sideshow__text">${this.text}</div>
        `;
    }

}