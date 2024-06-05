import { AlbumVerticalDiscount } from "./block/album-card/__price/_price-type/discount.js";
import { AlbumSongs } from "./block/album-card/__songs/songs.js";
import { AlbumHorizontal } from "./block/album-card/_orientation/horizontal.js";
import { AlbumVertical } from "./block/album-card/_orientation/vertical.js";
import { Albums } from "./block/albums/albums.js";
import { Basket } from "./block/basket/basket.js";
import { SideshowBlock } from "./block/sideshow/__block/block.js";
import { Sideshow } from "./block/sideshow/sideshow.js";

var basket = new Basket(
    await fetch('/api/album/ids'+JSON.parse(localStorage.getItem('__music-store__albums')).reduce((acc, v)=>acc+'id[]='+v)
        ).then(onRes=>onRes.json()
        ).then(json=>json['err']?{'album':[]}:json
        ).then(json=>json['album'].map((v,k)=>new AlbumHorizontal(
            v
            ,!localStorage.getItem('userAuth')? _=>_: _=>basket.deleteAlbum(k)
        )))
    , document.querySelector('.basket__albums')
);


var sideshow = new Sideshow(
    await fetch('/api/news'
        ).then(onRes => onRes.json()
        ).then(json=>json['err']?{'news':[]}:json
        ).then(json=>json['news'].map(
                v=>new SideshowBlock(v['cover_path'], 'cover', v['text'], v['path'])
            )
        ).catch(_=>[]) 
    , document.querySelector('.sideshow')
);

function insertAlbum(context){
    if(v['remains']<0){
        context.querySelector('.album-card__buy-button').classList.add('button_disabled');
        return;
    } 
    var lsa = memo_local_album || JSON.parse(localStorage.getItem('__music-store__albums'));
    lsa.push(v);
    localStorage.setItem('__music-store__albums', JSON.stringify(lsa));
    memo_local_album = lsa;
    basket.insertAlbum(v);
}
var memo_local_album = {};
var albums =new Albums(
    await fetch('/api/album/last?count=5'
    ).then(onRes=>onRes.json()
    ).then(json=>json['err']?{'album':[]}:json
    ).then(json=>json['album'].map(v=>
        new AlbumVertical(
            v
            , !localStorage.getItem('userAuth')? _=>_: insertAlbum
        )
    ))
    , document.querySelector('.albums_simple')
);

var albums_discount = new Albums(
    await fetch('/api/album/last?count=5&discount=1'
    ).then(onRes=>onRes.json()
    ).then(json=>json['err']?{'album':{'song':[]}}:json
    ).then(json=>json['album'].map(v=>
        new AlbumVerticalDiscount(
            v
            , new AlbumSongs(v['song'])
            , !localStorage.getItem('userAuth')? _=>_: insertAlbum
        )
    ))
    , document.querySelector('.albums_discount')
);