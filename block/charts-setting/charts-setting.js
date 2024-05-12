export class ChartsSetting{
    constructor(url, chosed, subscribers){
        this.subscribers = subscribers;
        this.url=url;
        this.chosed = chosed;
    }
    sub(ok, err){
        this.subscribers.push({ok:ok, err:err});
    }
    html(){
        var chartsettings = document.createElement('form');
        chartsettings.classList.add('charts-setting');
        chartsettings.setAttribute('methid', 'get');
        chartsettings.setAttribute('action', this.url);
        chartsettings.innerHTML = `
        <select name="type" class="charts-setting__type">
                <option value="Top">Top</option>
                <option value="Popular">Popular</option>
                <option value="Exotic">Exotic</option>
            </select>
            <select name="format" class="charts-setting__format">
                <option value="Albums">Albums</option>
                <option value="Ep">Ep</option>
                <option value="Mixtape">Mixtape</option>
                <option value="Singles">Singles</option>
            </select>
            <label class="charts-setting__year" for="to-date"></label>
            <input  type="date" name="to-date">
            <div class="chart-block__genres">
                <label for="charts-block__genres">Chosed-genres: </label>
                <textarea class="charts-block__genres">${this.chosed}</textarea>
            </div>
            <button type="submit" class="charts-setting__update">Update chart</button>
        `;
        chartsettings.onsubmit = e=>{
            e.defaultPrevented();
            fetch(this.url + '?' + new URLSearchParams(new FormData(chartsettings)))
            .then(onRes=>onRes.ok?onRes.json():Promise.reject(onRes.json()))
            .then(json=>this.subscribers.forEach(elem => elem.ok(elem.target, json)))
            .catch(json=>this.subscribers.forEach(elem => elem.err(elem.target, json)));
        };
        return chartsettings;
    }
}