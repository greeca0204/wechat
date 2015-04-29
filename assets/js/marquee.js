// JavaScript Document
function startmarquee(lh,speed,delay,element,index){ 
var t; 
var p=false; 
var o=document.getElementById(element); 
o.innerHTML+=o.innerHTML; 
//o.onmouseover=function(){p=true} 
//o.onmouseout=function(){p=false} 
//替换成触屏事件
o.ontouchstart=function(){p=true} 
o.ontouchend=function(){p=false} 
o.scrollTop = index; 
function start(){ 
t=setInterval(scrolling,speed); 
if(!p){ o.scrollTop += 1;} 
} 
function scrolling(){ 
if(o.scrollTop%lh!=0){ 
o.scrollTop += 1; 
if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0; 
}else{ 
clearInterval(t); 
setTimeout(start,delay); 
} 
} 
setTimeout(start,delay); 
} 