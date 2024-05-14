<?php
namespace Model_Album;

function insert(\PDO $con
	, $album_name
	, $estimation
	, $album_genre_id
	, $album_genre_name
	, $author_id
	, $author_name
	, $song_id
	, $song_name
	, $song_genre_id
	, $song_genre_name
	, $album_release_date = NULL
):\Either{
    $obj = [
        'album_name' => $album_name
		, 'estimation' => $estimation
		, 'album_genre_id' => $album_genre_id
		, 'album_genre_name' => $album_genre_name
		, 'author_id' => $author_id
		, 'author_name' => $author_name
		, 'song_id' => $song_id
		, 'song_name' => $song_name
		, 'song_genre_id' => $song_genre_id
		, 'song_genre_name' => $song_genre_name
		, 'album_release_date' => $album_release_date
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    $set = '';
    $inset = '';
    foreach($obj as $key=>$val){
        $set .= "$key,";
        $inset .= ":$key,";
    }
    $set = substr($set, 0, -1);
    $inset = substr($inset, 0, -1);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES ($inset)
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
