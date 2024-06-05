function createAlbumSongsRoot(){
    var songs = document.createElement('ul');
    songs.classList.add('album-card__songs', 'album-card__songs_numeric');
    return songs;
}
export class AlbumSongs{
    constructor(songs, root=createAlbumSongsRoot()){
        this.songs = songs;
        this.root = root;
    }
    convertTime(time){
        var mins = Math.floor(time / 60);
        var secs = Math.floor(time % 60);
        return mins + 'm ' + secs<10?'0':'' + String(secs) + 's';
    }
    html(){
        for(var i = 0;i<this.songs.length;++i){
            var song = document.createElement('li');
            song.classList.add('song-card');
            var title = document.createElement('p');
            title.classList.add('song-card__title');
            title.innerText = this.songs[i]['name'];
            var audio = new Audio('/audio/'+this.songs[i]['path']);
            audio.classList.add('song-card__audio');
            audio.preload = "metadata";
            audio.controls = true;
            var duration = document.createElement('time');
            title.classList.add('song-card__duration');
            audio.onloadeddata = e=>{
                var time = this.convertTime(audio.duration);
                duration.innerText = time;
                duration.dateTime = time;
            };
            song.append(title, audio, duration);
            songs.append(song);
        }
        return songs;
    }
}