var f,l=this;function m(a){return void 0!==a}function aa(){}
function ba(a){var b=typeof a;if("object"==b)if(a){if(a instanceof Array)return"array";if(a instanceof Object)return b;var c=Object.prototype.toString.call(a);if("[object Window]"==c)return"object";if("[object Array]"==c||"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("splice"))return"array";if("[object Function]"==c||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("call"))return"function"}else return"null";
else if("function"==b&&"undefined"==typeof a.call)return"object";return b}function p(a){return"array"==ba(a)}function ca(a){var b=ba(a);return"array"==b||"object"==b&&"number"==typeof a.length}function q(a){return"string"==typeof a}function r(a){return"number"==typeof a}function da(a){return"function"==ba(a)}function ea(a){var b=typeof a;return"object"==b&&null!=a||"function"==b}function fa(a){return a[ga]||(a[ga]=++ha)}var ga="closure_uid_"+(1E9*Math.random()>>>0),ha=0;
function ia(a,b,c){return a.call.apply(a.bind,arguments)}function ja(a,b,c){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var c=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(c,d);return a.apply(b,c)}}return function(){return a.apply(b,arguments)}}function t(a,b,c){t=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?ia:ja;return t.apply(null,arguments)}
function ka(a,b){var c=Array.prototype.slice.call(arguments,1);return function(){var b=c.slice();b.push.apply(b,arguments);return a.apply(this,b)}}var u=Date.now||function(){return+new Date};function v(a,b){var c=a.split("."),d=l;c[0]in d||!d.execScript||d.execScript("var "+c[0]);for(var e;c.length&&(e=c.shift());)!c.length&&m(b)?d[e]=b:d=d[e]?d[e]:d[e]={}}
function w(a,b){function c(){}c.prototype=b.prototype;a.i=b.prototype;a.prototype=new c;a.prototype.constructor=a;a.tc=function(a,c,g){for(var h=Array(arguments.length-2),k=2;k<arguments.length;k++)h[k-2]=arguments[k];return b.prototype[c].apply(a,h)}};var la;var ma=String.prototype.trim?function(a){return a.trim()}:function(a){return a.replace(/^[\s\xa0]+|[\s\xa0]+$/g,"")};function na(a){if(!oa.test(a))return a;-1!=a.indexOf("\x26")&&(a=a.replace(pa,"\x26amp;"));-1!=a.indexOf("\x3c")&&(a=a.replace(qa,"\x26lt;"));-1!=a.indexOf("\x3e")&&(a=a.replace(ra,"\x26gt;"));-1!=a.indexOf('"')&&(a=a.replace(sa,"\x26quot;"));-1!=a.indexOf("'")&&(a=a.replace(ta,"\x26#39;"));-1!=a.indexOf("\x00")&&(a=a.replace(ua,"\x26#0;"));return a}
var pa=/&/g,qa=/</g,ra=/>/g,sa=/"/g,ta=/'/g,ua=/\x00/g,oa=/[\x00&<>"']/;function va(a,b){return a<b?-1:a>b?1:0};var wa=Array.prototype.indexOf?function(a,b,c){return Array.prototype.indexOf.call(a,b,c)}:function(a,b,c){c=null==c?0:0>c?Math.max(0,a.length+c):c;if(q(a))return q(b)&&1==b.length?a.indexOf(b,c):-1;for(;c<a.length;c++)if(c in a&&a[c]===b)return c;return-1},x=Array.prototype.forEach?function(a,b,c){Array.prototype.forEach.call(a,b,c)}:function(a,b,c){for(var d=a.length,e=q(a)?a.split(""):a,g=0;g<d;g++)g in e&&b.call(c,e[g],g,a)},xa=Array.prototype.filter?function(a,b,c){return Array.prototype.filter.call(a,
b,c)}:function(a,b,c){for(var d=a.length,e=[],g=0,h=q(a)?a.split(""):a,k=0;k<d;k++)if(k in h){var n=h[k];b.call(c,n,k,a)&&(e[g++]=n)}return e};function ya(a,b){var c=wa(a,b),d;(d=0<=c)&&Array.prototype.splice.call(a,c,1);return d}function za(a){var b=a.length;if(0<b){for(var c=Array(b),d=0;d<b;d++)c[d]=a[d];return c}return[]};var Aa;a:{var Ba=l.navigator;if(Ba){var Ca=Ba.userAgent;if(Ca){Aa=Ca;break a}}Aa=""}function y(a){return-1!=Aa.indexOf(a)};function Da(a,b,c){for(var d in a)b.call(c,a[d],d,a)}function Ea(a,b){for(var c in a)if(b.call(void 0,a[c],c,a))return!0;return!1}function Fa(){var a=Ga,b;for(b in a)return!1;return!0}var Ha="constructor hasOwnProperty isPrototypeOf propertyIsEnumerable toLocaleString toString valueOf".split(" ");function Ia(a,b){for(var c,d,e=1;e<arguments.length;e++){d=arguments[e];for(c in d)a[c]=d[c];for(var g=0;g<Ha.length;g++)c=Ha[g],Object.prototype.hasOwnProperty.call(d,c)&&(a[c]=d[c])}};var Ja=y("Opera")||y("OPR"),z=y("Trident")||y("MSIE"),A=y("Edge"),B=y("Gecko")&&!(-1!=Aa.toLowerCase().indexOf("webkit")&&!y("Edge"))&&!(y("Trident")||y("MSIE"))&&!y("Edge"),C=-1!=Aa.toLowerCase().indexOf("webkit")&&!y("Edge"),D=y("Macintosh"),Ka=y("Windows"),La=y("Linux")||y("CrOS");function Ma(){var a=Aa;if(B)return/rv\:([^\);]+)(\)|;)/.exec(a);if(A)return/Edge\/([\d\.]+)/.exec(a);if(z)return/\b(?:MSIE|rv)[: ]([^\);]+)(\)|;)/.exec(a);if(C)return/WebKit\/(\S+)/.exec(a)}
function Na(){var a=l.document;return a?a.documentMode:void 0}var Oa=function(){if(Ja&&l.opera){var a;var b=l.opera.version;try{a=b()}catch(c){a=b}return a}a="";(b=Ma())&&(a=b?b[1]:"");return z&&(b=Na(),b>parseFloat(a))?String(b):a}(),Pa={};
function E(a){var b;if(!(b=Pa[a])){b=0;for(var c=ma(String(Oa)).split("."),d=ma(String(a)).split("."),e=Math.max(c.length,d.length),g=0;0==b&&g<e;g++){var h=c[g]||"",k=d[g]||"",n=RegExp("(\\d*)(\\D*)","g"),Za=RegExp("(\\d*)(\\D*)","g");do{var P=n.exec(h)||["","",""],Q=Za.exec(k)||["","",""];if(0==P[0].length&&0==Q[0].length)break;b=va(0==P[1].length?0:parseInt(P[1],10),0==Q[1].length?0:parseInt(Q[1],10))||va(0==P[2].length,0==Q[2].length)||va(P[2],Q[2])}while(0==b)}b=Pa[a]=0<=b}return b}
var Qa=l.document,F=Qa&&z?Na()||("CSS1Compat"==Qa.compatMode?parseInt(Oa,10):5):void 0;var Ra=!z||9<=Number(F);!B&&!z||z&&9<=Number(F)||B&&E("1.9.1");z&&E("9");function Sa(a,b,c){return Math.min(Math.max(a,b),c)}var Ta=Math.sign||function(a){return 0<a?1:0>a?-1:a};function G(a,b){this.x=m(a)?a:0;this.y=m(b)?b:0}f=G.prototype;f.clone=function(){return new G(this.x,this.y)};f.ceil=function(){this.x=Math.ceil(this.x);this.y=Math.ceil(this.y);return this};f.floor=function(){this.x=Math.floor(this.x);this.y=Math.floor(this.y);return this};f.round=function(){this.x=Math.round(this.x);this.y=Math.round(this.y);return this};f.translate=function(a,b){a instanceof G?(this.x+=a.x,this.y+=a.y):(this.x+=Number(a),r(b)&&(this.y+=b));return this};
f.scale=function(a,b){var c=r(b)?b:a;this.x*=a;this.y*=c;return this};function Ua(a){return a?new Va(H(a)):la||(la=new Va)}function Wa(a,b){Da(b,function(b,d){"style"==d?a.style.cssText=b:"class"==d?a.className=b:"for"==d?a.htmlFor=b:Xa.hasOwnProperty(d)?a.setAttribute(Xa[d],b):0==d.lastIndexOf("aria-",0)||0==d.lastIndexOf("data-",0)?a.setAttribute(d,b):a[d]=b})}
var Xa={cellpadding:"cellPadding",cellspacing:"cellSpacing",colspan:"colSpan",frameborder:"frameBorder",height:"height",maxlength:"maxLength",role:"role",rowspan:"rowSpan",type:"type",usemap:"useMap",valign:"vAlign",width:"width"};
function Ya(a){var b=a.scrollingElement?a.scrollingElement:C||"CSS1Compat"!=a.compatMode?a.body||a.documentElement:a.documentElement;a=a.parentWindow||a.defaultView;return z&&E("10")&&a.pageYOffset!=b.scrollTop?new G(b.scrollLeft,b.scrollTop):new G(a.pageXOffset||b.scrollLeft,a.pageYOffset||b.scrollTop)}function $a(a,b,c){return ab(document,arguments)}
function ab(a,b){var c=b[0],d=b[1];if(!Ra&&d&&(d.name||d.type)){c=["\x3c",c];d.name&&c.push(' name\x3d"',na(d.name),'"');if(d.type){c.push(' type\x3d"',na(d.type),'"');var e={};Ia(e,d);delete e.type;d=e}c.push("\x3e");c=c.join("")}c=a.createElement(c);d&&(q(d)?c.className=d:p(d)?c.className=d.join(" "):Wa(c,d));2<b.length&&bb(a,c,b,2);return c}
function bb(a,b,c,d){function e(c){c&&b.appendChild(q(c)?a.createTextNode(c):c)}for(;d<c.length;d++){var g=c[d];!ca(g)||ea(g)&&0<g.nodeType?e(g):x(cb(g)?za(g):g,e)}}function db(a){return a&&a.parentNode?a.parentNode.removeChild(a):null}function eb(a,b){if(!a||!b)return!1;if(a.contains&&1==b.nodeType)return a==b||a.contains(b);if("undefined"!=typeof a.compareDocumentPosition)return a==b||Boolean(a.compareDocumentPosition(b)&16);for(;b&&a!=b;)b=b.parentNode;return b==a}
function H(a){return 9==a.nodeType?a:a.ownerDocument||a.document}function cb(a){if(a&&"number"==typeof a.length){if(ea(a))return"function"==typeof a.item||"string"==typeof a.item;if(da(a))return"function"==typeof a.item}return!1}function Va(a){this.w=a||l.document||document}f=Va.prototype;f.lb=Ua;f.b=function(a){return q(a)?this.w.getElementById(a):a};f.za=function(a,b,c){return ab(this.w,arguments)};f.createElement=function(a){return this.w.createElement(a)};f.createTextNode=function(a){return this.w.createTextNode(String(a))};
f.appendChild=function(a,b){a.appendChild(b)};f.append=function(a,b){bb(H(a),a,arguments,1)};f.canHaveChildren=function(a){if(1!=a.nodeType)return!1;switch(a.tagName){case "APPLET":case "AREA":case "BASE":case "BR":case "COL":case "COMMAND":case "EMBED":case "FRAME":case "HR":case "IMG":case "INPUT":case "IFRAME":case "ISINDEX":case "KEYGEN":case "LINK":case "NOFRAMES":case "NOSCRIPT":case "META":case "OBJECT":case "PARAM":case "SCRIPT":case "SOURCE":case "STYLE":case "TRACK":case "WBR":return!1}return!0};
f.removeNode=db;f.contains=eb;function fb(a,b,c,d){this.top=a;this.right=b;this.bottom=c;this.left=d}f=fb.prototype;f.clone=function(){return new fb(this.top,this.right,this.bottom,this.left)};f.contains=function(a){return this&&a?a instanceof fb?a.left>=this.left&&a.right<=this.right&&a.top>=this.top&&a.bottom<=this.bottom:a.x>=this.left&&a.x<=this.right&&a.y>=this.top&&a.y<=this.bottom:!1};
f.expand=function(a,b,c,d){ea(a)?(this.top-=a.top,this.right+=a.right,this.bottom+=a.bottom,this.left-=a.left):(this.top-=a,this.right+=Number(b),this.bottom+=Number(c),this.left-=Number(d));return this};f.ceil=function(){this.top=Math.ceil(this.top);this.right=Math.ceil(this.right);this.bottom=Math.ceil(this.bottom);this.left=Math.ceil(this.left);return this};
f.floor=function(){this.top=Math.floor(this.top);this.right=Math.floor(this.right);this.bottom=Math.floor(this.bottom);this.left=Math.floor(this.left);return this};f.round=function(){this.top=Math.round(this.top);this.right=Math.round(this.right);this.bottom=Math.round(this.bottom);this.left=Math.round(this.left);return this};f.translate=function(a,b){a instanceof G?(this.left+=a.x,this.right+=a.x,this.top+=a.y,this.bottom+=a.y):(this.left+=a,this.right+=a,r(b)&&(this.top+=b,this.bottom+=b));return this};
f.scale=function(a,b){var c=r(b)?b:a;this.left*=a;this.right*=a;this.top*=c;this.bottom*=c;return this};function gb(a,b,c,d){this.left=a;this.top=b;this.width=c;this.height=d}f=gb.prototype;f.clone=function(){return new gb(this.left,this.top,this.width,this.height)};f.intersects=function(a){return this.left<=a.left+a.width&&a.left<=this.left+this.width&&this.top<=a.top+a.height&&a.top<=this.top+this.height};
f.contains=function(a){return a instanceof gb?this.left<=a.left&&this.left+this.width>=a.left+a.width&&this.top<=a.top&&this.top+this.height>=a.top+a.height:a.x>=this.left&&a.x<=this.left+this.width&&a.y>=this.top&&a.y<=this.top+this.height};f.distance=function(a){var b=a.x<this.left?this.left-a.x:Math.max(a.x-(this.left+this.width),0);a=a.y<this.top?this.top-a.y:Math.max(a.y-(this.top+this.height),0);return Math.sqrt(b*b+a*a)};
f.getCenter=function(){return new G(this.left+this.width/2,this.top+this.height/2)};f.ceil=function(){this.left=Math.ceil(this.left);this.top=Math.ceil(this.top);this.width=Math.ceil(this.width);this.height=Math.ceil(this.height);return this};f.floor=function(){this.left=Math.floor(this.left);this.top=Math.floor(this.top);this.width=Math.floor(this.width);this.height=Math.floor(this.height);return this};
f.round=function(){this.left=Math.round(this.left);this.top=Math.round(this.top);this.width=Math.round(this.width);this.height=Math.round(this.height);return this};f.translate=function(a,b){a instanceof G?(this.left+=a.x,this.top+=a.y):(this.left+=a,r(b)&&(this.top+=b));return this};f.scale=function(a,b){var c=r(b)?b:a;this.left*=a;this.width*=a;this.top*=c;this.height*=c;return this};function hb(a){hb[" "](a);return a}hb[" "]=aa;function ib(a,b){var c=H(a);return c.defaultView&&c.defaultView.getComputedStyle&&(c=c.defaultView.getComputedStyle(a,null))?c[b]||c.getPropertyValue(b)||"":""}function jb(a,b){return ib(a,b)||(a.currentStyle?a.currentStyle[b]:null)||a.style&&a.style[b]}
function kb(a){if(1==a.nodeType){var b;a:{try{b=a.getBoundingClientRect()}catch(c){b={left:0,top:0,right:0,bottom:0};break a}z&&a.ownerDocument.body&&(a=a.ownerDocument,b.left-=a.documentElement.clientLeft+a.body.clientLeft,b.top-=a.documentElement.clientTop+a.body.clientTop)}return new G(b.left,b.top)}b=a.changedTouches?a.changedTouches[0]:a;return new G(b.clientX,b.clientY)}
function lb(a,b){var c=a.style;"opacity"in c?c.opacity=b:"MozOpacity"in c?c.MozOpacity=b:"filter"in c&&(c.filter=""===b?"":"alpha(opacity\x3d"+100*Number(b)+")")}function mb(a){return"rtl"==jb(a,"direction")}var nb={thin:2,medium:4,thick:6};
function ob(a,b){if("none"==(a.currentStyle?a.currentStyle[b+"Style"]:null))return 0;var c=a.currentStyle?a.currentStyle[b+"Width"]:null,d;if(c in nb)d=nb[c];else if(/^\d+px?$/.test(c))d=parseInt(c,10);else{d=a.style.left;var e=a.runtimeStyle.left;a.runtimeStyle.left=a.currentStyle.left;a.style.left=c;c=a.style.pixelLeft;a.style.left=d;a.runtimeStyle.left=e;d=c}return d}
function pb(a){if(z&&!(9<=Number(F))){var b=ob(a,"borderLeft"),c=ob(a,"borderRight"),d=ob(a,"borderTop");a=ob(a,"borderBottom");return new fb(d,c,a,b)}b=ib(a,"borderLeftWidth");c=ib(a,"borderRightWidth");d=ib(a,"borderTopWidth");a=ib(a,"borderBottomWidth");return new fb(parseFloat(d),parseFloat(c),parseFloat(a),parseFloat(b))};function I(a,b,c,d,e,g){this.map=a;this.Yb=b;this.bounds=c||new google.maps.LatLngBounds(new google.maps.LatLng(-88,-179.999999999),new google.maps.LatLng(88,180));this.minZoom=d||0;this.rb=e||21;this.tileSize=new google.maps.Size(256,256);this.opacity=1;!0!==g&&this.map.overlayMapTypes.insertAt(0,this);this.gc=t(function(a,b,c){var d=this.map.getProjection(),e=Math.pow(2,a);a=256/e;e=256/e;return new google.maps.LatLngBounds(d.fromPointToLatLng(new google.maps.Point(b*a,(c+1)*e)),d.fromPointToLatLng(new google.maps.Point((b+
1)*a,c*e)))},this);this.maxZoom=21;this.tiles={}}
I.prototype.getTile=function(a,b){var c=1<<b,d=(a.x%c+c)%c,e=a.y;if(this.minZoom<=b&&b<=this.maxZoom&&0<=e&&e<c&&this.bounds.intersects(this.gc(b,d,e))){if(b<=this.rb)c=$a("img",{src:this.Yb(d,e,b),width:this.tileSize.width+"px",height:this.tileSize.height+"px",onerror:function(){this.src="https://maptilercdn.s3.amazonaws.com/none.png";return!0}});else var g=Math.pow(2,b-this.rb),h=Math.floor(d/g),k=Math.floor(e/g),n=0*g,c=$a("canvas",{width:256,height:256}),Za=c.getContext("2d"),P=$a("img",{src:this.Yb(h,
k,this.rb),width:this.tileSize.width+"px",height:this.tileSize.height+"px",onerror:function(){this.src="https://maptilercdn.s3.amazonaws.com/none.png";return!0},onload:function(){var a=P.naturalWidth||256;Za.drawImage(P,a*(d-g*h)/g-0,a*(e-g*k)/g-0,a/g+0,a/g+0,-n,-n,256+2*n,256+2*n)}});lb(c,this.opacity);var Q=b+"_"+a.x+"_"+a.y;this.tiles[Q]=c;c.tileKey=Q;return c}return document.createElement("div")};
I.prototype.releaseTile=function(a){delete this.tiles[a.tileKey];for(var b;b=a.firstChild;)a.removeChild(b);db(a)};I.prototype.setOpacity=function(a){this.opacity=a;Da(this.tiles,function(a){null!=a&&lb(a,this.opacity)},this)};v("klokantech.MapTilerMapType",I);v("klokantech.MapTilerMapType.prototype.tileSize",I.prototype.tileSize);v("klokantech.MapTilerMapType.prototype.minZoom",I.prototype.minZoom);v("klokantech.MapTilerMapType.prototype.maxZoom",I.prototype.maxZoom);
v("klokantech.MapTilerMapType.prototype.getTile",I.prototype.getTile);v("klokantech.MapTilerMapType.prototype.releaseTile",I.prototype.releaseTile);v("klokantech.MapTilerMapType.prototype.setOpacity",I.prototype.setOpacity);var qb;function rb(a,b,c){p(c)&&(c=c.join(" "));var d="aria-"+b;""===c||void 0==c?(qb||(qb={atomic:!1,autocomplete:"none",dropeffect:"none",haspopup:!1,live:"off",multiline:!1,multiselectable:!1,orientation:"vertical",readonly:!1,relevant:"additions text",required:!1,sort:"none",busy:!1,disabled:!1,hidden:!1,invalid:"false"}),c=qb,b in c?a.setAttribute(d,c[b]):a.removeAttribute(d)):a.setAttribute(d,c)};function sb(){return null};function J(){0!=tb&&(ub[fa(this)]=this);this.qa=this.qa;this.la=this.la}var tb=0,ub={};J.prototype.qa=!1;J.prototype.D=function(){if(!this.qa&&(this.qa=!0,this.g(),0!=tb)){var a=fa(this);delete ub[a]}};J.prototype.g=function(){if(this.la)for(;this.la.length;)this.la.shift()()};function vb(a){a&&"function"==typeof a.D&&a.D()}function wb(a){for(var b=0,c=arguments.length;b<c;++b){var d=arguments[b];ca(d)?wb.apply(null,d):vb(d)}};var xb=!z||9<=Number(F),yb=!z||9<=Number(F),zb=z&&!E("9");!C||E("528");B&&E("1.9b")||z&&E("8")||Ja&&E("9.5")||C&&E("528");B&&!E("8")||z&&E("9");function K(a,b){this.type=a;this.currentTarget=this.target=b;this.defaultPrevented=this.na=!1;this.Tb=!0}K.prototype.stopPropagation=function(){this.na=!0};K.prototype.preventDefault=function(){this.defaultPrevented=!0;this.Tb=!1};function Ab(a){a.preventDefault()};function L(a,b){K.call(this,a?a.type:"");this.relatedTarget=this.currentTarget=this.target=null;this.charCode=this.keyCode=this.button=this.screenY=this.screenX=this.clientY=this.clientX=this.offsetY=this.offsetX=0;this.metaKey=this.shiftKey=this.altKey=this.ctrlKey=!1;this.U=this.state=null;if(a){var c=this.type=a.type,d=a.changedTouches?a.changedTouches[0]:null;this.target=a.target||a.srcElement;this.currentTarget=b;var e=a.relatedTarget;if(e){if(B){var g;a:{try{hb(e.nodeName);g=!0;break a}catch(h){}g=
!1}g||(e=null)}}else"mouseover"==c?e=a.fromElement:"mouseout"==c&&(e=a.toElement);this.relatedTarget=e;null===d?(this.offsetX=C||void 0!==a.offsetX?a.offsetX:a.layerX,this.offsetY=C||void 0!==a.offsetY?a.offsetY:a.layerY,this.clientX=void 0!==a.clientX?a.clientX:a.pageX,this.clientY=void 0!==a.clientY?a.clientY:a.pageY,this.screenX=a.screenX||0,this.screenY=a.screenY||0):(this.clientX=void 0!==d.clientX?d.clientX:d.pageX,this.clientY=void 0!==d.clientY?d.clientY:d.pageY,this.screenX=d.screenX||0,
this.screenY=d.screenY||0);this.button=a.button;this.keyCode=a.keyCode||0;this.charCode=a.charCode||("keypress"==c?a.keyCode:0);this.ctrlKey=a.ctrlKey;this.altKey=a.altKey;this.shiftKey=a.shiftKey;this.metaKey=a.metaKey;this.state=a.state;this.U=a;a.defaultPrevented&&this.preventDefault()}}w(L,K);var Bb=[1,4,2];L.prototype.stopPropagation=function(){L.i.stopPropagation.call(this);this.U.stopPropagation?this.U.stopPropagation():this.U.cancelBubble=!0};
L.prototype.preventDefault=function(){L.i.preventDefault.call(this);var a=this.U;if(a.preventDefault)a.preventDefault();else if(a.returnValue=!1,zb)try{if(a.ctrlKey||112<=a.keyCode&&123>=a.keyCode)a.keyCode=-1}catch(b){}};var Cb="closure_listenable_"+(1E6*Math.random()|0),Db=0;function Eb(a,b,c,d,e){this.listener=a;this.eb=null;this.src=b;this.type=c;this.ya=!!d;this.Wa=e;this.key=++Db;this.va=this.Oa=!1}function Fb(a){a.va=!0;a.listener=null;a.eb=null;a.src=null;a.Wa=null};function Gb(a){this.src=a;this.u={};this.La=0}f=Gb.prototype;f.add=function(a,b,c,d,e){var g=a.toString();a=this.u[g];a||(a=this.u[g]=[],this.La++);var h=Hb(a,b,d,e);-1<h?(b=a[h],c||(b.Oa=!1)):(b=new Eb(b,this.src,g,!!d,e),b.Oa=c,a.push(b));return b};f.remove=function(a,b,c,d){a=a.toString();if(!(a in this.u))return!1;var e=this.u[a];b=Hb(e,b,c,d);return-1<b?(Fb(e[b]),Array.prototype.splice.call(e,b,1),0==e.length&&(delete this.u[a],this.La--),!0):!1};
function Ib(a,b){var c=b.type;c in a.u&&ya(a.u[c],b)&&(Fb(b),0==a.u[c].length&&(delete a.u[c],a.La--))}f.ua=function(a){a=a&&a.toString();var b=0,c;for(c in this.u)if(!a||c==a){for(var d=this.u[c],e=0;e<d.length;e++)++b,Fb(d[e]);delete this.u[c];this.La--}return b};f.Ca=function(a,b,c,d){a=this.u[a.toString()];var e=-1;a&&(e=Hb(a,b,c,d));return-1<e?a[e]:null};
f.hasListener=function(a,b){var c=m(a),d=c?a.toString():"",e=m(b);return Ea(this.u,function(a){for(var h=0;h<a.length;++h)if(!(c&&a[h].type!=d||e&&a[h].ya!=b))return!0;return!1})};function Hb(a,b,c,d){for(var e=0;e<a.length;++e){var g=a[e];if(!g.va&&g.listener==b&&g.ya==!!c&&g.Wa==d)return e}return-1};var Jb="closure_lm_"+(1E6*Math.random()|0),Kb={},Lb=0;
function M(a,b,c,d,e){if(p(b)){for(var g=0;g<b.length;g++)M(a,b[g],c,d,e);return null}c=Mb(c);if(a&&a[Cb])a=a.l(b,c,d,e);else{if(!b)throw Error("Invalid event type");var g=!!d,h=Nb(a);h||(a[Jb]=h=new Gb(a));c=h.add(b,c,!1,d,e);if(!c.eb){d=Ob();c.eb=d;d.src=a;d.listener=c;if(a.addEventListener)a.addEventListener(b.toString(),d,g);else if(a.attachEvent)a.attachEvent(Pb(b.toString()),d);else throw Error("addEventListener and attachEvent are unavailable.");Lb++}a=c}return a}
function Ob(){var a=Qb,b=yb?function(c){return a.call(b.src,b.listener,c)}:function(c){c=a.call(b.src,b.listener,c);if(!c)return c};return b}function Rb(a,b,c,d,e){if(p(b))for(var g=0;g<b.length;g++)Rb(a,b[g],c,d,e);else c=Mb(c),a&&a[Cb]?a.Na(b,c,d,e):a&&(a=Nb(a))&&(b=a.Ca(b,c,!!d,e))&&N(b)}
function N(a){if(!r(a)&&a&&!a.va){var b=a.src;if(b&&b[Cb])Ib(b.T,a);else{var c=a.type,d=a.eb;b.removeEventListener?b.removeEventListener(c,d,a.ya):b.detachEvent&&b.detachEvent(Pb(c),d);Lb--;(c=Nb(b))?(Ib(c,a),0==c.La&&(c.src=null,b[Jb]=null)):Fb(a)}}}function Pb(a){return a in Kb?Kb[a]:Kb[a]="on"+a}function Sb(a,b,c,d){var e=!0;if(a=Nb(a))if(b=a.u[b.toString()])for(b=b.concat(),a=0;a<b.length;a++){var g=b[a];g&&g.ya==c&&!g.va&&(g=Tb(g,d),e=e&&!1!==g)}return e}
function Tb(a,b){var c=a.listener,d=a.Wa||a.src;a.Oa&&N(a);return c.call(d,b)}
function Qb(a,b){if(a.va)return!0;if(!yb){var c;if(!(c=b))a:{c=["window","event"];for(var d=l,e;e=c.shift();)if(null!=d[e])d=d[e];else{c=null;break a}c=d}e=c;c=new L(e,this);d=!0;if(!(0>e.keyCode||void 0!=e.returnValue)){a:{var g=!1;if(0==e.keyCode)try{e.keyCode=-1;break a}catch(n){g=!0}if(g||void 0==e.returnValue)e.returnValue=!0}e=[];for(g=c.currentTarget;g;g=g.parentNode)e.push(g);for(var g=a.type,h=e.length-1;!c.na&&0<=h;h--){c.currentTarget=e[h];var k=Sb(e[h],g,!0,c),d=d&&k}for(h=0;!c.na&&h<
e.length;h++)c.currentTarget=e[h],k=Sb(e[h],g,!1,c),d=d&&k}return d}return Tb(a,new L(b,this))}function Nb(a){a=a[Jb];return a instanceof Gb?a:null}var Ub="__closure_events_fn_"+(1E9*Math.random()>>>0);function Mb(a){if(da(a))return a;a[Ub]||(a[Ub]=function(b){return a.handleEvent(b)});return a[Ub]};function O(){J.call(this);this.T=new Gb(this);this.ac=this;this.cb=null}w(O,J);O.prototype[Cb]=!0;f=O.prototype;f.ub=function(a){this.cb=a};f.addEventListener=function(a,b,c,d){M(this,a,b,c,d)};f.removeEventListener=function(a,b,c,d){Rb(this,a,b,c,d)};
f.dispatchEvent=function(a){var b,c=this.cb;if(c)for(b=[];c;c=c.cb)b.push(c);var c=this.ac,d=a.type||a;if(q(a))a=new K(a,c);else if(a instanceof K)a.target=a.target||c;else{var e=a;a=new K(d,c);Ia(a,e)}var e=!0,g;if(b)for(var h=b.length-1;!a.na&&0<=h;h--)g=a.currentTarget=b[h],e=Vb(g,d,!0,a)&&e;a.na||(g=a.currentTarget=c,e=Vb(g,d,!0,a)&&e,a.na||(e=Vb(g,d,!1,a)&&e));if(b)for(h=0;!a.na&&h<b.length;h++)g=a.currentTarget=b[h],e=Vb(g,d,!1,a)&&e;return e};
f.g=function(){O.i.g.call(this);this.T&&this.T.ua(void 0);this.cb=null};f.l=function(a,b,c,d){return this.T.add(String(a),b,!1,c,d)};f.Na=function(a,b,c,d){return this.T.remove(String(a),b,c,d)};function Vb(a,b,c,d){b=a.T.u[String(b)];if(!b)return!0;b=b.concat();for(var e=!0,g=0;g<b.length;++g){var h=b[g];if(h&&!h.va&&h.ya==c){var k=h.listener,n=h.Wa||h.src;h.Oa&&Ib(a.T,h);e=!1!==k.call(n,d)&&e}}return e&&0!=d.Tb}f.Ca=function(a,b,c,d){return this.T.Ca(String(a),b,c,d)};
f.hasListener=function(a,b){return this.T.hasListener(m(a)?String(a):void 0,b)};function Wb(a,b){O.call(this);this.ia=a||1;this.wa=b||l;this.hb=t(this.sc,this);this.ob=u()}w(Wb,O);f=Wb.prototype;f.enabled=!1;f.M=null;f.setInterval=function(a){this.ia=a;this.M&&this.enabled?(this.stop(),this.start()):this.M&&this.stop()};
f.sc=function(){if(this.enabled){var a=u()-this.ob;0<a&&a<.8*this.ia?this.M=this.wa.setTimeout(this.hb,this.ia-a):(this.M&&(this.wa.clearTimeout(this.M),this.M=null),this.dispatchEvent("tick"),this.enabled&&(this.M=this.wa.setTimeout(this.hb,this.ia),this.ob=u()))}};f.start=function(){this.enabled=!0;this.M||(this.M=this.wa.setTimeout(this.hb,this.ia),this.ob=u())};f.stop=function(){this.enabled=!1;this.M&&(this.wa.clearTimeout(this.M),this.M=null)};f.g=function(){Wb.i.g.call(this);this.stop();delete this.wa};function Xb(a){if(a.classList)return a.classList;a=a.className;return q(a)&&a.match(/\S+/g)||[]}function Yb(a,b){var c;a.classList?c=a.classList.contains(b):(c=Xb(a),c=0<=wa(c,b));return c}function Zb(a,b){a.classList?a.classList.add(b):Yb(a,b)||(a.className+=0<a.className.length?" "+b:b)}function $b(a,b){a.classList?a.classList.remove(b):Yb(a,b)&&(a.className=xa(Xb(a),function(a){return a!=b}).join(" "))};function ac(a,b,c,d,e){if(!(z||A||C&&E("525")))return!0;if(D&&e)return bc(a);if(e&&!d)return!1;r(b)&&(b=cc(b));if(!c&&(17==b||18==b||D&&91==b))return!1;if((C||A)&&d&&c)switch(a){case 220:case 219:case 221:case 192:case 186:case 189:case 187:case 188:case 190:case 191:case 192:case 222:return!1}if(z&&d&&b==a)return!1;switch(a){case 13:return!0;case 27:return!(C||A)}return bc(a)}
function bc(a){if(48<=a&&57>=a||96<=a&&106>=a||65<=a&&90>=a||(C||A)&&0==a)return!0;switch(a){case 32:case 43:case 63:case 64:case 107:case 109:case 110:case 111:case 186:case 59:case 189:case 187:case 61:case 188:case 190:case 191:case 192:case 222:case 219:case 220:case 221:return!0;default:return!1}}function cc(a){if(B)a=dc(a);else if(D&&C)a:switch(a){case 93:a=91;break a}return a}
function dc(a){switch(a){case 61:return 187;case 59:return 186;case 173:return 189;case 224:return 91;case 0:return 224;default:return a}};function ec(a,b){O.call(this);a&&(this.Za&&this.detach(),this.h=a,this.Ya=M(this.h,"keypress",this,b),this.nb=M(this.h,"keydown",this.mb,b,this),this.Za=M(this.h,"keyup",this.hc,b,this))}w(ec,O);f=ec.prototype;f.h=null;f.Ya=null;f.nb=null;f.Za=null;f.H=-1;f.da=-1;f.gb=!1;
var fc={3:13,12:144,63232:38,63233:40,63234:37,63235:39,63236:112,63237:113,63238:114,63239:115,63240:116,63241:117,63242:118,63243:119,63244:120,63245:121,63246:122,63247:123,63248:44,63272:46,63273:36,63275:35,63276:33,63277:34,63289:144,63302:45},gc={Up:38,Down:40,Left:37,Right:39,Enter:13,F1:112,F2:113,F3:114,F4:115,F5:116,F6:117,F7:118,F8:119,F9:120,F10:121,F11:122,F12:123,"U+007F":46,Home:36,End:35,PageUp:33,PageDown:34,Insert:45},hc=z||A||C&&E("525"),ic=D&&B;f=ec.prototype;
f.mb=function(a){if(C||A)if(17==this.H&&!a.ctrlKey||18==this.H&&!a.altKey||D&&91==this.H&&!a.metaKey)this.da=this.H=-1;-1==this.H&&(a.ctrlKey&&17!=a.keyCode?this.H=17:a.altKey&&18!=a.keyCode?this.H=18:a.metaKey&&91!=a.keyCode&&(this.H=91));hc&&!ac(a.keyCode,this.H,a.shiftKey,a.ctrlKey,a.altKey)?this.handleEvent(a):(this.da=cc(a.keyCode),ic&&(this.gb=a.altKey))};f.hc=function(a){this.da=this.H=-1;this.gb=a.altKey};
f.handleEvent=function(a){var b=a.U,c,d,e=b.altKey;z&&"keypress"==a.type?(c=this.da,d=13!=c&&27!=c?b.keyCode:0):(C||A)&&"keypress"==a.type?(c=this.da,d=0<=b.charCode&&63232>b.charCode&&bc(c)?b.charCode:0):Ja&&!C?(c=this.da,d=bc(c)?b.keyCode:0):(c=b.keyCode||this.da,d=b.charCode||0,ic&&(e=this.gb),D&&63==d&&224==c&&(c=191));var g=c=cc(c),h=b.keyIdentifier;c?63232<=c&&c in fc?g=fc[c]:25==c&&a.shiftKey&&(g=9):h&&h in gc&&(g=gc[h]);a=g==this.H;this.H=g;b=new jc(g,d,a,b);b.altKey=e;this.dispatchEvent(b)};
f.b=function(){return this.h};f.detach=function(){this.Ya&&(N(this.Ya),N(this.nb),N(this.Za),this.Za=this.nb=this.Ya=null);this.h=null;this.da=this.H=-1};f.g=function(){ec.i.g.call(this);this.detach()};function jc(a,b,c,d){L.call(this,d);this.type="key";this.keyCode=a;this.charCode=b;this.repeat=c}w(jc,L);function kc(a,b){O.call(this);var c=this.h=a,c=ea(c)&&1==c.nodeType?this.h:this.h?this.h.body:null;this.nc=!!c&&mb(c);this.Mb=M(this.h,B?"DOMMouseScroll":"mousewheel",this,b)}w(kc,O);
kc.prototype.handleEvent=function(a){var b=0,c=0,d=0;a=a.U;if("mousewheel"==a.type){c=1;if(z||C&&(Ka||E("532.0")))c=40;d=lc(-a.wheelDelta,c);m(a.wheelDeltaX)?(b=lc(-a.wheelDeltaX,c),c=lc(-a.wheelDeltaY,c)):c=d}else d=a.detail,100<d?d=3:-100>d&&(d=-3),m(a.axis)&&a.axis===a.HORIZONTAL_AXIS?b=d:c=d;r(this.Nb)&&(b=Sa(b,-this.Nb,this.Nb));r(this.Ob)&&(c=Sa(c,-this.Ob,this.Ob));this.nc&&(b=-b);b=new mc(d,a,b,c);this.dispatchEvent(b)};function lc(a,b){return C&&(D||La)&&0!=a%b?a:a/b}
kc.prototype.g=function(){kc.i.g.call(this);N(this.Mb);this.Mb=null};function mc(a,b,c,d){L.call(this,b);this.type="mousewheel";this.detail=a;this.deltaX=c;this.deltaY=d}w(mc,L);function R(){O.call(this);this.f=S;this.endTime=this.startTime=null}w(R,O);var S=0;R.prototype.bb=function(){this.v("begin")};R.prototype.ta=function(){this.v("end")};R.prototype.v=function(a){this.dispatchEvent(a)};function T(){R.call(this);this.S=[]}w(T,R);T.prototype.add=function(a){0<=wa(this.S,a)||(this.S.push(a),M(a,"finish",this.Rb,!1,this))};T.prototype.remove=function(a){ya(this.S,a)&&Rb(a,"finish",this.Rb,!1,this)};T.prototype.g=function(){x(this.S,function(a){a.D()});this.S.length=0;T.i.g.call(this)};function nc(){T.call(this);this.kb=0}w(nc,T);
nc.prototype.play=function(a){if(0==this.S.length)return!1;if(a||this.f==S)this.kb=0,this.bb();else if(1==this.f)return!1;this.v("play");-1==this.f&&this.v("resume");var b=-1==this.f&&!a;this.startTime=u();this.endTime=null;this.f=1;x(this.S,function(c){b&&-1!=c.f||c.play(a)});return!0};nc.prototype.pause=function(){1==this.f&&(x(this.S,function(a){1==a.f&&a.pause()}),this.f=-1,this.v("pause"))};
nc.prototype.stop=function(a){x(this.S,function(b){b.f==S||b.stop(a)});this.f=S;this.endTime=u();this.v("stop");this.ta()};nc.prototype.Rb=function(){this.kb++;this.kb==this.S.length&&(this.endTime=u(),this.f=S,this.v("finish"),this.ta())};function oc(a){J.call(this);this.Ea=a;this.Ga={}}w(oc,J);var pc=[];f=oc.prototype;f.l=function(a,b,c,d){p(b)||(b&&(pc[0]=b.toString()),b=pc);for(var e=0;e<b.length;e++){var g=M(a,b[e],c||this.handleEvent,d||!1,this.Ea||this);if(!g)break;this.Ga[g.key]=g}return this};
f.Na=function(a,b,c,d,e){if(p(b))for(var g=0;g<b.length;g++)this.Na(a,b[g],c,d,e);else c=c||this.handleEvent,e=e||this.Ea||this,c=Mb(c),d=!!d,b=a&&a[Cb]?a.Ca(b,c,d,e):a?(a=Nb(a))?a.Ca(b,c,d,e):null:null,b&&(N(b),delete this.Ga[b.key]);return this};f.ua=function(){Da(this.Ga,function(a,b){this.Ga.hasOwnProperty(b)&&N(a)},this);this.Ga={}};f.g=function(){oc.i.g.call(this);this.ua()};f.handleEvent=function(){throw Error("EventHandler.handleEvent not implemented");};function qc(a){var b=a.offsetLeft,c=a.offsetParent;c||"fixed"!=jb(a,"position")||(c=H(a).documentElement);if(!c)return b;if(B)var d=pb(c),b=b+d.left;else 8<=Number(F)&&!(9<=Number(F))&&(d=pb(c),b-=d.left);return mb(c)?c.clientWidth-(b+a.offsetWidth):b};function rc(a,b,c){O.call(this);this.target=a;this.handle=b||a;this.Lb=c||new gb(NaN,NaN,NaN,NaN);this.w=H(a);this.R=new oc(this);a=ka(vb,this.R);this.qa?a.call(void 0):(this.la||(this.la=[]),this.la.push(m(void 0)?t(a,void 0):a));this.deltaY=this.deltaX=this.Wb=this.Vb=this.screenY=this.screenX=this.clientY=this.clientX=0;this.Ta=!0;this.fa=!1;this.Sb=!0;this.Hb=0;this.oa=this.lc=!1;M(this.handle,["touchstart","mousedown"],this.Ub,!1,this)}w(rc,O);var sc=l.document&&l.document.documentElement&&!!l.document.documentElement.setCapture;
f=rc.prototype;f.$=function(a){this.oa=a};f.ga=function(){return this.R};f.g=function(){rc.i.g.call(this);Rb(this.handle,["touchstart","mousedown"],this.Ub,!1,this);this.R.ua();sc&&this.w.releaseCapture();this.handle=this.target=null};function tc(a){m(a.X)||(a.X=mb(a.target));return a.X}
f.Ub=function(a){var b="mousedown"==a.type;if(!this.Ta||this.fa||b&&(!(xb?0==a.U.button:"click"==a.type||a.U.button&Bb[0])||C&&D&&a.ctrlKey))this.dispatchEvent("earlycancel");else{if(0==this.Hb)if(this.dispatchEvent(new uc("start",this,a.clientX,a.clientY)))this.fa=!0,this.Sb&&a.preventDefault();else return;else this.Sb&&a.preventDefault();var b=this.w,c=b.documentElement,d=!sc;this.R.l(b,["touchmove","mousemove"],this.jc,d);this.R.l(b,["touchend","mouseup"],this.Ua,d);sc?(c.setCapture(!1),this.R.l(c,
"losecapture",this.Ua)):this.R.l(b?b.parentWindow||b.defaultView:window,"blur",this.Ua);z&&this.lc&&this.R.l(b,"dragstart",Ab);this.rc&&this.R.l(this.rc,"scroll",this.qc,d);this.clientX=this.Vb=a.clientX;this.clientY=this.Wb=a.clientY;this.screenX=a.screenX;this.screenY=a.screenY;this.deltaX=this.oa?qc(this.target):this.target.offsetLeft;this.deltaY=this.target.offsetTop;a=Ua(this.w);this.tb=Ya(a.w)}};
f.Ua=function(a){this.R.ua();sc&&this.w.releaseCapture();this.fa?(this.fa=!1,this.dispatchEvent(new uc("end",this,a.clientX,a.clientY,0,vc(this,this.deltaX),wc(this,this.deltaY)))):this.dispatchEvent("earlycancel")};
f.jc=function(a){if(this.Ta){var b=(this.oa&&tc(this)?-1:1)*(a.clientX-this.clientX),c=a.clientY-this.clientY;this.clientX=a.clientX;this.clientY=a.clientY;this.screenX=a.screenX;this.screenY=a.screenY;if(!this.fa){var d=this.Vb-this.clientX,e=this.Wb-this.clientY;if(d*d+e*e>this.Hb)if(this.dispatchEvent(new uc("start",this,a.clientX,a.clientY)))this.fa=!0;else{this.qa||this.Ua(a);return}}c=xc(this,b,c);b=c.x;c=c.y;this.fa&&this.dispatchEvent(new uc("beforedrag",this,a.clientX,a.clientY,0,b,c))&&
(yc(this,a,b,c),a.preventDefault())}};function xc(a,b,c){var d;d=Ua(a.w);d=Ya(d.w);b+=d.x-a.tb.x;c+=d.y-a.tb.y;a.tb=d;a.deltaX+=b;a.deltaY+=c;return new G(vc(a,a.deltaX),wc(a,a.deltaY))}f.qc=function(a){var b=xc(this,0,0);a.clientX=this.clientX;a.clientY=this.clientY;yc(this,a,b.x,b.y)};function yc(a,b,c,d){a.ib(c,d);a.dispatchEvent(new uc("drag",a,b.clientX,b.clientY,0,c,d))}
function vc(a,b){var c=a.Lb,d=isNaN(c.left)?null:c.left,c=isNaN(c.width)?0:c.width;return Math.min(null!=d?d+c:Infinity,Math.max(null!=d?d:-Infinity,b))}function wc(a,b){var c=a.Lb,d=isNaN(c.top)?null:c.top,c=isNaN(c.height)?0:c.height;return Math.min(null!=d?d+c:Infinity,Math.max(null!=d?d:-Infinity,b))}f.ib=function(a,b){this.oa&&tc(this)?this.target.style.right=a+"px":this.target.style.left=a+"px";this.target.style.top=b+"px"};
function uc(a,b,c,d,e,g,h){K.call(this,a);this.clientX=c;this.clientY=d;this.left=m(g)?g:b.deltaX;this.top=m(h)?h:b.deltaY;this.jb=b}w(uc,K);function zc(a,b,c){J.call(this);this.qb=a;this.ia=b||0;this.Ea=c;this.bc=t(this.cc,this)}w(zc,J);f=zc.prototype;f.W=0;f.g=function(){zc.i.g.call(this);this.stop();delete this.qb;delete this.Ea};f.start=function(a){this.stop();var b=this.bc;a=m(a)?a:this.ia;if(!da(b))if(b&&"function"==typeof b.handleEvent)b=t(b.handleEvent,b);else throw Error("Invalid listener argument");this.W=2147483647<Number(a)?-1:l.setTimeout(b,a||0)};f.stop=function(){0!=this.W&&l.clearTimeout(this.W);this.W=0};
f.cc=function(){this.W=0;this.qb&&this.qb.call(this.Ea)};var Ga={},Ac=null;function Bc(a){a=fa(a);delete Ga[a];Fa()&&Ac&&Ac.stop()}function Cc(){Ac||(Ac=new zc(function(){Dc()},20));var a=Ac;0!=a.W||a.start()}function Dc(){var a=u();Da(Ga,function(b){Ec(b,a)});Fa()||Cc()};function Fc(a,b,c,d){R.call(this);if(!p(a)||!p(b))throw Error("Start and end parameters must be arrays");if(a.length!=b.length)throw Error("Start and end points must be the same length");this.Ka=a;this.ec=b;this.duration=c;this.zb=d;this.coords=[];this.oa=!1;this.K=0}w(Fc,R);f=Fc.prototype;f.$=function(a){this.oa=a};
f.play=function(a){if(a||this.f==S)this.K=0,this.coords=this.Ka;else if(1==this.f)return!1;Bc(this);this.startTime=a=u();-1==this.f&&(this.startTime-=this.duration*this.K);this.endTime=this.startTime+this.duration;this.K||this.bb();this.v("play");-1==this.f&&this.v("resume");this.f=1;var b=fa(this);b in Ga||(Ga[b]=this);Cc();Ec(this,a);return!0};f.stop=function(a){Bc(this);this.f=S;a&&(this.K=1);Gc(this,this.K);this.v("stop");this.ta()};f.pause=function(){1==this.f&&(Bc(this),this.f=-1,this.v("pause"))};
f.g=function(){this.f==S||this.stop(!1);this.v("destroy");Fc.i.g.call(this)};function Ec(a,b){a.K=(b-a.startTime)/(a.endTime-a.startTime);1<=a.K&&(a.K=1);Gc(a,a.K);1==a.K?(a.f=S,Bc(a),a.v("finish"),a.ta()):1==a.f&&a.sb()}function Gc(a,b){da(a.zb)&&(b=a.zb(b));a.coords=Array(a.Ka.length);for(var c=0;c<a.Ka.length;c++)a.coords[c]=(a.ec[c]-a.Ka[c])*b+a.Ka[c]}f.sb=function(){this.v("animate")};f.v=function(a){this.dispatchEvent(new Hc(a,this))};
function Hc(a,b){K.call(this,a);this.coords=b.coords;this.x=b.coords[0];this.y=b.coords[1];this.z=b.coords[2];this.duration=b.duration;this.K=b.K;this.state=b.f}w(Hc,K);function U(a,b,c,d,e){Fc.call(this,b,c,d,e);this.element=a}w(U,Fc);f=U.prototype;f.xa=aa;f.ja=function(){m(this.X)||(this.X=mb(this.element));return this.X};f.sb=function(){this.xa();U.i.sb.call(this)};f.ta=function(){this.xa();U.i.ta.call(this)};f.bb=function(){this.xa();U.i.bb.call(this)};function Ic(a,b,c,d,e){if(2!=b.length||2!=c.length)throw Error("Start and end points must be 2D");U.apply(this,arguments)}w(Ic,U);
Ic.prototype.xa=function(){var a=this.oa&&this.ja()?"right":"left";this.element.style[a]=Math.round(this.coords[0])+"px";this.element.style.top=Math.round(this.coords[1])+"px"};function Jc(a,b,c,d,e){U.call(this,a,[b],[c],d,e)}w(Jc,U);Jc.prototype.xa=function(){this.element.style.width=Math.round(this.coords[0])+"px"};function Kc(a,b,c,d,e){U.call(this,a,[b],[c],d,e)}w(Kc,U);Kc.prototype.xa=function(){this.element.style.height=Math.round(this.coords[0])+"px"};function V(){}V.fc=function(){return V.Kb?V.Kb:V.Kb=new V};V.prototype.pc=0;function W(a){O.call(this);this.ra=a||Ua();this.X=Lc;this.W=null;this.ha=!1;this.h=null;this.ba=void 0;this.Qa=this.Ra=this.Ha=null;this.Zb=!1}w(W,O);W.prototype.kc=V.fc();var Lc=null;f=W.prototype;f.getId=function(){return this.W||(this.W=":"+(this.kc.pc++).toString(36))};f.b=function(){return this.h};f.ga=function(){this.ba||(this.ba=new oc(this));return this.ba};f.getParent=function(){return this.Ha};f.ub=function(a){if(this.Ha&&this.Ha!=a)throw Error("Method not supported");W.i.ub.call(this,a)};
f.lb=function(){return this.ra};f.za=function(){this.h=this.ra.createElement("DIV")};function Mc(a,b){if(a.ha)throw Error("Component already rendered");if(b){a.Zb=!0;var c=H(b);a.ra&&a.ra.w==c||(a.ra=Ua(b));a.Sa(b);a.Va()}else throw Error("Invalid element to decorate");}f.Sa=function(a){this.h=a};f.Va=function(){this.ha=!0;Nc(this,function(a){!a.ha&&a.b()&&a.Va()})};f.Ba=function(){Nc(this,function(a){a.ha&&a.Ba()});this.ba&&this.ba.ua();this.ha=!1};
f.g=function(){this.ha&&this.Ba();this.ba&&(this.ba.D(),delete this.ba);Nc(this,function(a){a.D()});!this.Zb&&this.h&&db(this.h);this.Ha=this.h=this.Qa=this.Ra=null;W.i.g.call(this)};f.ja=function(){null==this.X&&(this.X=mb(this.ha?this.h:this.ra.w.body));return this.X};function Nc(a,b){a.Ra&&x(a.Ra,b,void 0)}
f.removeChild=function(a,b){if(a){var c=q(a)?a:a.getId(),d;this.Qa&&c?(d=this.Qa,d=(null!==d&&c in d?d[c]:void 0)||null):d=null;a=d;if(c&&a){d=this.Qa;c in d&&delete d[c];ya(this.Ra,a);b&&(a.Ba(),a.h&&db(a.h));c=a;if(null==c)throw Error("Unable to set parent component");c.Ha=null;W.i.ub.call(c,null)}}if(!a)throw Error("Child is not in parent component");return a};function Oc(){O.call(this)}w(Oc,O);f=Oc.prototype;f.pa=0;f.N=0;f.J=100;f.F=0;f.Y=1;f.B=!1;f.ka=!1;f.ea=function(a){a=X(this,a);this.pa!=a&&(this.pa=a+this.F>this.J?this.J-this.F:a<this.N?this.N:a,this.B||this.ka||this.dispatchEvent("change"))};f.s=function(){return X(this,this.pa)};f.Ia=function(a){a=X(this,a);this.F!=a&&(this.F=0>a?0:this.pa+a>this.J?this.J-this.pa:a,this.B||this.ka||this.dispatchEvent("change"))};f.V=function(){var a=this.F;return null==this.Y?a:Math.round(a/this.Y)*this.Y};
f.fb=function(a){if(this.N!=a){var b=this.B;this.B=!0;this.N=a;a+this.F>this.J&&(this.F=this.J-this.N);a>this.pa&&this.ea(a);a>this.J&&(this.F=0,this.Ja(a),this.ea(a));(this.B=b)||this.ka||this.dispatchEvent("change")}};f.o=function(){return X(this,this.N)};f.Ja=function(a){a=X(this,a);if(this.J!=a){var b=this.B;this.B=!0;this.J=a;a<this.pa+this.F&&this.ea(a-this.F);a<this.N&&(this.F=0,this.fb(a),this.ea(this.J));a<this.N+this.F&&(this.F=this.J-this.N);(this.B=b)||this.ka||this.dispatchEvent("change")}};
f.m=function(){return X(this,this.J)};f.Da=function(){return this.Y};f.vb=function(a){this.Y!=a&&(this.Y=a,a=this.B,this.B=!0,this.Ja(this.m()),this.Ia(this.V()),this.ea(this.s()),(this.B=a)||this.ka||this.dispatchEvent("change"))};function X(a,b){return null==a.Y?b:a.N+Math.round((b-a.N)/a.Y)*a.Y};function Y(a,b){W.call(this,a);this.Ab=null;this.c=new Oc;this.oc=b||sb;M(this.c,"change",this.Eb,!1,this)}w(Y,W);f=Y.prototype;f.C="horizontal";f.Xa=!1;f.Qb=!1;f.P=10;f.ab=0;f.mc=!0;f.Pb=0;f.$b=1E3;f.Ta=!0;f.G=!1;f.za=function(){Y.i.za.call(this);var a=this.lb().za("DIV",Pc(this.C));this.Sa(a)};
f.Sa=function(a){Y.i.Sa.call(this,a);Zb(a,Pc(this.C));a=this.b();var b;var c,d,e;b=document;b=a||b;if(b.querySelectorAll&&b.querySelector)b=b.querySelectorAll(".goog-slider-thumb");else if(b.getElementsByClassName){var g=b.getElementsByClassName("goog-slider-thumb");b=g}else{g=b.getElementsByTagName("*");e={};for(c=d=0;b=g[c];c++){var h=b.className,k;if(k="function"==typeof h.split)k=0<=wa(h.split(/\s+/),"goog-slider-thumb");k&&(e[d++]=b)}e.length=d;b=e}b=b[0];b||(b=this.lb().za("DIV","goog-slider-thumb"),
b.setAttribute("role","button"),a.appendChild(b));this.a=this.A=b;this.b().setAttribute("role","slider");Qc(this)};
f.Va=function(){Y.i.Va.call(this);this.O=new rc(this.a);this.aa=new rc(this.A);this.O.$(this.G);this.aa.$(this.G);this.O.ib=this.aa.ib=aa;this.Fa=new ec(this.b());this.ga().l(this.O,"beforedrag",this.Cb).l(this.aa,"beforedrag",this.Cb).l(this.O,["start","end"],this.Fb).l(this.aa,["start","end"],this.Fb).l(this.Fa,"key",this.mb).l(this.b(),"click",this.Db).l(this.b(),"mousedown",this.Db);this.mc&&(this.sa||(this.sa=new kc(this.b())),this.ga().l(this.sa,"mousewheel",this.ic));this.b().tabIndex=0;Rc(this)};
f.Ba=function(){Y.i.Ba.call(this);wb(this.O,this.aa,this.Fa,this.sa)};f.Cb=function(a){var b=a.jb==this.O?this.a:this.A,c;"vertical"==this.C?(c=this.b().clientHeight-b.offsetHeight,c=(c-a.top)/c*(this.m()-this.o())+this.o()):c=a.left/(this.b().clientWidth-b.offsetWidth)*(this.m()-this.o())+this.o();c=a.jb==this.O?Math.min(Math.max(c,this.o()),this.s()+this.V()):Math.min(Math.max(c,this.s()),this.m());Sc(this,b,c)};
f.Fb=function(a){var b="start"==a.type,c=this.b();b?Zb(c,"goog-slider-dragging"):$b(c,"goog-slider-dragging");c=a.target.handle;b?Zb(c,"goog-slider-thumb-dragging"):$b(c,"goog-slider-thumb-dragging");a=a.jb==this.O;b?(this.dispatchEvent("e"),this.dispatchEvent(a?"a":"c")):(this.dispatchEvent("f"),this.dispatchEvent(a?"b":"d"))};
f.mb=function(a){var b=!0;switch(a.keyCode){case 36:Tc(this,this.o());break;case 35:Tc(this,this.m());break;case 33:Uc(this,this.P);break;case 34:Uc(this,-this.P);break;case 37:var c=this.G&&this.ja()?1:-1;Uc(this,a.shiftKey?c*this.P:c*this.Ma);break;case 40:Uc(this,a.shiftKey?-this.P:-this.Ma);break;case 39:c=this.G&&this.ja()?-1:1;Uc(this,a.shiftKey?c*this.P:c*this.Ma);break;case 38:Uc(this,a.shiftKey?this.P:this.Ma);break;default:b=!1}b&&a.preventDefault()};
f.Db=function(a){this.b().focus&&this.b().focus();var b=a.target;eb(this.a,b)||eb(this.A,b)||(b="click"==a.type,b&&u()<this.Pb+this.$b||(b||(this.Pb=u()),this.Qb?Tc(this,Vc(this,a)):(this.wb(a),this.L=Wc(this,Vc(this,a)),this.Jb="vertical"==this.C?this.$a<this.L.offsetTop:this.$a>Xc(this,this.L)+this.L.offsetWidth,a=H(this.b()),this.ga().l(a,"mouseup",this.Xb,!0).l(this.b(),"mousemove",this.wb),this.ca||(this.ca=new Wb(200),this.ga().l(this.ca,"tick",this.Gb)),this.Gb(),this.ca.start())))};
f.ic=function(a){Uc(this,(0<a.detail?-1:1)*this.Ma);a.preventDefault()};f.Gb=function(){var a;if("vertical"==this.C){var b=this.$a,c=this.L.offsetTop;this.Jb?b<c&&(a=Z(this,this.L)+this.P):b>c+this.L.offsetHeight&&(a=Z(this,this.L)-this.P)}else b=this.$a,c=Xc(this,this.L),this.Jb?b>c+this.L.offsetWidth&&(a=Z(this,this.L)+this.P):b<c&&(a=Z(this,this.L)-this.P);m(a)&&Sc(this,this.L,a)};
f.Xb=function(){this.ca&&this.ca.stop();var a=H(this.b());this.ga().Na(a,"mouseup",this.Xb,!0).Na(this.b(),"mousemove",this.wb)};function Yc(a,b){var c,d=a.b();c=kb(b);d=kb(d);c=new G(c.x-d.x,c.y-d.y);return"vertical"==a.C?c.y:a.G&&a.ja()?a.b().clientWidth-c.x:c.x}f.wb=function(a){this.$a=Yc(this,a)};
function Vc(a,b){var c=a.o(),d=a.m();if("vertical"==a.C){var e=a.a.offsetHeight,g=a.b().clientHeight-e,e=Yc(a,b)-e/2;return(d-c)*(g-e)/g+c}e=a.a.offsetWidth;g=a.b().clientWidth-e;e=Yc(a,b)-e/2;return(d-c)*e/g+c}function Z(a,b){if(b==a.a)return a.c.s();if(b==a.A)return a.c.s()+a.c.V();throw Error("Illegal thumb element. Neither minThumb nor maxThumb");}function Uc(a,b){Math.abs(b)<a.Da()&&(b=Ta(b)*a.Da());var c=Z(a,a.a)+b,d=Z(a,a.A)+b,c=Sa(c,a.o(),a.m()-a.ab),d=Sa(d,a.o()+a.ab,a.m());Zc(a,c,d-c)}
function Sc(a,b,c){var d=X(a.c,c);c=b==a.a?d:a.c.s();b=b==a.A?d:a.c.s()+a.c.V();c>=a.o()&&b>=c+a.ab&&a.m()>=b&&Zc(a,c,b-c)}function Zc(a,b,c){a.o()<=b&&b<=a.m()-c&&a.ab<=c&&c<=a.m()-b&&(b!=a.s()||c!=a.V())&&(a.c.ka=!0,a.c.Ia(0),a.c.ea(b),a.c.Ia(c),a.c.ka=!1,a.Eb())}f.o=function(){return this.c.o()};f.fb=function(a){this.c.fb(a)};f.m=function(){return this.c.m()};f.Ja=function(a){this.c.Ja(a)};function Wc(a,b){return b<=a.c.s()+a.c.V()/2?a.a:a.A}f.Eb=function(){Rc(this);Qc(this);this.dispatchEvent("change")};
function Rc(a){if(a.a&&!a.Xa){var b=$c(a,Z(a,a.a)),c=$c(a,Z(a,a.A));if("vertical"==a.C)a.a.style.top=b.y+"px",a.A.style.top=c.y+"px",a.j&&(b=ad(c.y,b.y,a.a.offsetHeight),a.j.style.top=b.offset+"px",a.j.style.height=b.size+"px");else{var d=a.G&&a.ja()?"right":"left";a.a.style[d]=b.x+"px";a.A.style[d]=c.x+"px";a.j&&(b=ad(b.x,c.x,a.a.offsetWidth),a.j.style[d]=b.offset+"px",a.j.style.width=b.size+"px")}}}function ad(a,b,c){var d=Math.ceil(c/2);return{offset:a+d,size:Math.max(b-a+c-2*d,0)}}
function $c(a,b){var c=new G;if(a.a){var d=a.o(),e=a.m(),e=b==d&&d==e?0:(b-d)/(e-d);"vertical"==a.C?(d=a.b().clientHeight-a.a.offsetHeight,e=Math.round(e*d),c.x=Xc(a,a.a),c.y=d-e):(c.x=Math.round(e*(a.b().clientWidth-a.a.offsetWidth)),c.y=a.a.offsetTop)}return c}
function Tc(a,b){b=Sa(b,a.o(),a.m());a.Xa&&(a.Aa.stop(!0),a.Aa.D());var c=new nc,d,e=Wc(a,b),g=a.s(),h=a.V(),k=Z(a,e),n=$c(a,k);d=a.Da();Math.abs(b-k)<d&&(b=Sa(k+(b>k?d:-d),a.o(),a.m()));Sc(a,e,b);k=$c(a,Z(a,e));d="vertical"==a.C?[Xc(a,e),k.y]:[k.x,e.offsetTop];n=new Ic(e,[n.x,n.y],d,100);n.$(a.G);c.add(n);a.j&&bd(a,e,g,h,k,c);a.Ab&&(e=a.Ab.uc(g,b,100),x(e,function(a){c.add(a)}));a.Aa=c;a.ga().l(c,"end",a.dc);a.Xa=!0;c.play(!1)}
function bd(a,b,c,d,e,g){var h=$c(a,c),k=$c(a,c+d);c=h;d=k;b==a.a?c=e:d=e;"vertical"==a.C?(b=ad(k.y,h.y,a.a.offsetHeight),h=ad(d.y,c.y,a.a.offsetHeight),e=new Ic(a.j,[Xc(a,a.j),b.offset],[Xc(a,a.j),h.offset],100),b=new Kc(a.j,b.size,h.size,100)):(b=ad(h.x,k.x,a.a.offsetWidth),h=ad(c.x,d.x,a.a.offsetWidth),e=new Ic(a.j,[b.offset,a.j.offsetTop],[h.offset,a.j.offsetTop],100),b=new Jc(a.j,b.size,h.size,100));e.$(a.G);b.$(a.G);g.add(e);g.add(b)}f.dc=function(){this.Xa=!1};
f.setOrientation=function(a){if(this.C!=a){var b=Pc(this.C),c=Pc(a);this.C=a;this.b()&&(a=this.b(),Yb(a,b)&&($b(a,b),Zb(a,c)),b=this.G&&this.ja()?"right":"left",this.a.style[b]=this.a.style.top="",this.A.style[b]=this.A.style.top="",this.j&&(this.j.style[b]=this.j.style.top="",this.j.style.width=this.j.style.height=""),Rc(this))}};
f.g=function(){Y.i.g.call(this);this.ca&&this.ca.D();delete this.ca;this.Aa&&this.Aa.D();delete this.Aa;delete this.a;delete this.A;this.j&&delete this.j;this.c.D();delete this.c;this.Fa&&(this.Fa.D(),delete this.Fa);this.sa&&(this.sa.D(),delete this.sa);this.O&&(this.O.D(),delete this.O);this.aa&&(this.aa.D(),delete this.aa)};f.Ma=1;f.Da=function(){return this.c.Da()};f.vb=function(a){this.c.vb(a)};f.s=function(){return this.c.s()};f.ea=function(a){Sc(this,this.a,a)};f.V=function(){return this.c.V()};
f.Ia=function(a){Sc(this,this.A,this.c.s()+a)};f.setVisible=function(a){this.b().style.display=a?"":"none";a&&Rc(this)};function Qc(a){var b=a.b();b&&(rb(b,"valuemin",a.o()),rb(b,"valuemax",a.m()),rb(b,"valuenow",a.s()),rb(b,"valuetext",a.oc(a.s())||""))}f.isEnabled=function(){return this.Ta};function Xc(a,b){return a.G?qc(b):b.offsetLeft};function cd(a,b){Y.call(this,a,b);this.c.Ia(0)}w(cd,Y);function Pc(a){return"vertical"==a?"goog-slider-vertical":"goog-slider-horizontal"};function dd(a,b,c){this.map=a;this.pb=b;this.opacity=null!=c?c:1;da(this.pb.setOpacity)||alert("Invalid layer");a=$a("div",{style:"margin:5px;overflow:hidden;background:url(https://cdn.klokantech.com/maptilerlayer/v1/opacity-slider.png) no-repeat;width:71px;height:21px;cursor:pointer"});this.I=new cd;this.I.setOrientation("horizontal");Mc(this.I,a);this.I.a.setAttribute("style","padding:0;margin:0;overflow:hidden;background:url(https://cdn.klokantech.com/maptilerlayer/v1/opacity-slider.png) no-repeat -71px 0;width:10px;height:21px;position:relative");
this.I.fb(0);this.I.Ja(1);this.I.vb(null);this.I.Qb=!0;this.pb.setOpacity(this.opacity,!0);this.I.ea(this.opacity);M(this.I,"change",t(function(){this.pb.setOpacity(this.I.s(),!0)},this));this.I.a.style.left=61*this.opacity+"px";this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(this.I.b())}dd.prototype.setOpacity=function(a){Tc(this.I,a)};v("klokantech.OpacityControl",dd);function ed(a){if(navigator.geolocation){var b=!a.enabled;b?(a.Pa=!0,a.xb=!!a.yb,a.ma?a.ma.getPosition().equals(new google.maps.LatLng(0,0))||a.ma.setVisible(!0):a.ma=new google.maps.Marker({clickable:!1,position:new google.maps.LatLng(0,0),map:a.map,icon:{path:google.maps.SymbolPath.CIRCLE,scale:6,fillColor:"#3a84df",fillOpacity:.9,strokeColor:"#fff",strokeWeight:2},visible:!1}),a.Z?a.Z.getCenter().equals(new google.maps.LatLng(0,0))||a.Z.setVisible(!0):a.Z=new google.maps.Circle({clickable:!1,strokeColor:"#3a84df",
strokeOpacity:.8,strokeWeight:.5,fillColor:"#3a84df",fillOpacity:.25,map:a.map,center:new google.maps.LatLng(0,0),radius:1,visible:!1}),a.Bb||(a.Bb=navigator.geolocation.watchPosition(t(function(a){if(this.enabled){var b=new google.maps.LatLng(a.coords.latitude,a.coords.longitude);this.ma.setPosition(b);this.ma.setVisible(!0);this.Z.setCenter(b);this.Z.setRadius(a.coords.accuracy);this.Z.setVisible(!0);this.Pa&&(this.map.setCenter(b),this.Pa=!0);this.xb&&this.yb&&(this.map.setZoom(this.yb),this.xb=
!1)}},a),void 0,{enableHighAccuracy:!0}))):(a.ma.setVisible(!1),a.Z.setVisible(!1));a.Ib.style.backgroundPosition=b?"-18px":"";a.enabled=b}}
v("klokantech.GeolocationControl",function(a,b,c){this.map=a;navigator.geolocation&&"https:"==location.protocol&&(this.Ib=$a("div",{style:"background-size:36px 18px;width:18px;height:18px;opacity:0.9;background-image:url(https://cdn.klokantech.com/maptilerlayer/v1/geolocation.png);"}),this.element=$a("div",{style:"background-color:#fff;border:2px solid #fff;border-radius 3px;box-shadow:rgba(0,0,0,0.298039) 0 1px 4px -1px;margin-right:10px;cursor:pointer;border-radius:2px;padding:3px;"},this.Ib),this.xb=
this.Pa=this.enabled=!1,this.yb=b||null,this.Z=this.ma=this.Bb=null,M(this.element,"click",function(a){ed(this);a.preventDefault()},!1,this),this.map.controls[c||google.maps.ControlPosition.RIGHT_BOTTOM].push(this.element),a.addListener("center_changed",t(function(){this.Pa=!1},this)))});

