function createAlbumsRoot(){
    var albs = document.createElement('article');
    albs.className = 'albums';
    return albs;
}
export class Albums{
    constructor(albums, root=createAlbumsRoot()){
        this.albums = albums;
        this.root = root;
        this.root.append(...albums);
    }
}