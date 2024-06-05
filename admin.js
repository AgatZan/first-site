function zip(str){
    if(str.length<3){
        var res =str.split(''); 
        return res.reduce((acc,x)=>acc+(+x).toString(2), (+res[0]).toString(2));
    }
    var start = {'0':0,'1':1,'2':2,'3':3,'4':4,'5':5,'6':6,'7':7,'8':8,'9':9,',':10};
    start[str[0]+str[1]]=11;
    var lng = 11;
    var res = [start[str[0]]];
    var pointer_start = 1;
    var pointer_end = 2;
    var cur = str[1];
    while(pointer_end+1 <= str.length){
        var slice =str.slice(pointer_start, pointer_end+1);
        if(!start[slice]){
            start[slice] = ++lng;
            res.push(start[cur]);
            pointer_start= pointer_end;
            cur = str[pointer_start];
        }else cur = slice;
        ++pointer_end;
    }
    res.push(start[str[str.length-1]]);
    return res.reduce((acc,x)=>acc+x.toString(2), res[0].toString(2));
}

function makeFormData(fdata){
    for(var pair of fdata.entries()){
        if(Array.isArray(pair[1]))
            fdata.set(pair[0], BigInt('0b'+zip(pair[1].join(''))).toString())
    }
    return fdata;
}


