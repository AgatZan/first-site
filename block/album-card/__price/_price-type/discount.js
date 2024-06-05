export class AlbumVerticalDiscount extends AlbumVertical{
    constructor(v, songs, onclick, discount, root=undefined){
        super(v, songs, onclick, root);
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