import { Album } from "../album";

export class AlbumVertical extends Album{
    constructor(v, albumLink, description, songs, onclick){
        super(v);
        this.onclick = onclick;
        this.albumLink = albumLink;
        this.description = description;
        this.songs = songs;
    }
    html(){
        var horizontal = document.createElement('article');

        horizontal.classList.add('album-card', 'album-card_orientation_vertical');
        horizontal.innerHTML = `
            <div class="album-card__container-image">
                    <a href="${this.albumLink}" class="album-link">
                        ${this.songs.outerHTML}
                        <img src="${this.cover}" alt="${this.coverPlaceholder}" class="album-card__cover">
                        ${this.songs.outerHTML}
                    </a>
            </div>
        `;
        var info = document.createElement('div');
        info.className = 'album-card__information';
        info.innerHTML = `
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
                <p class="album-card__description">
                    ${this.description}
                </p>  
        `;
        var price = document.createElement('div');
        price.className = "album-card__price";
        price.innerHTML = `<span class="album-card__price-value album-card__price_price-type_dollar">${this.price}</span>`;
        var buy = document.createElement('a');
        buy.className = 'album-card__buy-button';
        buy.innerText = 'ADD TO CARD';
        buy.onclick = e=>{e.stopPropagation(); this.onclick()};
        price.append(buy);
        info.append(price);
        horizontal.append(info);
        return horizontal;
    }
}