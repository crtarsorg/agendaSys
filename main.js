




var isEmbed = false;



var searchwait = 0;
var msgonce = false;
var lasttip = false;
var tips = {};
var tooltipwait = 0;
var cv = false;
var oun = '';
var unok = true;



var is_iphone = ((navigator.userAgent.toLowerCase().indexOf("iphone") > -1) || (navigator.userAgent.toLowerCase().indexOf("ipod") > -1));
var is_ipad = ((navigator.userAgent.toLowerCase().indexOf("ipad") > -1));




$(document).ready(function(){




$(".outer-links a").attr('target', '_blank');
$(".past_block").addClass('clickable')
.click(function(){
  var idx = $(this).attr('rel');
  var status = $(this).attr('rev');

  if(status != 'hidden'){
    $(this).attr('rev','hidden');
    $("tr[rel='past_"+idx+"']").hide();
  } else {
    $(this).attr('rev','');
    $("tr[rel='past_"+idx+"']").show();
  }

})
.click();
});

var delayedHideTooltipTimer = false;
function delayedHideTooltip() {
    if (delayedHideTooltipTimer)
        clearTimeout(delayedHideTooltipTimer);

    delayedHideTooltipTimer = setTimeout(function() {
        if (isEmbed) parent.socket.postMessage('hidetip');
        $("#tip").hide();
    }, 0);
}
function delayedHideTooltipCancel() {
    if (delayedHideTooltipTimer) {
        clearTimeout(delayedHideTooltipTimer);
        delayedHideTooltipTimer = false;
    }
}

// main



function toggleEventAdd(e) {
  saveEvent(e);
}

// date picker related
function setupDatePicker(es, ed)
{
  var cal;
  var $this;

  var checkForMouseout = function(event)
  {
    var el = event.target;
    while (true){
      if (el == cal || el == document.getElementById("toolbar")) {
        return true;
      } else if (el == document) {
        $this.dpClose();
        return false;
      } else {
        el = $(el).parent()[0];
      }
    }
  };

  Date.format = 'mm/dd/yyyy';

  $('.date-pick').datePicker({
    startDate:es,
    endDate:ed
  }).bind("dateSelected", function(e, sd, td) {
    document.location.href = "/cal/" + sd.getFullYear() + (sd.getMonth()+1 < 10 ? "0" : "") + (sd.getMonth()+1) + (sd.getDate() < 10 ? "0" : "") + sd.getDate();
  }).bind(
    'dpDisplayed',
    function(event, datePickerDiv)
    {
      cal = datePickerDiv;
      $this = $(this);
      $(document).bind(
        'mouseover',
        checkForMouseout
      );
    }
  ).bind(
    'dpClosed',
    function(event, selected)
    {
      $(document).unbind(
        'mouseover',
        checkForMouseout
      );
    }
  ).dpSetOffset($("#header").height(), 0);
  $("#caldatebtn").click(function() { $('#caldate').dpDisplay(); return false; }).mouseover(function() { $('#caldate').dpDisplay(); });
  $("#toolbar li.lev1").mouseout(function() {
    if(!$(this).hasClass("ldate"))
      $('#caldate').dpClose();
  });
}




function toggleInfo(lnk, id)
{
  if($(lnk).html().substr(0, 4) == L10n['more'])
  {
    $(lnk).html("<< " + L10n['less']);
    if($("#infobox_" + id).html() == "")
    {
      $("#infobox_" + id).html("<b>" + L10n['loading'] + "</b>");
      $("#inforow_" + id).show();
      $.get("/event-get?more=" + id, function(ret) { $("#infobox_" + id).html(ret); });
    }
    else
    {
      $("#inforow_" + id).show();
    }
  }
  else
  {
    $(lnk).html(L10n['more'] + " >>");
    $("#inforow_" + id).hide();
  }

  return false;
}







// sidebar filter menus
$(document).ready(
  function() {
    $('#sidebar-filters-custom .li-filter a').click(
      function() {
        var self = $(this);
        $('#sidebar-filters-list div').each(function(i,e) {
            if ($(e).attr('id') == self.attr('rel')) {
              if ($(e).css('display') == 'block') {
                $(e).hide();
              } else {
                $(e).show();
              }
            } else {
              $(e).hide();
            }
          }
        );
        return false;
      }
    );
  }
);

function toggleExpired(caller) {
  $('.container-hidden').slideToggle(
    function(){
      if($('.container-hidden').is(":visible")) {
        $('.container-expired a').html("Hide Earlier Events");
        $('.container-expired a').addClass("hide-past-events");
      } else {
        $('.container-expired a').html("Show Earlier Events");
        $('.container-expired a').removeClass("hide-past-events");
      }
    }
  );
}

/*!
* qTip2 - Pretty powerful tooltips
* http://craigsworks.com/projects/qtip2/
*
* Version: nightly
* Copyright 2009-2010 Craig Michael Thompson - http://craigsworks.com
*
* Dual licensed under MIT or GPLv2 licenses
*   http://en.wikipedia.org/wiki/MIT_License
*   http://en.wikipedia.org/wiki/GNU_General_Public_License
*
* Date: Sat Jun  2 08:46:38.0000000000 2012
*/

