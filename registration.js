import { UserPanel } from "./block/user-panel/user-panel.js";

document.addEventListener('DOMContentLoaded', e=>{
    function reged(){
        var reg = document.querySelector('.registration_panel');
        reg.parentNode.removeChild(reg);
        var user_panel = new UserPanel(
            localStorage.getItem('userName')
            , localStorage.getItem('userId')
        );
    }
    function err(err, target){
        target.innerText = err;
        return {};
    }
    if(localStorage.getItem('userAuth')) reged();
    else{
        var forms = document.querySelectorAll('dialog form');
        forms.forEach(v=>v.addEventListener('submit', e=>{
                e.defaultPrevented();
                var href = v.getAttribute("action");
                fetch(href,{
                    method:"POST"
                    , headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                    , body:new FormData(v)
                }
                ).then(onRes=>onRes.json()
                ).then(json=>json['err']
                ? err(
                    json['err']
                    , document.querySelector('.'+v.parentElement.className+'__error')
                )
                :json
                ).then(json=>{
                    if(json['userAuth']){
                        localStorage.setItem('userAuth', json['userAuth']);
                        reged();
                    }else document.querySelector('.'+v.parentElement.className+'__error').innerText=json['err']
                });


            })
        )
    
    }


})