var centreGot = false;

$(document).ready(function () {

    $('#modal-input-type').change(function() {
        let type = this.value;
        $.ajax({
            type: 'POST',
            url: 'get-categories-and-id-by-type',
            data: {
                type: type,
            },
            success: function (categories) {
                let categoriesSelect = $("#modal-input-categories");
                categoriesSelect.find('option').remove();
                let listItems = '';
                $.each(categories, function(key,value){
                    listItems += '<option value=' + key + '>' + value + '</option>';
                });
                categoriesSelect.append(listItems);
            }
        });

    })



    $('#showPointsOfInterest').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('Feature');
    })
    $('#showAllAssets').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('Assets');
    })
    $('#showAllProjects').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('Projects');
    })

    $('#showAllPoints').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('All');
    })

    $('#showMaintenance').click(function (e) {
        removeAllMarkers();
        requestAllTasks();
    });

    $('#validateTasks').click(function (e) {
        $.ajax({
            type: 'POST',
            url: 'execute-validate-tasks',
            success: function (data) {
                $('#toast-status-body').html(data);
                $('#toast-status').toast('show');
            }
        });
    });

    $('#validatePictures').click(function (e) {
        $.ajax({
            type: 'POST',
            url: 'execute-validate-pictures',
            success: function (data) {
                $('#toast-status-body').html(data);
                $('#toast-status').toast('show');
            }
        });
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



}); //End On Load Complete



