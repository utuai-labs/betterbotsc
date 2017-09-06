<!-- start uTu -->
<script type="text/javascript">
  !function(){window.utu={queue:[],init:function(e){var t=this.getBrowserInformation();this.token=e,this.context={platform:window.location.host,platformId:null,values:{browser:t[0],browserVersion:t[1],userAgent:navigator.userAgent}},this.setPlatformID(),this.getGeoInfo(),this.queueTracking=setInterval(this.checkQueue.bind(this),1e3)},checkQueue:function(){if(!this.fetchingID&&this.queue.length>0){for(var e=0;e<this.queue.length-1;e++)try{this.queue[e]()}catch(t){this.queue.splice(e,1)}clearInterval(this.queueTracking),this.queue=[]}},track:function(e,t,n){var i=this,a=function(e,t){var a=i.merge(i.context,{event:e});t&&(a.values=i.merge(a.values,t)),i.request("https://api.utu.ai/v1/track",{data:JSON.stringify(a),callback:n||function(){},setHeaders:function(e){e.setRequestHeader("apikey",i.token)}})};i.fetchingID?this.queue.push(function(){a(e,t)}):a(e,t)},identity:function(e,t){var n=this,i=function(e){var i=n.context.platform,a=n.context.platformId,o=n.merge({custom:{}},e);o.custom=n.merge(o.custom,n.context.values),n.request("https://api.utu.ai/v1/identity/"+i+"/"+a,{data:JSON.stringify(o),callback:t||function(){},setHeaders:function(e){e.setRequestHeader("apikey",n.token)}})};n.fetchingID?this.queue.push(function(){i(e)}):i(e)},getBrowserInformation:function(){var e,t=navigator.appName,n=navigator.userAgent,i=n.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);return i&&null!=(e=n.match(/version\/([\.\d]+)/i))&&(i[2]=e[1]),i=i?[i[1],i[2]]:[t,navigator.appVersion,"-?"]},createUUID:function(e){var t=this;t.fetchingID=!0,this.request("https://makenu.utu.ai/v1/browser-id",{callback:function(n){var i=JSON.parse(n);i&&i.data&&i.data.id&&(e(i.data.id),t.fetchingID=!1)}})},getGeoInfo:function(){var e=this;this.request("https://ipinfo.io/json",{callback:function(t){if(t)try{e.context.values=e.merge(e.context.values,JSON.parse(t))}catch(e){console.log(e)}}})},setPlatformID:function(){var e=this.readCookie("utu-uid"),t=this;e?(this.createCookie("utu-uid",e,1825),this.context.platformId=e):this.createUUID(function(e){t.createCookie("utu-uid",e,1825),t.context.platformId=e})},merge:function(){return JSON.parse("{"+[].reduce.call(arguments,function(e,t){var n=JSON.stringify(t);if(!n||"{"!==n.slice(0,1)||"}"!==n.slice(-1))throw new Error("Invalid object: "+n);return(e?e+",":"")+n.slice(1,-1)},null)+"}")},request:function(e,t){try{var n=new(window.XMLHttpRequest||ActiveXObject)("MSXML2.XMLHTTP.3.0");n.open(t.data?"POST":"GET",e,1),n.setRequestHeader("Content-type","application/json"),t.setHeaders&&t.setHeaders(n),n.onreadystatechange=function(){n.readyState>3&&t.callback&&t.callback(n.responseText,n)},n.send(t.data)}catch(e){window.console&&console.log(e)}},createCookie:function(e,t,n){if(n){var i=new Date;i.setTime(i.getTime()+24*n*60*60*1e3);a="; expires="+i.toGMTString()}else var a="";document.cookie=e+"="+t+a+"; domain=."+location.hostname.split(".").reverse()[1]+"."+location.hostname.split(".").reverse()[0]+"; path=/"},readCookie:function(e){for(var t=e+"=",n=document.cookie.split(";"),i=0;i<n.length;i++){for(var a=n[i];" "==a.charAt(0);)a=a.substring(1,a.length);if(0==a.indexOf(t))return a.substring(t.length,a.length)}return null}}}();

  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

  utu.init("<?php echo $settings['token_id']; ?>");

  let ls = getParameterByName('ls');
  utu.identity({
    custom: {
      leadSource: ls || 'organic'
    }
  });

</script>
<!--q end uTu -->
