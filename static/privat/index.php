<?php
 session_start();
 if(!isset($_SESSION['authT'])){
    $reg = <<<EOF
    <form id="reg">
        <input type="password" name="admin_pass" >
        <button type="submit">Send</button>
        <div class="err"></div>
    </form>
    EOF;
 } else{
    $reg = <<<EOF
    <form class="post" action="/api/author">
        <label for="author__name">Имя автора:</label>
        <label for="author__page">Имя страницы автора:</label>
        <input type="text" name="author__name" >
        <input type="text" name="author__page" >
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="post" action="/api/news">
        <label for="news__path">Путь к новости:</label>
        <label for="news__title">Название:</label>
        <label for="cover">Обложка:</label>
        <label for="news__text">:</label>
        <input type="text" name="news__path">
        <input type="file" name="cover" accept="image/*">
        <textarea name="news__text"></textarea>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="post" action="/api/user">
        <label for="user__name">Имя пользователя:</label>
        <label for="user__password">Пароль:</label>
        <input type="text" name="user__name">
        <input type="text" name="user__password">
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="post" action="/api/estimation">
        <label for="estimation">Оценка:</label>
        <label for="album__id">Альбом:</label>
        <input type="number" min=0 max=10 name="estimation">
                <div class="chart-block__albums finder">
                <label for="song__album__id">Chosed-album: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="album__id" class="id" data-href="album" class="charts-setting__update">
                </select>
        </div>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="post" action="/api/album">
        <label for="album__name">Наименование альбома:</label>
        <label for="album__price">Цена альбома:</label>
        <label for="album__remains">Количество копий:</label>
        <label for="album__discount">Процент скидки:</label>
        <label for="album__realease_date">Дата выпуска:</label>
        <label for="album__type">Тип:</label>
        <label for="album__cover">Обложка:</label>
        <input type="text" name="album__name">
        <input type="number" name="album__price">
        <input type="number" name="album__remains" min=0>
        <input type="number" name="album__discount" min=0 max=100>
        <select name="album__type">
            <option value="album">Albums</option>
            <option value="ep">Ep</option>
            <option value="playlist">Playlist</option>
            <option value="cd">Audio CD</option>
            <option value="mixtape">Mixtape</option>
            <option value="singles">Singles</option>
        </select>
        <input type="datetime-local" name="album__release_date">
        <input type="file" name="cover" acept="image/*">
        <div class="chart-block__genres finder">
                <label for="album__genre__id">Chosed-genres: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="album__genre__id" class="id" data-href="genre" class="charts-setting__update" multiple>
                </select>
        </div>
        <div class="chart-block__authors finder">
                <label for="album__author__id">Chosed-author: </label>
                <div class="charts-block__opt">
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                </div>
                <select name="album__author__id" class="id" data-href="author" class="charts-setting__update">
                </select>
        </div>
        <div class="chart-block__songs id">
                <label for="album__song__id">Chosed-songs: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_songs selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="album__song__id" class="id" data-href="song" class="charts-setting__update" multiple>
                </select>
        </div>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/collection" class="post">
        <label for="collection__name">Наименование коллекции:</label>
        <input type="text" name="collection__name">
        <div class="chart-block__albums finder">
                <label for="collection__album__id">Chosed-albums: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_albums selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="collection__album__id" class="id" data-href="albums" class="charts-setting__update" multiple>
                </select>
        </div>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="post" action="/api/song">
        <label for="song__name">Имя песни:</label>
        <label for="song__path">Песня:</label>
        <input type="text" name="song__name">
        <input type="file" name="song__path" accept="audio/mpeg,audio/ogg">
        <div class="chart-block__genres finder">
                <label for="song__genre__id">Chosed-genres: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="song__genre__id" class="id" data-href="genre" class="charts-setting__update" multiple>
                </select>
        </div>
        <div class="chart-block__albums finder">
                <label for="song__album__id">Chosed-album: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="song__album__id" class="id" data-href="album" class="charts-setting__update">
                </select>
        </div>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="post" action="/api/genre">
        <label for="genre__name">Имя жанра:</label>
        <input type="text" name="genre__name">
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="patch" action="/api/author">
        <label for="author__name">Имя автора:</label>
        <label for="author__page">Имя страницы автора:</label>
        <label for="author__id">ID автора:</label>
        <select name="author__id" class="id">
        </select>
        <input type="text" name="author__name" >
        <input type="text" name="author__page" >
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form class="patch" action="/api/news">
        <label for="news__text">Имя автора:</label>
        <label for="news__title">Наименование:</label>
        <label for="news__id">ID новости:</label>
        <label for="cover">Обложка:</label>
        <select name="news__id" class="id">
        </select>
        <input type="text" name="news__name">
        <input type="file" name="cover" accept="image/*">
        <textarea name="news__text">
        </textarea>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/album" class="patch">
        <div class="chart-block__albums finder">
                    <label for="album__id">Chosed-album: </label>
                    <div class="charts-block__opt">
                        <div class="charts-block__selected_tags selected">
                        </div>
                        <input type="text" class="charts-block__search" placeholder="Search tags...">
                        <button class="charts-block__clear"></button>
                    </div>
                    <select name="album__id" class="id" data-href="album" class="charts-setting__update">
                    </select>
            </div>
        <label for="album__name">Наименование альбома:</label>
        <label for="album__price">Цена альбома:</label>
        <label for="album__remains">Количество копий:</label>
        <label for="album__discount">Процент скидки:</label>
        <label for="album__realease_date">Дата выпуска:</label>
        <label for="album__type">Тип:</label>
        <label for="album__cover">Обложка:</label>
        <input type="text" name="album__name">
        <input type="number" name="album__price">
        <input type="number" name="album__remains" min=0>
        <input type="number" name="album__discount" min=0 max=100>
        <select name="album__type">
            <option value="album">Albums</option>
            <option value="ep">Ep</option>
            <option value="playlist">Playlist</option>
            <option value="cd">Audio CD</option>
            <option value="mixtape">Mixtape</option>
            <option value="singles">Singles</option>
        </select>
        <input type="datetime-local" name="album__release_date">
        <input type="file" name="cover" acept="image/*">
        <div class="chart-block__genres finder">
                <label for="album__genre__id">Chosed-genres: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="album__genre__id" class="id" data-href="genre" class="charts-setting__update" multiple>
                </select>
        </div>
        <div class="chart-block__authors finder">
                <label for="album__author__id">Chosed-author: </label>
                <div class="charts-block__opt">
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                </div>
                <select name="album__author__id" class="id" data-href="author" class="charts-setting__update">
                </select>
        </div>
        <div class="chart-block__songs id">
                <label for="album__song__id">Chosed-songs: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_songs selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="album__song__id" class="id" data-href="song" class="charts-setting__update" multiple>
                </select>
        </div>
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/user" class="patch">
        <div class="chart-block__users finder">
                <label for="user__name">Chosed-author: </label>
                <div class="charts-block__opt">
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                </div>
                <select name="user__name" class="id" data-href="user" class="charts-setting__update">
                </select>
        </div>
        <label for="user__password">Пароль:</label>
        <input type="text" name="user__password">
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/genre" class="patch">
        <div class="chart-block__genres finder">
                <label for="genre__id">Chosed-genres: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="genre__id" class="id" data-href="genre" class="charts-setting__update" multiple>
                </select>
        </div>
        <label for="genre__name">Имя:</label>
        <input type="text" name="genre__name">
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/genre" class="patch">
        <div class="chart-block__collection finder">
                <label for="collection__id">Chosed-genres: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="collection__id" class="id" data-href="collection" class="charts-setting__update" multiple>
                </select>
        </div>
        <label for="collection__name">Имя:</label>
        <input type="text" name="collection__name">
        <button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/album" class="delete">
        <label for="album__id">ID Альбома:</label><input type="number" name="album__id"><button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/song" class="delete">
        <label for="song__id">ID Песни:</label><input type="number" name="song__id"><button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/user" class="delete">
        <label for="user__name">Имя Пользователя:</label><input type="user__name" name="text"><button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    <form action="/api/author" class="delete">
        <label for="author__id">ID Автора:</label><input type="number" name="author__id"><button type="submit">Отправить</button>
        <div class="err"></div>
    </form>
    EOF;
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/static/css/admin.min.css">
</head>
<body>
    <?= $reg ?>
    
    
    <script type="module" src="/admin.js" defer></script>
</body>
</html>