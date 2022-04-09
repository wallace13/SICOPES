////////
start();
window.onresize = start;
function start(){
    var largura = window.screen.availWidth;        
    if (largura <= 980){ 
        document.querySelector("button[name='otimo']").innerHTML = 'Otimo';
        document.querySelector("button[name='bom']").innerHTML = 'Bom';
        document.querySelector("button[name='regular']").innerHTML = 'Regular';
        document.querySelector("button[name='ruim']").innerHTML = 'Ruim';
    } else if (largura > 980){ 
        document.querySelector("button[name='otimo']").innerHTML = 'Vote';
        document.querySelector("button[name='bom']").innerHTML = 'Vote';
        document.querySelector("button[name='regular']").innerHTML = 'Vote';
        document.querySelector("button[name='ruim']").innerHTML = 'Vote';
    } 
}
