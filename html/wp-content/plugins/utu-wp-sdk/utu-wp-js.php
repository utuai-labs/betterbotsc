<!-- start uTu -->
<script type="text/javascript">
	!function(){window.utu={queue:[],init:function(t){var e=this.getBrowserInformation();this.token=t,this.context={platform:window.location.host,platformId:null,web:!0,values:{browser:e[0],browserVersion:e[1],userAgent:navigator.userAgent}},this.setPlatformID(),this.getGeoInfo(),this.queueTracking=setInterval(this.checkQueue.bind(this),1e3)},checkQueue:function(){if(!this.fetchingID&&this.queue.length>0){for(var t=0;t<this.queue.length-1;t++)try{this.queue[t]()}catch(e){this.queue.splice(t,1)}clearInterval(this.queueTracking),this.queue=[]}},track:function(t,e,i){var n=this,a=function(t,e){var a=n.merge(n.context,{event:t});e&&(a.values=n.merge(a.values,e)),n.request("https://api.utu.ai/v1/track",{data:JSON.stringify(a),callback:i||function(){},setHeaders:function(t){t.setRequestHeader("apikey",n.token)}})};n.fetchingID?this.queue.push(function(){a(t,e)}):a(t,e)},identity:function(t,e){if(!t)throw new Error("identity must have values `utu.identity({ name: 'john doe' })`");var i=this,n=function(t){var n=i.context.platform,a=i.context.platformId,o=i.merge({custom:{}},t);o.custom=i.merge(o.custom,i.context.values),i.request("https://api.utu.ai/v1/identity/"+n+"/"+a,{data:JSON.stringify(o),callback:e||function(){},setHeaders:function(t){t.setRequestHeader("apikey",i.token)}})};i.fetchingID?this.queue.push(function(){n(t)}):n(t)},alias:function(t){if(!t)throw new Error("alias must have id `utu.alias('123')`");var e=this,i=function(t){var i=e.context.platform,n=e.context.platformId;e.request("https://api.utu.ai/v1/identity/"+i+"/"+n+"/alias",{data:JSON.stringify({id:t}),setHeaders:function(t){t.setRequestHeader("apikey",e.token)}})};e.fetchingID?this.queue.push(function(){i(t)}):i(t)},getBrowserInformation:function(){var t,e=navigator.appName,i=navigator.userAgent,n=i.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);return n&&null!=(t=i.match(/version\/([\.\d]+)/i))&&(n[2]=t[1]),n=n?[n[1],n[2]]:[e,navigator.appVersion,"-?"]},createUUID:function(t){var e=this;e.fetchingID=!0,this.request("https://makenu.utu.ai/v1/browser-id",{callback:function(i){var n=JSON.parse(i);n&&n.data&&n.data.id&&(t(n.data.id),e.fetchingID=!1)}})},getGeoInfo:function(){var t=this;this.request("https://ipinfo.io/json",{callback:function(e){if(e)try{t.context.values=t.merge(t.context.values,JSON.parse(e))}catch(i){console.log(i)}}})},setPlatformID:function(){var t=this.readCookie("utu-uid"),e=this;t?(this.createCookie("utu-uid",t,1825),this.context.platformId=t):this.createUUID(function(t){e.createCookie("utu-uid",t,1825),e.context.platformId=t})},merge:function(){return JSON.parse("{"+[].reduce.call(arguments,function(t,e){var i=JSON.stringify(e);if(!i||"{"!==i.slice(0,1)||"}"!==i.slice(-1))throw new Error("Invalid object: "+i);return(t?t+",":"")+i.slice(1,-1)},null)+"}")},request:function(t,e){try{var i=new(window.XMLHttpRequest||ActiveXObject)("MSXML2.XMLHTTP.3.0");i.open(e.data?"POST":"GET",t,1),i.setRequestHeader("Content-type","application/json"),e.setHeaders&&e.setHeaders(i),i.onreadystatechange=function(){i.readyState>3&&e.callback&&e.callback(i.responseText,i)},i.send(e.data)}catch(n){window.console&&console.log(n)}},createCookie:function(t,e,i){if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3);var a="; expires="+n.toGMTString()}else var a="";document.cookie=t+"="+e+a+"; domain=."+location.hostname.split(".").reverse()[1]+"."+location.hostname.split(".").reverse()[0]+"; path=/"},readCookie:function(t){for(var e=t+"=",i=document.cookie.split(";"),n=0;n<i.length;n++){for(var a=i[n];" "==a.charAt(0);)a=a.substring(1,a.length);if(0==a.indexOf(e))return a.substring(e.length,a.length)}return null}}}();
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
