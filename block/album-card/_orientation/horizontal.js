import { Album } from "../album"
function createAlbumHorizontalRoot(){
    var horizontal = document.createElement('div');
    horizontal.classList.add('album-card', 'album-card_orientation_horizontal');
    return horizontal;
}
export class AlbumHorizontal extends Album{
    constructor(v, ondelete, root=createAlbumHorizontalRoot()){
        super(v, root);
        this.ondelete = ondelete;
    }
    html(){
        this.root.innerHTML = `
        <div class="album-card__container-image">
                <img src="${this.cover}" alt="${this.coverPlaceholder}" class="album-card__cover">
            </div>
            <div class="album-card__information">
                <h2 class="album-card__title">${this.title}</h2>
                <span class="album-card__author">${this.author}</span>
                <ul class="album-card__estimation">
                    ${
                        '<li class="album-card__score"><a href="" class="album-card__star "></a></li>'
                        .repeat(this.starRate)
                    }
                    ${
                        '<li class="album-card__score"><a href="" class="album-card__star album-card__star_state_unactive"></a></li>'
                        .repeat(5-this.starRate)
                    }
                </ul>                                   
            </div>
        `;
        var price = document.createElement('div');
        price.className = "album-card__price";
        price.innerHTML = `<span class="album-card__price-value album-card__price_price-type_dollar">${this.price}</span>`;
        var del = document.createElement('a');
        del.className = 'album-card__delete';
        del.onclick = e=>{e.stopPropagation(); this.ondelete()};
        price.append(del);
        this.root.append(price);
        return this.root;
    }
}