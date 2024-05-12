export class AlbumSongs{
    constructor(songs){
        this.songs = songs;
    }
    html(){
        var songs = document.createElement('ul');
        songs.classList.add('album-card__songs', 'album-card__songs_numeric');
        for(var i = 0;i<this.songs.length;++i){
            var song = document.createElement('li');
            song.classList.add('album-card__song');
            song.innerText = this.songs[i].title + ' ' + this.songs[i].duration;
            songs.append(song);
        }
        return songs;
    }
}