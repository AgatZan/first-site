import { AlbumHorizontal } from "./block/album-card/_orientation/horizontal.js";
import { AlbumVertical } from "./block/album-card/_orientation/vertical.js";
import { Basket } from "./block/basket/basket.js";
import { MainCard } from "./block/main-card/main-card.js";

var basket = new Basket(
    await fetch('/api/album/ids?'+JSON.parse(localStorage.getItem('__music-store__albums')).reduce((acc, v)=>acc+'id[]='+v)
        ).then(onRes=>onRes.json()
        ).then(json=>json['err']?{'album':[]}:json
        ).then(json=>json['album'].map((v,k)=>new AlbumHorizontal(
            v
            ,!localStorage.getItem('userAuth')? _=>_: _=>basket.deleteAlbum(k)
        )))
    , document.querySelector('.basket__albums')
);
var main_cards = document.querySelector('.main');
var collections = await fetch(
    '/api/collection'
).then(onRes=>onRes.json()
).then(json=>json['err']? ['collection']:json
).then(json=>json.map(v=>new MainCard(
        v['title']
        , new AlbumVertical(
            v
            , []
            ,!localStorage.getItem('userAuth')? _=>_: _=>basket.insertAlbum(v)
        )
    )
)).then(cards=>cards.forEach(card => main_cards.append(card.root)));