function hideMapDrawControls() {
    drawingManager.setOptions({
        drawingControl: false,
        drawingMode: null
    });
}

function AddMarkerToMap(markerProperties) {
    let latlng = new google.maps.LatLng(markerProperties.lat, markerProperties.lng);
    let marker = new google.maps.Marker({
        position: latlng,
        title: markerProperties.title,
        cursor: 'Cursor',
        content: markerProperties.description,
        icon: (markerProperties.icon != null ? markerProperties.icon : (markerProperties.default_icon != null ? markerProperties.default_icon : markerProperties.category.default_icon)),
        animation: google.maps.Animation.DROP,
        map: map
    });
    markers_map.push(marker);

    marker.addListener('click', function() {
        iw_map.setContent(this.get('content'));
        iw_map.open(map, marker);
    });
}

function removeAllMarkers(){
    for(let i=0; i<markers_map.length; i++){
        markers_map[i].setMap(null);
    }
    markers_map = [];
}


function requestMarkersByType($type) {
    $.ajax({
        type: 'POST',
        url: 'get-points-by-type',
        data: {
            category_type: $type,
        },
        success: function (markersProperties) {
            markersProperties.forEach(function (markerProperties) {
                AddMarkerToMap(markerProperties);
            })
        }
    });
}
function requestAllTasks() {
    $.ajax({
        type: 'POST',
        url: 'get-maintenance-markers',
        data: {
            daysToLookAhead: 14,
        },
        success: function (markersProperties) {
            markersProperties.forEach(function(marker){
                AddMarkerToMap(marker);
            })
        }
    });
}

