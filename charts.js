import { AlbumHorizontal } from "./block/album-card/_orientation/horizontal.js";
import { ChartsBlock } from "./block/charts-block/charts-block.js";
import { ChartsSettingUpdate } from "./block/charts-setting/__update/chart-setting__update.js";
var get = new URLSearchParams(window.location.search);
var chTags;
// var tags = atob(get.get('tags'));
// var from = new Date(get.get('from'));
// var to = new Date(get.get('to'));
// var type = get.get('type');

function addToSelected(opt){
    var tag = document.createElement('div');
    tag.dataset.tid = opt.value;
    tag.innerHTML = `<span>${opt.innerText}</span>`;
    var del = document.querySelector('span');
    del.onclick = e=>tag.parent.removeChild(tag);
    del.innerText = 'X';
    tag.append(del);
    document.querySelector('.charts-block__selected_tags').append(tag);
}
document.querySelector('.charts-block__clear').onclick = e=>document.querySelector('.charts-block__selected_tags').innerHTML = '';

function mapMemo(){
    var memo = new Map();
    return e=>{
        if(memo.get(e.target.value)) {
            memo.delete(e.target.value);
            var a =document.querySelector(`[tid=${e.target.value}]`);
            a.parent.removeChild(a);
            return;
        }
        memo.set(e.target.value, e.target.value);
        addToSelected(e.target.options[e.target.options.selectedIndex]);
    };
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
    return function perform(str) {
      if (timer) return
      timer = setTimeout(() => {
        showTags(chTags, str);
        clearTimeout(timer)
        timer = null
      }, timeout)
    }
  }
function showTags(tags, fuzzystr){
    if(fuzzystr=='') var sorted_tags = tags.toSorted();
    else var sorted_tags = tags.toSorted((a,b)=>fuzzy(b['name'], fuzzystr)-fuzzy(a['name'], fuzzystr));
    var opts = document.querySelector('.charts-setting__update').options;
    for(var i =0;i<opts.length;++i){
        opts[i].value = sorted_tags[i]['id'];
        opts[i].innerText = sorted_tags[i]['name'];
    }
}
var throtle500 = throttleFuzz(500);
document.querySelector('.charts-block__search').onkeydown = e=> throtle500(e.target.value);

document.querySelector('.charts-setting__update').addEventListener('change', mapMemo());
document.querySelector('.charts-setting__format').addEventListener('change', e=>{
    if(e.target.value=='song') renderChartTags('song');
    else renderChartTags('album');
});
var charts_memo = new Map();
async function renderChartTags(type){
    if(charts_memo.has(type)){
        chTags = charts_memo.get(type);
        fetch('/genre/'+type
        ).then(onRes=>onRes.json()
        ).then(json=>json['err']?{type:{'genre':[]}}:json
        ).then(json=>charts_memo.set(type,json[type]['genre']));
    }else{
        chTags =(await fetch('/genre/'+type
        ).then(onRes=>onRes.json()
        ).then(json=>json['err']?{type:{'genre':[]}}:json
        ))[type]['genre'];
        charts_memo.set(type, chTags);
    }
    var chart_tags = new ChartsSettingUpdate(
        chTags
        , document.querySelector('.charts-setting__update')
    );
}

async function renderChartBlock(get){
    var chart_block = new ChartsBlock(
        await fetch('/api/?'+get.toString()
        ).then(onRes=>onRes.json()
        ).then(json=>json['err']?{'album':[]}:json
        ).then(json=>json['album'].map(v=>new AlbumHorizontal(
            v
            , _=>_
        )))
        , document.querySelector('.charts-block')
    );
}
renderChartBlock(get);
/**
 * @param {string} str 
 * @returns {string} 
 */
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
// function duple_zip(str){
//     var res = [];
//     var last = str[0];
//     var count = 1;
//     for(var i=1;i<str.length;++i){
//         if(last==str[i]) ++count;
//         else{
//             res.push(count + last.toString());
//             last = str[i];
//             count = 1;
//         }
//     }
//     var real_res = res.join('');
//     return real_res.length>str?str:real_res;
// }
var chart_setting = document.querySelector('.charts-setting');
chart_setting.addEventListener('sumbit',e=>{
    e.defaultPrevented();
    var fdata = new FormData(chart_setting);
    fdata.set('tags', BigInt('0b',zip(fdata.get('tags').join(''))).toString());
    renderChartBlock(new URLSearchParams(fdata));
});