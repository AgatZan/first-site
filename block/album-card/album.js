function createAlbumRoot(){
    var album = document.createElement('article');
    album.classList.add('album');
    return album;
}
export class Album{
    constructor(v, root=createAlbumRoot()){
        this.author = v['author']['name'];
        this.title = v['name'];
        this.cover = v['cover'];
        this.coverPlaceholder = v.coverPlaceholder ?? v['id'] + 1;
        this.price = v['price'];
        this.starRate = v['estimation'];
        this.root = root;
    }
}