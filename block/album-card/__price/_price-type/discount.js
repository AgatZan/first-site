import { AlbumHorizontal } from "../../_orientation/horizontal";

export class AlbumHorizontalDiscount extends AlbumVertical{
    constructor(v, albumLink, description, songs, onclick, discount){
        super(v, albumLink, description, songs, onclick);
        this.discount = discount;
    }
    html(){
        var past = super.html();
        past.classList.add('album-card_price_discount');
        past.querySelector('album-card__cover').classList.add('album-card__cover_discount');
        past.querySelector('album-card__price-value').style.setProperty('--discount-price', this.discount);
        return past;
    }
}