document.querySelectorAll('form').forEach(v=>{
    v.addEventListener('submit', e=>{
        e.preventDefault();
        fetch(v.getAttribute('action'), {
            method: v.className
            , body: makeFormData(new FormData(v))
            , headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(onRes=>onRes.json()
        ).then(json=>v.querySelector('err').innerText=json['err']??'')
    });
});
var v = document.querySelectorAll('.patch')[0];
var memo_patch = new Map();
v.querySelector('.id').innerHTML;
await fetch(v.getAttribute('action')+'/id').then(onRes=>onRes.json()
).then(json=>{
    memo_patch.set('news', json['news']);
    v.innerHTML =`
    <label for="news__text">Текст:</label>
    <label for="news__title">Наименование новости:</label>
    <label for="news__id">ID новости:</label>
    <label for="cover">Обложка:</label>
    <select name="news__id" class="id">
    ${json['news'].reduce((acc,n)=>`<option id="${n['id']}">${n['title']}</option>`)}
    </select>
    <input type="text" name="news__title">
    <input type="file" name="cover">
    <input type="image" value="">
    <textarea name="news__text">
    </textarea>
    <button type="submit">Отправить</button>
    <div class="err">${json['err']}</div>
    `;
    v.querySelector('select').onchange = e=>{
        e.target.parent.querySelector('textarea').innerText = memo_patch.get('news')[e.target.value]['text'];
        e.target.parent.querySelector('[name=news__title]').innerText = memo_patch.get('news')[e.target.value]['title'];
        e.target.parent.querySelector('[type=image]').value = 'cover/'+memo_patch.get('news')[e.target.value]['cover_path'];
    }

} );


var v = document.querySelectorAll('.patch')[1];
v.querySelector('.id').innerHTML;
await fetch(v.getAttribute('action')+'/id').then(onRes=>onRes.json()
).then(json=>{
    memo_patch.set('author', json['news']);
    v.innerHTML =`
    <label for="author__name">Имя автора:</label>
    <label for="author__page">Имя страницы автора:</label>
    <label for="author__id">ID автора:</label>
    <select name="author__id" class="id">
    ${json['author'].reduce((acc,n)=>`<option id="${n['id']}">${n['title']}</option>`)}
    </select>
    <input type="text" name="author__name" >
    <input type="text" name="author__page" >
    <button type="submit">Отправить</button>
    <div class="err">${json['err']}</div>
    `;
    v.querySelector('select').onchange = e=>{
        e.target.parent.querySelector('[name=author__name]').innerText = memo_patch.get('author')[e.target.value]['name'];
        e.target.parent.querySelector('[name=author__page]').innerText = memo_patch.get('author')[e.target.value]['page'];
    }

} );

/*
        <div class="chart-block__genres finder">
                <label for="album__genre__id">Chosed-genres: </label>
                <div class="charts-block__opt">
                    <div class="charts-block__selected_tags selected">
                    </div>
                    <input type="text" class="charts-block__search" placeholder="Search tags...">
                    <button class="charts-block__clear"></button>
                </div>
                <select name="album__genre__id id" data-href="genre" class="charts-setting__update" multiple>
                </select>
        </div>
*/


function addToSelected(rootSelect, opt){
    var tag = document.createElement('div');
    tag.dataset.tid = opt.value;
    tag.innerHTML = `<span>${opt.innerText}</span>`;
    var del = document.querySelector('span');
    del.onclick = e=>tag.parent.removeChild(tag);
    del.innerText = 'X';
    tag.append(del);
    rootSelect.append(tag);
}
function mapMemo(rootSelect){
    var memo = new Map();
    return e=>{
        if(memo.get(e.target.value)) {
            memo.delete(e.target.value);
            var a =rootSelect.querySelector(`[tid=${e.target.value}]`);
            rootSelect.removeChild(a);
            return;
        }
        memo.set(e.target.value, e.target.value);
        addToSelected(rootSelect, e.target.options[e.target.options.selectedIndex]);
    };
}

function Damerau_Levenshtein(subject, query){
    var matrix = new Array(query.length+1).map(v=>new Array(subject.length+1).fill(0));
    for(var i=0;i<query.length;++i) matrix[i][0] = i;
    for(i=0;i<subject.length;++i) matrix[0][i] = i;
    var cost = 0;
    for(var i=1;i<=query.length;++i)
    for(var j=1;j<=subject.length;++j){
        cost = +(query[i]!=subject[j]);
        matrix[i][j] = Math.min(
            matrix[i-1][j] + 1
            , matrix[i][j-1] + 1
            , matrix[i-1][j-1] + cost
        );
        if(i>0 && j>0 && subject[i]==query[j-1] && subject[i-1] == query[j])
            matrix[i][j] = Math.min(matrix[i][j], matrix[i-2][j-2]+1);
    }
    return matrix[query.length][subject.length];
}

function fuzzy(base, check){
    if(check=="") return 1;
    var string = base.toLowerCase();
    var compare = check.toLowerCase();
    var matches = 0;
    if (string.indexOf(compare) > -1) return base.length;
    for (var i = 0; i < compare.length; i++) {
        string.indexOf(compare[i]) > -1 ? matches += 1 : matches -=1;
    }
    return matches
}
function throttleFuzz(timeout) {
    var timer = null
    return function perform(str, options) {
      if (timer) return
      timer = setTimeout(() => {
        showTags(options, chTags, str, Damerau_Levenshtein);
        clearTimeout(timer)
        timer = null
      }, timeout)
    }
  }
function showTags(target_options, tags, fuzzystr, fuzzy_func){
    if(fuzzystr=='') var sorted_tags = tags.toSorted();
    else var sorted_tags = tags.toSorted(
        (a,b)=>fuzzy_func(b['name'], fuzzystr)-fuzzy_func(a['name'], fuzzystr)
    );
    var opts = target_options;
    for(var i =0;i<opts.length;++i){
        opts[i].value = sorted_tags[i]['id'];
        opts[i].innerText = sorted_tags[i]['name'];
    }
}
var throtle500 = throttleFuzz(500);
document.querySelectorAll('.finder').forEach(async v=>{
    var select = v.querySelector('select');
    var search = v.querySelector('.charts-block__search');
    var clear = v.querySelector('.charts-block__clear');
    var mult = search.getAttribute('multiple')
        ? v.querySelector('.selected')
        : false;
    var id = v.querySelector('.id');
    var update = document.querySelector('.charts-setting__update');
    if(mult) update.addEventListener('change', mapMemo(mult));
    clear.onclick = e=>mult.innerHTML = '';
    search.onkeydown = e => throtle500(e.target.value, id.options);
    await fetch('/api/'+select.dataset.href).then(onRes=>onRes.json()
    ).then(json=>json['err']
        ? (v.parentElement.querySelector('.err').innerText=json['err'])
        : select.innerHTML = json[select.dataset.href].reduce(
            (acc,n)=>acc 
                + `<option value="${n['id']}>${n['name']}</option>"`
        )
    );
});


