function createUserPanelRoot(){
    var up = document.createElement('div');
    up.className = 'user_panel';
    return up
}
export class UserPanel{
    constructor(user_name, user_id, root=createUserPanelRoot()){
        this.user_name=user_name;
        this.user_id=user_id;
        this.root=root;
        this.html();
    }
    html(){
        this.root.innerHTML = `
            <a class="user-panel__link" href="/user?id=${this.user_id}">${this.user_name}</a>
        `;
        return this.root;
    }
}