(function(a){typeof define==="function"&&define.amd?define(["jquery"],a):a(jQuery)})(function(a){function A(f,h){function y(a){var b=a.precedance==="y",c=n[b?"width":"height"],d=n[b?"height":"width"],e=a.string().indexOf("center")>-1,f=c*(e?.5:1),g=Math.pow,h=Math.round,i,j,k,l=Math.sqrt(g(f,2)+g(d,2)),m=[p/f*l,p/d*l];m[2]=Math.sqrt(g(m[0],2)-g(p,2)),m[3]=Math.sqrt(g(m[1],2)-g(p,2)),i=l+m[2]+m[3]+(e?0:m[0]),j=i/l,k=[h(j*d),h(j*c)];return{height:k[b?0:1],width:k[b?1:0]}}function x(b){var c=k.titlebar&&b.y==="top",d=c?k.titlebar:k.content,e=a.browser.mozilla,f=e?"-moz-":a.browser.webkit?"-webkit-":"",g=b.y+(e?"":"-")+b.x,h=f+(e?"border-radius-"+g:"border-"+g+"-radius");return parseInt(d.css(h),10)||parseInt(l.css(h),10)||0}function w(a,b,c){b=b?b:a[a.precedance];var d=l.hasClass(q),e=k.titlebar&&a.y==="top",f=e?k.titlebar:k.tooltip,g="border-"+b+"-width",h;l.addClass(q),h=parseInt(f.css(g),10),h=(c?h||parseInt(l.css(g),10):h)||0,l.toggleClass(q,d);return h}function v(a,d,g,h){if(k.tip){var l=i.corner.clone(),n=g.adjusted,o=f.options.position.adjust.method.split(" "),p=o[0],q=o[1]||o[0],r={left:c,top:c,x:0,y:0},s,t={},u;i.corner.fixed!==b&&(p==="shift"&&l.precedance==="x"&&n.left&&l.y!=="center"?l.precedance=l.precedance==="x"?"y":"x":p!=="shift"&&n.left&&(l.x=l.x==="center"?n.left>0?"left":"right":l.x==="left"?"right":"left"),q==="shift"&&l.precedance==="y"&&n.top&&l.x!=="center"?l.precedance=l.precedance==="y"?"x":"y":q!=="shift"&&n.top&&(l.y=l.y==="center"?n.top>0?"top":"bottom":l.y==="top"?"bottom":"top"),l.string()!==m.corner.string()&&(m.top!==n.top||m.left!==n.left)&&i.update(l,c)),s=i.position(l,n),s[l.x]+=w(l,l.x,b),s[l.y]+=w(l,l.y,b),s.right!==e&&(s.left=-s.right),s.bottom!==e&&(s.top=-s.bottom),s.user=Math.max(0,j.offset);if(r.left=p==="shift"&&!!n.left)l.x==="center"?t["margin-left"]=r.x=s["margin-left"]-n.left:(u=s.right!==e?[n.left,-s.left]:[-n.left,s.left],(r.x=Math.max(u[0],u[1]))>u[0]&&(g.left-=n.left,r.left=c),t[s.right!==e?"right":"left"]=r.x);if(r.top=q==="shift"&&!!n.top)l.y==="center"?t["margin-top"]=r.y=s["margin-top"]-n.top:(u=s.bottom!==e?[n.top,-s.top]:[-n.top,s.top],(r.y=Math.max(u[0],u[1]))>u[0]&&(g.top-=n.top,r.top=c),t[s.bottom!==e?"bottom":"top"]=r.y);k.tip.css(t).toggle(!(r.x&&r.y||l.x==="center"&&r.y||l.y==="center"&&r.x)),g.left-=s.left.charAt?s.user:p!=="shift"||r.top||!r.left&&!r.top?s.left:0,g.top-=s.top.charAt?s.user:q!=="shift"||r.left||!r.left&&!r.top?s.top:0,m.left=n.left,m.top=n.top,m.corner=l.clone()}}function u(){n.width=j.width,n.height=j.height}function t(){var a=n.width;n.width=n.height,n.height=a}var i=this,j=f.options.style.tip,k=f.elements,l=k.tooltip,m={top:0,left:0},n={width:j.width,height:j.height},o={},p=j.border||0,r=".qtip-tip",s=!!(a("<canvas />")[0]||{}).getContext;i.mimic=i.corner=d,i.border=p,i.offset=j.offset,i.size=n,f.checks.tip={"^position.my|style.tip.(corner|mimic|border)$":function(){i.init()||i.destroy(),f.reposition()},"^style.tip.(height|width)$":function(){n={width:j.width,height:j.height},i.create(),i.update(),f.reposition()},"^content.title.text|style.(classes|widget)$":function(){k.tip&&k.tip.length&&i.update()}},a.extend(i,{init:function(){var b=i.detectCorner()&&(s||a.browser.msie);b&&(i.create(),i.update(),l.unbind(r).bind("tooltipmove"+r,v));return b},detectCorner:function(){var a=j.corner,d=f.options.position,e=d.at,h=d.my.string?d.my.string():d.my;if(a===c||h===c&&e===c)return c;a===b?i.corner=new g.Corner(h):a.string||(i.corner=new g.Corner(a),i.corner.fixed=b),m.corner=new g.Corner(i.corner.string());return i.corner.string()!=="centercenter"},detectColours:function(b){var c,d,e,f=k.tip.css("cssText",""),g=b||i.corner,h=g[g.precedance],m="border-"+h+"-color",p="border"+h.charAt(0)+h.substr(1)+"Color",r=/rgba?\(0, 0, 0(, 0)?\)|transparent|#123456/i,s="background-color",t="transparent",u=" !important",v=k.titlebar&&(g.y==="top"||g.y==="center"&&f.position().top+n.height/2+j.offset<k.titlebar.outerHeight(1)),w=v?k.titlebar:k.tooltip;l.addClass(q),o.fill=d=f.css(s),o.border=e=f[0].style[p]||f.css(m)||l.css(m);if(!d||r.test(d))o.fill=w.css(s)||t,r.test(o.fill)&&(o.fill=l.css(s)||d);if(!e||r.test(e)||e===a(document.body).css("color")){o.border=w.css(m)||t;if(r.test(o.border)||o.border===w.css("color"))o.border=l.css(m)||l.css(p)||e}a("*",f).add(f).css("cssText",s+":"+t+u+";border:0"+u+";"),l.removeClass(q)},create:function(){var b=n.width,c=n.height,d;k.tip&&k.tip.remove(),k.tip=a("<div />",{"class":"ui-tooltip-tip"}).css({width:b,height:c}).prependTo(l),s?a("<canvas />").appendTo(k.tip)[0].getContext("2d").save():(d='<vml:shape coordorigin="0,0" style="display:inline-block; position:absolute; behavior:url(#default#VML);"></vml:shape>',k.tip.html(d+d),a("*",k.tip).bind("click mousedown",function(a){a.stopPropagation()}))},update:function(e,f){var h=k.tip,q=h.children(),r=n.width,v=n.height,x="px solid ",A="px dashed transparent",B=j.mimic,C=Math.round,D,E,F,G,H;e||(e=m.corner||i.corner),B===c?B=e:(B=new g.Corner(B),B.precedance=e.precedance,B.x==="inherit"?B.x=e.x:B.y==="inherit"?B.y=e.y:B.x===B.y&&(B[e.precedance]=e[e.precedance])),D=B.precedance,e.precedance==="x"?t():u(),k.tip.css({width:r=n.width,height:v=n.height}),i.detectColours(e),o.border!=="transparent"?(p=w(e,d,b),j.border===0&&p>0&&(o.fill=o.border),i.border=p=j.border!==b?j.border:p):i.border=p=0,F=z(B,r,v),i.size=H=y(e),h.css(H),e.precedance==="y"?G=[C(B.x==="left"?p:B.x==="right"?H.width-r-p:(H.width-r)/2),C(B.y==="top"?H.height-v:0)]:G=[C(B.x==="left"?H.width-r:0),C(B.y==="top"?p:B.y==="bottom"?H.height-v-p:(H.height-v)/2)],s?(q.attr(H),E=q[0].getContext("2d"),E.restore(),E.save(),E.clearRect(0,0,3e3,3e3),E.fillStyle=o.fill,E.strokeStyle=o.border,E.lineWidth=p*2,E.lineJoin="miter",E.miterLimit=100,E.translate(G[0],G[1]),E.beginPath(),E.moveTo(F[0][0],F[0][1]),E.lineTo(F[1][0],F[1][1]),E.lineTo(F[2][0],F[2][1]),E.closePath(),p&&(l.css("background-clip")==="border-box"&&(E.strokeStyle=o.fill,E.stroke()),E.strokeStyle=o.border,E.stroke()),E.fill()):(F="m"+F[0][0]+","+F[0][1]+" l"+F[1][0]+","+F[1][1]+" "+F[2][0]+","+F[2][1]+" xe",G[2]=p&&/^(r|b)/i.test(e.string())?parseFloat(a.browser.version,10)===8?2:1:0,q.css({antialias:""+(B.string().indexOf("center")>-1),left:G[0]-G[2]*Number(D==="x"),top:G[1]-G[2]*Number(D==="y"),width:r+p,height:v+p}).each(function(b){var c=a(this);c[c.prop?"prop":"attr"]({coordsize:r+p+" "+(v+p),path:F,fillcolor:o.fill,filled:!!b,stroked:!b}).css({display:p||b?"block":"none"}),!b&&c.html()===""&&c.html('<vml:stroke weight="'+p*2+'px" color="'+o.border+'" miterlimit="1000" joinstyle="miter"  style="behavior:url(#default#VML); display:inline-block;" />')})),f!==c&&i.position(e)},position:function(b){var d=k.tip,e={},f=Math.max(0,j.offset),g,h,l;if(j.corner===c||!d)return c;b=b||i.corner,g=b.precedance,h=y(b),l=[b.x,b.y],g==="x"&&l.reverse(),a.each(l,function(a,c){var d,i;c==="center"?(d=g==="y"?"left":"top",e[d]="50%",e["margin-"+d]=-Math.round(h[g==="y"?"width":"height"]/2)+f):(d=w(b,c),i=x(b),e[c]=a?0:f+(i>d?i:-d))}),e[b[g]]-=h[g==="x"?"width":"height"],d.css({top:"",bottom:"",left:"",right:"",margin:""}).css(e);return e},destroy:function(){k.tip&&k.tip.remove(),k.tip=!1,l.unbind(r)}}),i.init()}function z(a,b,c){var d=Math.ceil(b/2),e=Math.ceil(c/2),f={bottomright:[[0,0],[b,c],[b,0]],bottomleft:[[0,0],[b,0],[0,c]],topright:[[0,c],[b,0],[b,c]],topleft:[[0,0],[0,c],[b,c]],topcenter:[[0,c],[d,0],[b,c]],bottomcenter:[[0,0],[b,0],[d,c]],rightcenter:[[0,0],[b,e],[0,c]],leftcenter:[[b,0],[b,c],[0,e]]};f.lefttop=f.bottomright,f.righttop=f.bottomleft,f.leftbottom=f.topright,f.rightbottom=f.topleft;return f[a.string()]}function y(e,h){var i,j,k,l,m,n=a(this),o=a(document.body),p=this===document?o:n,q=n.metadata?n.metadata(h.metadata):d,r=h.metadata.type==="html5"&&q?q[h.metadata.name]:d,s=n.data(h.metadata.name||"qtipopts");try{s=typeof s==="string"?(new Function("return "+s))():s}catch(u){v("Unable to parse HTML5 attribute data: "+s)}l=a.extend(b,{},f.defaults,h,typeof s==="object"?w(s):d,w(r||q)),j=l.position,l.id=e;if("boolean"===typeof l.content.text){k=n.attr(l.content.attr);if(l.content.attr!==c&&k)l.content.text=k;else{v("Unable to locate content for tooltip! Aborting render of tooltip on element: ",n);return c}}j.container.length||(j.container=o),j.target===c&&(j.target=p),l.show.target===c&&(l.show.target=p),l.show.solo===b&&(l.show.solo=j.container.closest("body")),l.hide.target===c&&(l.hide.target=p),l.position.viewport===b&&(l.position.viewport=j.container),j.container=j.container.eq(0),j.at=new g.Corner(j.at),j.my=new g.Corner(j.my);if(a.data(this,"qtip"))if(l.overwrite)n.qtip("destroy");else if(l.overwrite===c)return c;l.suppress&&(m=a.attr(this,"title"))&&a(this).removeAttr("title").attr(t,m).attr("title",""),i=new x(n,l,e,!!k),a.data(this,"qtip",i),n.bind("remove.qtip-"+e+" removeqtip.qtip-"+e,function(){i.destroy()});return i}function x(r,s,v,x){function Q(){var b=[s.show.target[0],s.hide.target[0],y.rendered&&F.tooltip[0],s.position.container[0],s.position.viewport[0],window,document];y.rendered?a([]).pushStack(a.grep(b,function(a){return typeof a==="object"})).unbind(E):s.show.target.unbind(E+"-create")}function P(){function o(a){y.rendered&&D[0].offsetWidth>0&&y.reposition(a)}function n(a){if(D.hasClass(l))return c;clearTimeout(y.timers.inactive),y.timers.inactive=setTimeout(function(){y.hide(a)},s.hide.inactive)}function k(b){if(D.hasClass(l)||B||C)return c;var f=a(b.relatedTarget||b.target),g=f.closest(m)[0]===D[0],h=f[0]===e.show[0];clearTimeout(y.timers.show),clearTimeout(y.timers.hide);if(d.target==="mouse"&&g||s.hide.fixed&&(/mouse(out|leave|move)/.test(b.type)&&(g||h)))try{b.preventDefault(),b.stopImmediatePropagation()}catch(i){}else s.hide.delay>0?y.timers.hide=setTimeout(function(){y.hide(b)},s.hide.delay):y.hide(b)}function j(a){if(D.hasClass(l))return c;clearTimeout(y.timers.show),clearTimeout(y.timers.hide);var d=function(){y.toggle(b,a)};s.show.delay>0?y.timers.show=setTimeout(d,s.show.delay):d()}var d=s.position,e={show:s.show.target,hide:s.hide.target,viewport:a(d.viewport),document:a(document),body:a(document.body),window:a(window)},g={show:a.trim(""+s.show.event).split(" "),hide:a.trim(""+s.hide.event).split(" ")},i=a.browser.msie&&parseInt(a.browser.version,10)===6;D.bind("mouseenter"+E+" mouseleave"+E,function(a){var b=a.type==="mouseenter";b&&y.focus(a),D.toggleClass(p,b)}),s.hide.fixed&&(e.hide=e.hide.add(D),D.bind("mouseover"+E,function(){D.hasClass(l)||clearTimeout(y.timers.hide)})),/mouse(out|leave)/i.test(s.hide.event)?s.hide.leave==="window"&&e.window.bind("mouseout"+E+" blur"+E,function(a){/select|option/.test(a.target)&&!a.relatedTarget&&y.hide(a)}):/mouse(over|enter)/i.test(s.show.event)&&e.hide.bind("mouseleave"+E,function(a){clearTimeout(y.timers.show)}),(""+s.hide.event).indexOf("unfocus")>-1&&d.container.closest("html").bind("mousedown"+E,function(b){var c=a(b.target),d=y.rendered&&!D.hasClass(l)&&D[0].offsetWidth>0,e=c.parents(m).filter(D[0]).length>0;c[0]!==r[0]&&c[0]!==D[0]&&!e&&!r.has(c[0]).length&&!c.attr("disabled")&&y.hide(b)}),"number"===typeof s.hide.inactive&&(e.show.bind("qtip-"+v+"-inactive",n),a.each(f.inactiveEvents,function(a,b){e.hide.add(F.tooltip).bind(b+E+"-inactive",n)})),a.each(g.hide,function(b,c){var d=a.inArray(c,g.show),f=a(e.hide);d>-1&&f.add(e.show).length===f.length||c==="unfocus"?(e.show.bind(c+E,function(a){D[0].offsetWidth>0?k(a):j(a)}),delete g.show[d]):e.hide.bind(c+E,k)}),a.each(g.show,function(a,b){e.show.bind(b+E,j)}),"number"===typeof s.hide.distance&&e.show.add(D).bind("mousemove"+E,function(a){var b=G.origin||{},c=s.hide.distance,d=Math.abs;(d(a.pageX-b.pageX)>=c||d(a.pageY-b.pageY)>=c)&&y.hide(a)}),d.target==="mouse"&&(e.show.bind("mousemove"+E,function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"}}),d.adjust.mouse&&(s.hide.event&&(D.bind("mouseleave"+E,function(a){(a.relatedTarget||a.target)!==e.show[0]&&y.hide(a)}),F.target.bind("mouseenter"+E+" mouseleave"+E,function(a){G.onTarget=a.type==="mouseenter"})),e.document.bind("mousemove"+E,function(a){y.rendered&&G.onTarget&&!D.hasClass(l)&&D[0].offsetWidth>0&&y.reposition(a||h)}))),(d.adjust.resize||e.viewport.length)&&(a.event.special.resize?e.viewport:e.window).bind("resize"+E,o),(e.viewport.length||i&&D.css("position")==="fixed")&&e.viewport.bind("scroll"+E,o)}function O(b,d){function g(b){function i(e){e&&(delete h[e.src],clearTimeout(y.timers.img[e.src]),a(e).unbind(E)),a.isEmptyObject(h)&&(y.redraw(),d!==c&&y.reposition(G.event),b())}var g,h={};if((g=f.find("img[src]:not([height]):not([width])")).length===0)return i();g.each(function(b,c){if(h[c.src]===e){var d=0,f=3;(function g(){if(c.height||c.width||d>f)return i(c);d+=1,y.timers.img[c.src]=setTimeout(g,700)})(),a(c).bind("error"+E+" load"+E,function(){i(this)}),h[c.src]=c}})}var f=F.content;if(!y.rendered||!b)return c;a.isFunction(b)&&(b=b.call(r,G.event,y)||""),b.jquery&&b.length>0?f.empty().append(b.css({display:"block"})):f.html(b),y.rendered<0?D.queue("fx",g):(C=0,g(a.noop));return y}function N(b,d){var e=F.title;if(!y.rendered||!b)return c;a.isFunction(b)&&(b=b.call(r,G.event,y));if(b===c||!b&&b!=="")return J(c);b.jquery&&b.length>0?e.empty().append(b.css({display:"block"})):e.html(b),y.redraw(),d!==c&&y.rendered&&D[0].offsetWidth>0&&y.reposition(G.event)}function M(a){var b=F.button,d=F.title;if(!y.rendered)return c;a?(d||L(),K()):b.remove()}function L(){var c=A+"-title";F.titlebar&&J(),F.titlebar=a("<div />",{"class":j+"-titlebar "+(s.style.widget?"ui-widget-header":"")}).append(F.title=a("<div />",{id:c,"class":j+"-title","aria-atomic":b})).insertBefore(F.content).delegate(".ui-tooltip-close","mousedown keydown mouseup keyup mouseout",function(b){a(this).toggleClass("ui-state-active ui-state-focus",b.type.substr(-4)==="down")}).delegate(".ui-tooltip-close","mouseover mouseout",function(b){a(this).toggleClass("ui-state-hover",b.type==="mouseover")}),s.content.title.button?K():y.rendered&&y.redraw()}function K(){var b=s.content.title.button,d=typeof b==="string",e=d?b:"Close tooltip";F.button&&F.button.remove(),b.jquery?F.button=b:F.button=a("<a />",{"class":"ui-state-default ui-tooltip-close "+(s.style.widget?"":j+"-icon"),title:e,"aria-label":e}).prepend(a("<span />",{"class":"ui-icon ui-icon-close",html:"&times;"})),F.button.appendTo(F.titlebar).attr("role","button").click(function(a){D.hasClass(l)||y.hide(a);return c}),y.redraw()}function J(a){F.title&&(F.titlebar.remove(),F.titlebar=F.title=F.button=d,a!==c&&y.reposition())}function I(){var a=s.style.widget;D.toggleClass(k,a).toggleClass(n,s.style.def&&!a),F.content.toggleClass(k+"-content",a),F.titlebar&&F.titlebar.toggleClass(k+"-header",a),F.button&&F.button.toggleClass(j+"-icon",!a)}function H(a){var b=0,c,d=s,e=a.split(".");while(d=d[e[b++]])b<e.length&&(c=d);return[c||s,e.pop()]}var y=this,z=document.body,A=j+"-"+v,B=0,C=0,D=a(),E=".qtip-"+v,F,G;y.id=v,y.destroyed=y.rendered=c,y.elements=F={target:r},y.timers={img:{}},y.options=s,y.checks={},y.plugins={},y.cache=G={event:{},target:a(),disabled:c,attr:x,onTarget:c},y.checks.builtin={"^id$":function(d,e,g){var h=g===b?f.nextid:g,i=j+"-"+h;h!==c&&h.length>0&&!a("#"+i).length&&(D[0].id=i,F.content[0].id=i+"-content",F.title[0].id=i+"-title")},"^content.text$":function(a,b,c){O(c)},"^content.title.text$":function(a,b,c){if(!c)return J();!F.title&&c&&L(),N(c)},"^content.title.button$":function(a,b,c){M(c)},"^position.(my|at)$":function(a,b,c){"string"===typeof c&&(a[b]=new g.Corner(c))},"^position.container$":function(a,b,c){y.rendered&&D.appendTo(c)},"^show.ready$":function(){y.rendered?y.toggle(b):y.render(1)},"^style.classes$":function(a,b,c){D.attr("class",j+" qtip ui-helper-reset "+c)},"^style.widget|content.title":I,"^events.(render|show|move|hide|focus|blur)$":function(b,c,d){D[(a.isFunction(d)?"":"un")+"bind"]("tooltip"+c,d)},"^(show|hide|position).(event|target|fixed|inactive|leave|distance|viewport|adjust)":function(){var a=s.position;D.attr("tracking",a.target==="mouse"&&a.adjust.mouse),Q(),P()}},a.extend(y,{render:function(d){if(y.rendered)return y;var e=s.content.text,f=s.content.title.text,h=s.position,i=a.Event("tooltiprender");a.attr(r[0],"aria-describedby",A),D=F.tooltip=a("<div/>",{id:A,"class":j+" qtip ui-helper-reset "+n+" "+s.style.classes+" "+j+"-pos-"+s.position.my.abbrev(),width:s.style.width||"",height:s.style.height||"",tracking:h.target==="mouse"&&h.adjust.mouse,role:"alert","aria-live":"polite","aria-atomic":c,"aria-describedby":A+"-content","aria-hidden":b}).toggleClass(l,G.disabled).data("qtip",y).appendTo(s.position.container).append(F.content=a("<div />",{"class":j+"-content",id:A+"-content","aria-atomic":b})),y.rendered=-1,B=C=1,f&&(L(),a.isFunction(f)||N(f,c)),a.isFunction(e)||O(e,c),y.rendered=b,I(),a.each(s.events,function(b,c){a.isFunction(c)&&D.bind(b==="toggle"?"tooltipshow tooltiphide":"tooltip"+b,c)}),a.each(g,function(){this.initialize==="render"&&this(y)}),P(),D.queue("fx",function(a){i.originalEvent=G.event,D.trigger(i,[y]),B=C=0,y.redraw(),(s.show.ready||d)&&y.toggle(b,G.event,c),a()});return y},get:function(a){var b,c;switch(a.toLowerCase()){case"dimensions":b={height:D.outerHeight(),width:D.outerWidth()};break;case"offset":b=g.offset(D,s.position.container);break;default:c=H(a.toLowerCase()),b=c[0][c[1]],b=b.precedance?b.string():b}return b},set:function(e,f){function m(a,b){var c,d,e;for(c in k)for(d in k[c])if(e=(new RegExp(d,"i")).exec(a))b.push(e),k[c][d].apply(y,b)}var g=/^position\.(my|at|adjust|target|container)|style|content|show\.ready/i,h=/^content\.(title|attr)|style/i,i=c,j=c,k=y.checks,l;"string"===typeof e?(l=e,e={},e[l]=f):e=a.extend(b,{},e),a.each(e,function(b,c){var d=H(b.toLowerCase()),f;f=d[0][d[1]],d[0][d[1]]="object"===typeof c&&c.nodeType?a(c):c,e[b]=[d[0],d[1],c,f],i=g.test(b)||i,j=h.test(b)||j}),w(s),B=C=1,a.each(e,m),B=C=0,y.rendered&&D[0].offsetWidth>0&&(i&&y.reposition(s.position.target==="mouse"?d:G.event),j&&y.redraw());return y},toggle:function(e,f){function t(){e?(a.browser.msie&&D[0].style.removeAttribute("filter"),D.css("overflow",""),"string"===typeof i.autofocus&&a(i.autofocus,D).focus(),i.target.trigger("qtip-"+v+"-inactive")):D.css({display:"",visibility:"",opacity:"",left:"",top:""}),r=a.Event("tooltip"+(e?"visible":"hidden")),r.originalEvent=f?G.event:d,D.trigger(r,[y])}if(!y.rendered)return e?y.render(1):y;var g=e?"show":"hide",i=s[g],j=s[e?"hide":"show"],k=s.position,l=s.content,n=D[0].offsetWidth>0,o=e||i.target.length===1,p=!f||i.target.length<2||G.target[0]===f.target,q,r;(typeof e).search("boolean|number")&&(e=!n);if(!D.is(":animated")&&n===e&&p)return y;if(f){if(/over|enter/.test(f.type)&&/out|leave/.test(G.event.type)&&s.show.target.add(f.target).length===s.show.target.length&&D.has(f.relatedTarget).length)return y;G.event=a.extend({},f)}r=a.Event("tooltip"+g),r.originalEvent=f?G.event:d,D.trigger(r,[y,90]);if(r.isDefaultPrevented())return y;a.attr(D[0],"aria-hidden",!e),e?(G.origin=a.extend({},h),y.focus(f),a.isFunction(l.text)&&O(l.text,c),a.isFunction(l.title.text)&&N(l.title.text,c),!u&&k.target==="mouse"&&k.adjust.mouse&&(a(document).bind("mousemove.qtip",function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"}}),u=b),y.reposition(f,arguments[2]),(r.solo=!!i.solo)&&a(m,i.solo).not(D).qtip("hide",r)):(clearTimeout(y.timers.show),delete G.origin,u&&!a(m+'[tracking="true"]:visible',i.solo).not(D).length&&(a(document).unbind("mousemove.qtip"),u=c),y.blur(f)),i.effect===c||o===c?(D[g](),t.call(D)):a.isFunction(i.effect)?(D.stop(1,1),i.effect.call(D,y),D.queue("fx",function(a){t(),a()})):D.fadeTo(90,e?1:0,t),e&&i.target.trigger("qtip-"+v+"-inactive");return y},show:function(a){return y.toggle(b,a)},hide:function(a){return y.toggle(c,a)},focus:function(b){if(!y.rendered)return y;var c=a(m),d=parseInt(D[0].style.zIndex,10),e=f.zindex+c.length,g=a.extend({},b),h,i;D.hasClass(o)||(i=a.Event("tooltipfocus"),i.originalEvent=g,D.trigger(i,[y,e]),i.isDefaultPrevented()||(d!==e&&(c.each(function(){this.style.zIndex>d&&(this.style.zIndex=this.style.zIndex-1)}),c.filter("."+o).qtip("blur",g)),D.addClass(o)[0].style.zIndex=e));return y},blur:function(b){var c=a.extend({},b),d;D.removeClass(o),d=a.Event("tooltipblur"),d.originalEvent=c,D.trigger(d,[y]);return y},reposition:function(b,d){if(!y.rendered||B)return y;B=1;var e=s.position.target,f=s.position,i=f.my,k=f.at,l=f.adjust,m=l.method.split(" "),n=D.outerWidth(),o=D.outerHeight(),p=0,q=0,r=a.Event("tooltipmove"),t=D.css("position")==="fixed",u=f.viewport,v={left:0,top:0},w=f.container,x=c,A=y.plugins.tip,C=D[0].offsetWidth>0,E={horizontal:m[0],vertical:m[1]=m[1]||m[0],enabled:u.jquery&&e[0]!==window&&e[0]!==z&&l.method!=="none",left:function(a){var b=E.horizontal==="shift",c=l.x*(E.horizontal.substr(-6)==="invert"?2:0),d=-w.offset.left+u.offset.left+u.scrollLeft,e=i.x==="left"?n:i.x==="right"?-n:-n/2,f=k.x==="left"?p:k.x==="right"?-p:-p/2,g=A&&A.size?A.size.width||0:0,h=A&&A.corner&&A.corner.precedance==="x"&&!b?g:0,j=d-a+h,m=a+n-u.width-d+h,o=e-(i.precedance==="x"||i.x===i.y?f:0)-(k.x==="center"?p/2:0),q=i.x==="center";b?(h=A&&A.corner&&A.corner.precedance==="y"?g:0,o=(i.x==="left"?1:-1)*e-h,v.left+=j>0?j:m>0?-m:0,v.left=Math.max(-w.offset.left+u.offset.left+(h&&A.corner.x==="center"?A.offset:0),a-o,Math.min(Math.max(-w.offset.left+u.offset.left+u.width,a+o),v.left))):(j>0&&(i.x!=="left"||m>0)?v.left-=o+c:m>0&&(i.x!=="right"||j>0)&&(v.left-=(q?-o:o)+c),v.left<d&&-v.left>m&&(v.left=a));return v.left-a},top:function(a){var b=E.vertical==="shift",c=l.y*(E.vertical.substr(-6)==="invert"?2:0),d=-w.offset.top+u.offset.top+u.scrollTop,e=i.y==="top"?o:i.y==="bottom"?-o:-o/2,f=k.y==="top"?q:k.y==="bottom"?-q:-q/2,g=A&&A.size?A.size.height||0:0,h=A&&A.corner&&A.corner.precedance==="y"&&!b?g:0,j=d-a+h,m=a+o-u.height-d+h,n=e-(i.precedance==="y"||i.x===i.y?f:0)-(k.y==="center"?q/2:0),p=i.y==="center";b?(h=A&&A.corner&&A.corner.precedance==="x"?g:0,n=(i.y==="top"?1:-1)*e-h,v.top+=j>0?j:m>0?-m:0,v.top=Math.max(-w.offset.top+u.offset.top+(h&&A.corner.x==="center"?A.offset:0),a-n,Math.min(Math.max(-w.offset.top+u.offset.top+u.height,a+n),v.top))):(j>0&&(i.y!=="top"||m>0)?v.top-=n+c:m>0&&(i.y!=="bottom"||j>0)&&(v.top-=(p?-n:n)+c),v.top<0&&-v.top>m&&(v.top=a));return v.top-a}},H;if(a.isArray(e)&&e.length===2)k={x:"left",y:"top"},v={left:e[0],top:e[1]};else if(e==="mouse"&&(b&&b.pageX||G.event.pageX))k={x:"left",y:"top"},b=(b&&(b.type==="resize"||b.type==="scroll")?G.event:b&&b.pageX&&b.type==="mousemove"?b:h&&h.pageX&&(l.mouse||!b||!b.pageX)?{pageX:h.pageX,pageY:h.pageY}:!l.mouse&&G.origin&&G.origin.pageX&&s.show.distance?G.origin:b)||b||G.event||h||{},v={top:b.pageY,left:b.pageX};else{e==="event"?b&&b.target&&b.type!=="scroll"&&b.type!=="resize"?e=G.target=a(b.target):e=G.target:e=G.target=a(e.jquery?e:F.target),e=a(e).eq(0);if(e.length===0)return y;e[0]===document||e[0]===window?(p=g.iOS?window.innerWidth:e.width(),q=g.iOS?window.innerHeight:e.height(),e[0]===window&&(v={top:(u||e).scrollTop(),left:(u||e).scrollLeft()})):e.is("area")&&g.imagemap?v=g.imagemap(e,k,E.enabled?m:c):e[0].namespaceURI==="http://www.w3.org/2000/svg"&&g.svg?v=g.svg(e,k):(p=e.outerWidth(),q=e.outerHeight(),v=g.offset(e,w)),v.offset&&(p=v.width,q=v.height,x=v.flipoffset,v=v.offset);if(g.iOS>3.1&&g.iOS<4.1||g.iOS>=4.3&&g.iOS<4.33||!g.iOS&&t)H=a(window),v.left-=H.scrollLeft(),v.top-=H.scrollTop();v.left+=k.x==="right"?p:k.x==="center"?p/2:0,v.top+=k.y==="bottom"?q:k.y==="center"?q/2:0}v.left+=l.x+(i.x==="right"?-n:i.x==="center"?-n/2:0),v.top+=l.y+(i.y==="bottom"?-o:i.y==="center"?-o/2:0),E.enabled?(u={elem:u,height:u[(u[0]===window?"h":"outerH")+"eight"](),width:u[(u[0]===window?"w":"outerW")+"idth"](),scrollLeft:t?0:u.scrollLeft(),scrollTop:t?0:u.scrollTop(),offset:u.offset()||{left:0,top:0}},w={elem:w,scrollLeft:w.scrollLeft(),scrollTop:w.scrollTop(),offset:w.offset()||{left:0,top:0}},v.adjusted={left:E.horizontal!=="none"?E.left(v.left):0,top:E.vertical!=="none"?E.top(v.top):0},v.adjusted.left+v.adjusted.top&&D.attr("class",D[0].className.replace(/ui-tooltip-pos-\w+/i,j+"-pos-"+i.abbrev())),x&&v.adjusted.left&&(v.left+=x.left),x&&v.adjusted.top&&(v.top+=x.top)):v.adjusted={left:0,top:0},r.originalEvent=a.extend({},b),D.trigger(r,[y,v,u.elem||u]);if(r.isDefaultPrevented())return y;delete v.adjusted,d===c||!C||isNaN(v.left)||isNaN(v.top)||e==="mouse"||!a.isFunction(f.effect)?D.css(v):a.isFunction(f.effect)&&(f.effect.call(D,y,a.extend({},v)),D.queue(function(b){a(this).css({opacity:"",height:""}),a.browser.msie&&this.style.removeAttribute("filter"),b()})),B=0;return y},redraw:function(){if(y.rendered<1||C)return y;var a=s.position.container,b,c,d,e;C=1,s.style.height&&D.css("height",s.style.height),s.style.width?D.css("width",s.style.width):(D.css("width","").addClass(q),c=D.width()+1,d=D.css("max-width")||"",e=D.css("min-width")||"",b=(d+e).indexOf("%")>-1?a.width()/100:0,d=(d.indexOf("%")>-1?b:1)*parseInt(d,10)||c,e=(e.indexOf("%")>-1?b:1)*parseInt(e,10)||0,c=d+e?Math.min(Math.max(c,e),d):c,D.css("width",Math.round(c)).removeClass(q)),C=0;return y},disable:function(b){"boolean"!==typeof b&&(b=!D.hasClass(l)&&!G.disabled),y.rendered?(D.toggleClass(l,b),a.attr(D[0],"aria-disabled",b)):G.disabled=!!b;return y},enable:function(){return y.disable(c)},destroy:function(){var c=r[0],d=a.attr(c,t),e=r.data("qtip");y.destroyed=b,y.rendered&&(D.stop(1,0).remove(),a.each(y.plugins,function(){this.destroy&&this.destroy()})),clearTimeout(y.timers.show),clearTimeout(y.timers.hide),Q();if(!e||y===e)a.removeData(c,"qtip"),s.suppress&&d&&(a.attr(c,"title",d),r.removeAttr(t)),r.removeAttr("aria-describedby");r.unbind(".qtip-"+v),delete i[y.id];return r}})}function w(b){var e;if(!b||"object"!==typeof b)return c;if(b.metadata===d||"object"!==typeof b.metadata)b.metadata={type:b.metadata};if("content"in b){if(b.content===d||"object"!==typeof b.content||b.content.jquery)b.content={text:b.content};e=b.content.text||c,!a.isFunction(e)&&(!e&&!e.attr||e.length<1||"object"===typeof e&&!e.jquery)&&(b.content.text=c);if("title"in b.content){if(b.content.title===d||"object"!==typeof b.content.title)b.content.title={text:b.content.title};e=b.content.title.text||c,!a.isFunction(e)&&(!e&&!e.attr||e.length<1||"object"===typeof e&&!e.jquery)&&(b.content.title.text=c)}}if("position"in b)if(b.position===d||"object"!==typeof b.position)b.position={my:b.position,at:b.position};if("show"in b)if(b.show===d||"object"!==typeof b.show)b.show.jquery?b.show={target:b.show}:b.show={event:b.show};if("hide"in b)if(b.hide===d||"object"!==typeof b.hide)b.hide.jquery?b.hide={target:b.hide}:b.hide={event:b.hide};if("style"in b)if(b.style===d||"object"!==typeof b.style)b.style={classes:b.style};a.each(g,function(){this.sanitize&&this.sanitize(b)});return b}function v(){v.history=v.history||[],v.history.push(arguments);if("object"===typeof console){var a=console[console.warn?"warn":"log"],b=Array.prototype.slice.call(arguments),c;typeof arguments[0]==="string"&&(b[0]="qTip2: "+b[0]),c=a.apply?a.apply(console,b):a(b)}}"use strict";var b=!0,c=!1,d=null,e,f,g,h,i={},j="ui-tooltip",k="ui-widget",l="ui-state-disabled",m="div.qtip."+j,n=j+"-default",o=j+"-focus",p=j+"-hover",q=j+"-fluid",r="-31000px",s="_replacedByqTip",t="oldtitle",u;f=a.fn.qtip=function(g,h,i){var j=(""+g).toLowerCase(),k=d,l=a.makeArray(arguments).slice(1),m=l[l.length-1],n=this[0]?a.data(this[0],"qtip"):d;if(!arguments.length&&n||j==="api")return n;if("string"===typeof g){this.each(function(){var d=a.data(this,"qtip");if(!d)return b;m&&m.timeStamp&&(d.cache.event=m);if(j!=="option"&&j!=="options"||!h)d[j]&&d[j].apply(d[j],l);else if(a.isPlainObject(h)||i!==e)d.set(h,i);else{k=d.get(h);return c}});return k!==d?k:this}if("object"===typeof g||!arguments.length){n=w(a.extend(b,{},g));return f.bind.call(this,n,m)}},f.bind=function(d,j){return this.each(function(k){function r(b){function d(){p.render(typeof b==="object"||l.show.ready),m.show.add(m.hide).unbind(o)}if(p.cache.disabled)return c;p.cache.event=a.extend({},b),p.cache.target=b?a(b.target):[e],l.show.delay>0?(clearTimeout(p.timers.show),p.timers.show=setTimeout(d,l.show.delay),n.show!==n.hide&&m.hide.bind(n.hide,function(){clearTimeout(p.timers.show)})):d()}var l,m,n,o,p,q;q=a.isArray(d.id)?d.id[k]:d.id,q=!q||q===c||q.length<1||i[q]?f.nextid++:i[q]=q,o=".qtip-"+q+"-create",p=y.call(this,q,d);if(p===c)return b;l=p.options,a.each(g,function(){this.initialize==="initialize"&&this(p)}),m={show:l.show.target,hide:l.hide.target},n={show:a.trim(""+l.show.event).replace(/ /g,o+" ")+o,hide:a.trim(""+l.hide.event).replace(/ /g,o+" ")+o},/mouse(over|enter)/i.test(n.show)&&!/mouse(out|leave)/i.test(n.hide)&&(n.hide+=" mouseleave"+o),m.show.bind("mousemove"+o,function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"},p.cache.onTarget=b}),m.show.bind(n.show,r),(l.show.ready||l.prerender)&&r(j)})},g=f.plugins={Corner:function(a){a=(""+a).replace(/([A-Z])/," $1").replace(/middle/gi,"center").toLowerCase(),this.x=(a.match(/left|right/i)||a.match(/center/)||["inherit"])[0].toLowerCase(),this.y=(a.match(/top|bottom|center/i)||["inherit"])[0].toLowerCase();var b=a.charAt(0);this.precedance=b==="t"||b==="b"?"y":"x",this.string=function(){return this.precedance==="y"?this.y+this.x:this.x+this.y},this.abbrev=function(){var a=this.x.substr(0,1),b=this.y.substr(0,1);return a===b?a:a==="c"||a!=="c"&&b!=="c"?b+a:a+b},this.clone=function(){return{x:this.x,y:this.y,precedance:this.precedance,string:this.string,abbrev:this.abbrev,clone:this.clone}}},offset:function(b,c){function j(a,b){d.left+=b*a.scrollLeft(),d.top+=b*a.scrollTop()}var d=b.offset(),e=b.closest("body")[0],f=c,g,h,i;if(f){do f.css("position")!=="static"&&(h=f.position(),d.left-=h.left+(parseInt(f.css("borderLeftWidth"),10)||0)+(parseInt(f.css("marginLeft"),10)||0),d.top-=h.top+(parseInt(f.css("borderTopWidth"),10)||0)+(parseInt(f.css("marginTop"),10)||0),!g&&(i=f.css("overflow"))!=="hidden"&&i!=="visible"&&(g=f));while((f=a(f[0].offsetParent)).length);g&&g[0]!==e&&j(g,1)}return d},iOS:parseFloat((""+(/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent)||[0,""])[1]).replace("undefined","3_2").replace("_",".").replace("_",""))||c,fn:{attr:function(b,c){if(this.length){var d=this[0],e="title",f=a.data(d,"qtip");if(b===e&&f&&"object"===typeof f&&f.options.suppress){if(arguments.length<2)return a.attr(d,t);f&&f.options.content.attr===e&&f.cache.attr&&f.set("content.text",c);return this.attr(t,c)}}return a.fn["attr"+s].apply(this,arguments)},clone:function(b){var c=a([]),d="title",e=a.fn["clone"+s].apply(this,arguments);b||e.filter("["+t+"]").attr("title",function(){return a.attr(this,t)}).removeAttr(t);return e}}},a.each(g.fn,function(c,d){if(!d||a.fn[c+s])return b;var e=a.fn[c+s]=a.fn[c];a.fn[c]=function(){return d.apply(this,arguments)||e.apply(this,arguments)}}),a.ui||(a["cleanData"+s]=a.cleanData,a.cleanData=function(b){for(var c=0,d;(d=b[c])!==e;c++)try{a(d).triggerHandler("removeqtip")}catch(f){}a["cleanData"+s](b)}),f.version="nightly",f.nextid=0,f.inactiveEvents="click dblclick mousedown mouseup mousemove mouseleave mouseenter".split(" "),f.zindex=15e3,f.defaults={prerender:c,id:c,overwrite:b,suppress:b,content:{text:b,attr:"title",title:{text:c,button:c}},position:{my:"top left",at:"bottom right",target:c,container:c,viewport:c,adjust:{x:0,y:0,mouse:b,resize:b,method:"flip flip"},effect:function(b,d,e){a(this).animate(d,{duration:200,queue:c})}},show:{target:c,event:"mouseenter",effect:b,delay:90,solo:c,ready:c,autofocus:c},hide:{target:c,event:"mouseleave",effect:b,delay:0,fixed:c,inactive:c,leave:"window",distance:c},style:{classes:"",widget:c,width:c,height:c,def:b},events:{render:d,move:d,show:d,hide:d,toggle:d,visible:d,hidden:d,focus:d,blur:d}},g.tip=function(a){var b=a.plugins.tip;return"object"===typeof b?b:a.plugins.tip=new A(a)},g.tip.initialize="render",g.tip.sanitize=function(a){var c=a.style,d;c&&"tip"in c&&(d=a.style.tip,typeof d!=="object"&&(a.style.tip={corner:d}),/string|boolean/i.test(typeof d.corner)||(d.corner=b),typeof d.width!=="number"&&delete d.width,typeof d.height!=="number"&&delete d.height,typeof d.border!=="number"&&d.border!==b&&delete d.border,typeof d.offset!=="number"&&delete d.offset)},a.extend(b,f.defaults,{style:{tip:{corner:b,mimic:c,width:6,height:6,border:b,offset:0}}})})

$(document).ready(function()
{
  // Match all <A/> links with a title tag and use it as the content (default).
  $('li a.avatar[title]').qtip({
  style: {
    classes: 'ui-tooltip-bootstrap'
  },
  position: {
    my: 'bottom center',  // Position my top left...
    at: 'top center', // at the bottom right of...
    target: 'a[title]'
  }
  });

  changeTipGrav();
});

$(window).resize(function() {
  changeTipGrav();
});

// Change qtip gravity depending on container size
function changeTipGrav() {
  var ww = $(window).width();
  var tgnew = false;
  if(typeof tg == 'undefined') {
    if(ww >= 1030 && !isEmbed) tgnew = ['bottom center','top center'];
    else if(ww >= 1030) tgnew = ['top center', 'bottom center'];
    else tgnew = ['top right', 'bottom center'];
  } else {
    if(ww < 1030 && (tg[0] == 'bottom center' || tg[0] == 'top center'))
      tgnew = ['top right','bottom center'];
    if(ww >= 1030 && tg[0] == 'top right' && !isEmbed)
      tgnew = ['bottom center','top center'];
    if(ww >= 1030 && tg[0] == 'top right' && isEmbed)
      tgnew = ['top center','bottom center'];
  }
  if(tgnew != false) {
    tg = tgnew;
    $('a.title-tooltip').qtip({style:{classes:'ui-tooltip-bootstrap'},position:{my:tg[0],at:tg[1],target:'a[title]'}});
  }
}

$(function(){

    $("#header-profile li").hover(function(){

        $(this).addClass("hover");
        $('ul:first',this).css('display', 'block');

    }, function(){

        $(this).removeClass("hover");
        $('ul:first',this).css('display', 'none');

    });

});


/* ============================================================
 * bootstrap-dropdown.js v2.3.0
 * http://twitter.github.com/bootstrap/javascript.html#dropdowns
 * ============================================================
 * Copyright 2012 Twitter, Inc.
 * ============================================================ */


!function ($) {

  "use strict"; // jshint ;_;


 /* DROPDOWN CLASS DEFINITION
  * ========================= */

  var toggle = '[data-toggle=dropdown]'
    , Dropdown = function (element) {
        var $el = $(element).on('click.dropdown.data-api', this.toggle)
        $('html').on('click.dropdown.data-api', function () {
          $el.parent().removeClass('open')
        })
      }

  Dropdown.prototype = {

    constructor: Dropdown

  , toggle: function (e) {
      var $this = $(this)
        , $parent
        , isActive

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      clearMenus()

      if (!isActive) {
        $parent.toggleClass('open')
      }

      $this.focus()

      return false
    }

  , keydown: function (e) {
      var $this
        , $items
        , $active
        , $parent
        , isActive
        , index

      if (!/(38|40|27)/.test(e.keyCode)) return

      $this = $(this)

      e.preventDefault()
      e.stopPropagation()

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      if (!isActive || (isActive && e.keyCode == 27)) {
        if (e.which == 27) $parent.find(toggle).focus()
        return $this.click()
      }

      $items = $('[role=menu] li:not(.divider):visible a', $parent)

      if (!$items.length) return

      index = $items.index($items.filter(':focus'))

      if (e.keyCode == 38 && index > 0) index--                                        // up
      if (e.keyCode == 40 && index < $items.length - 1) index++                        // down
      if (!~index) index = 0

      $items
        .eq(index)
        .focus()
    }

  }

  function clearMenus() {
    $(toggle).each(function () {
      getParent($(this)).removeClass('open')
    })
  }

  function getParent($this) {
    var selector = $this.attr('data-target')
      , $parent

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && /#/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
    }

    $parent = selector && $(selector)

    if (!$parent || !$parent.length) $parent = $this.parent()

    return $parent
  }


  /* DROPDOWN PLUGIN DEFINITION
   * ========================== */

  var old = $.fn.dropdown

  $.fn.dropdown = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('dropdown')
      if (!data) $this.data('dropdown', (data = new Dropdown(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  $.fn.dropdown.Constructor = Dropdown


 /* DROPDOWN NO CONFLICT
  * ==================== */

  $.fn.dropdown.noConflict = function () {
    $.fn.dropdown = old
    return this
  }


  /* APPLY TO STANDARD DROPDOWN ELEMENTS
   * =================================== */

  $(document)
    .on('click.dropdown.data-api', clearMenus)
    .on('click.dropdown.data-api', '.dropdown form', function (e) { e.stopPropagation() })
    .on('.dropdown-menu', function (e) { e.stopPropagation() })
    .on('click.dropdown.data-api'  , toggle, Dropdown.prototype.toggle)
    .on('keydown.dropdown.data-api', toggle + ', [role=menu]' , Dropdown.prototype.keydown)

}(window.jQuery);
