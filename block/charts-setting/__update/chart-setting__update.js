
export class ChartsSettingUpdate{
    constructor(tags, root){
        this.tags = tags;
        this.root = root;
        this.html();
    }
    html(){
        this.root.append(...this.tags.map(v=>{
            var opt = document.createElement('option');
            opt.value = v['id'];
            opt.innerText = v['name'];
            return opt;
        }));
        return this.root;
    }
}