//called from snippet added in MapController
function onMapLoadComplete(){
    new klokantech.GeolocationControl(map, 0, google.maps.ControlPosition.RIGHT_CENTER);
    let mapCanvas = $('#map_canvas');
    mapCanvas.on('click','.editMarker', function() {showMarkerModalEdit($(this).attr('point-id'));});
    mapCanvas.on('click','.editMarkerSchedule', function() {showScheduleModalEditMarker($(this).attr('point-id'));});
    mapCanvas.on('click','.taskMarkCompleted', function() {taskMarkerCompleted($(this).attr('task-id'));});
    mapCanvas.on('click','.maintenanceMarkCompleted', function() {maintenanceMarkerCompleted($(this).attr('point-id'));});
    mapCanvas.on('click','.maintenanceMarkSeverity', function() {maintenanceMarkSeverity($(this).attr('point-id'), $(this).attr('maintenance-rating-id'));});


}


function taskMarkerCompleted(taskId) {
    $.ajax({
        type: 'POST',
        url: 'execute-mark-task-complete',
        data: {
            taskId: taskId
        },
        success: function (data) {
            $('#toast-status-body').html(data);
            $('#toast-status').toast('show');
            removeAllMarkers();
            requestAllTasks();
        }
    });

}

function maintenanceMarkerCompleted(pointId) {
    $.ajax({
        type: 'POST',
        url: 'execute-mark-maintenance-complete',
        data: {
            pointId: pointId
        },
        success: function (data) {
            $('#toast-status-body').html(data);
            $('#toast-status').toast('show');
            removeAllMarkers();
            requestAllTasks();
        }
    });
}

function maintenanceMarkSeverity(pointId, maintenanceRatingId) {
    $.ajax({
        type: 'POST',
        url: 'execute-update-maintenance-rating',
        data: {
            pointId: pointId,
            maintenanceRatingId: maintenanceRatingId
        },
        success: function (data) {
            $('#toast-status-body').html(data);
            $('#toast-status').toast('show');
            removeAllMarkers();
            requestAllTasks();
        }
    });
}

function clearAllValidationErrors() {
    $(".validation-error").remove();
    $("input").removeClass("is-invalid");
}