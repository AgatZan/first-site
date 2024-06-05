import { AlbumVertical } from "./block/album-card/_orientation/vertical.js";
import { MainCard } from "./block/main-card/main-card.js";

var id = new URLSearchParams(window.location.search).get('id');
fetch('/api/user/'+id).then(onRes=>onRes.json()
).then(json=>{
    var user =document.querySelector('user-card');
    user.querySelector('.user-card__user_name').innerText = json['user']['name'];
    var verti = new MainCard(
        json['user']['name']+' Albums'
        , json['album'].map(v=>new AlbumVertical(v, v['song'],_=>_).root)
        , user.querySelector('.user-card__albums')
        , 24
    );
})
