<?php
namespace Model_Album;

function update( \PDO $con
	, $album_id
	, $album_name = NULL
	, $estimation = NULL
	, $album_genre_id = NULL
	, $album_genre_name = NULL
	, $author_id = NULL
	, $author_name = NULL
	, $song_id = NULL
	, $song_name = NULL
	, $song_genre_id = NULL
	, $song_genre_name = NULL
):\Either{
    $obj =[
        'album_id' => $album_id
		, 'album_name' => $album_name
		, 'estimation' => $estimation
		, 'album_genre_id' => $album_genre_id
		, 'album_genre_name' => $album_genre_name
		, 'author_id' => $author_id
		, 'author_name' => $author_name
		, 'song_id' => $song_id
		, 'song_name' => $song_name
		, 'song_genre_id' => $song_genre_id
		, 'song_genre_name' => $song_genre_name
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `album` SET $set WHERE `album_id` = :album_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
