import { AlbumHorizontal } from "../album-card/_orientation/horizontal";
function createBasketRoot(){
    var basket = document.createElement('div');
    basket.className = 'basket';
    return basket;
}
export class Basket{
    constructor(albums, root=createBasketRoot()){
        this.albums = albums;
        this.root = root;
        this.html();
    }
    totalPrice(){
        var res = this.cost;
        if(!res) res = this.albums.reduce((acc,v)=>acc + v.price);
        this.root.style.setProperty('--basket-count', ' ('+this.albums.length+')');
        return res;
    }
    insertAlbum(album){
        document.getElementsByClassName('backet__albums')[0].append(album.html());
        this.albums.push(album);
        document.getElementsByClassName('drop-down-menu__total-cost-value')[0]
        .innerText = this.cost = this.totalPrice() + album.price;
    }
    deleteAlbum(id){
        var deleted = this.albums[id];
        this.albums.splice(id, 1);
        var albs =document.querySelector('basket__albums');
        albs.removeChild(albs.children[id]);
        document.getElementsByClassName('drop-down-menu__total-cost-value')[0]
        .innerText = this.cost = this.totalPrice() - deleted.price;
    }
    html(){
        this.root.style.setProperty('--basket-count', ' ('+this.albums.length+')');
        var opener = document.createElement('a');
        opener.className = 'basket__goods';
        opener.innerHTML = '<p>Cart</p>';

        var dropDown = document.createElement('div');
        dropDown.className = 'drop-down-menu';

        var backetAlbums = document.createElement('div');
        backetAlbums.className('basket__albums'); 
        var i =0;
        backetAlbums.innerHTML = this.elems.reduce((acc,v)=>{
            v.coverPlaceholder = ++i;
            return acc + new AlbumHorizontal(v, ()=>this.deleteAlbum(i-1), basket).html().outerHTML;
        });
        
        var totalPrice = document.createElement('div');
        totalPrice.className = 'drop-down-menu__total-price';
        totalPrice.innerHTML = `
            <div class="drop-down-menu__total-cost-text">Total delivery cost: </div>
            <div class="drop-down-menu__total-cost-value album-card__price_price-type_dollar">${this.totalPrice()}</div>
        `;
        
        var userChoose = document.createElement('div');
        userChoose.className = 'drop-down-menu__user-choose';
        userChoose.innerHTML = `
            <a href="" class="drop-down-menu__view styled-text_grey-border">View Card</a>
            <a href="" class="drop-down-menu__checkout styled-text_grey-border">Proceed to Checkout</a>
        `;
        dropDown.append(backetAlbums, totalPrice, userChoose);

        this.root.append(opener,dropDown);
        this.root.append(dropDown);

    }
}