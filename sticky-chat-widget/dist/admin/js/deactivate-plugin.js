(()=>{var e,t={876:()=>{!function(e){"use strict";var t="sticky-chat-widget",o=0;e(document).ready((function(){e(document).on("click","."+t+"-close-button",(function(){e("#"+t+"-popup-form").hide()})),e(document).on("click",'tr[data-slug="'+t+'"] .deactivate',(function(o){o.preventDefault(),e("#"+t+"-popup-form").show()})),e(document).on("click","."+t+"-skip-feedback",(function(){e("#"+t+"-popup-form").hide(),window.location.href=e("tr[data-slug='"+t+"'] .deactivate a").attr("href")})),e(document).on("click","."+t+"-close-button",(function(){e("#"+t+"-popup-form").hide()})),e(document).on("submit","#"+t+"-deactivate-form",(function(){return o=0,e("#"+t+"-deactivate-form .error-message").remove(),e("#"+t+"-deactivate-form .input-error").removeClass("input-error"),""==e.trim(e("#deactivate_comment-"+t).val())&&(e("#deactivate_comment-"+t).addClass("input-error"),e("#deactivate_comment-"+t).after("<span class='error-message'>"+SCW_SETTINGS.required_message+"</span>"),o++),0==o&&(e("."+t+"-loader").addClass("active"),e("."+t+"-popup-submit").attr("disabled","disabled"),e.ajax({url:SCW_SETTINGS.ajax_url,type:"POST",data:e("#"+t+"-deactivate-form").serialize()}).done((function(){e("#"+t+"-popup-form").hide(),window.location.href=e("tr[data-slug='"+t+"'] .deactivate a").attr("href")}))),!1}))}))}(jQuery)},344:()=>{},793:()=>{},878:()=>{},725:()=>{},490:()=>{},382:()=>{},112:()=>{},853:()=>{},56:()=>{},608:()=>{}},o={};function r(e){var a=o[e];if(void 0!==a)return a.exports;var i=o[e]={exports:{}};return t[e](i,i.exports,r),i.exports}r.m=t,e=[],r.O=(t,o,a,i)=>{if(!o){var n=1/0;for(s=0;s<e.length;s++){for(var[o,a,i]=e[s],c=!0,d=0;d<o.length;d++)(!1&i||n>=i)&&Object.keys(r.O).every((e=>r.O[e](o[d])))?o.splice(d--,1):(c=!1,i<n&&(n=i));if(c){e.splice(s--,1);var u=a();void 0!==u&&(t=u)}}return t}i=i||0;for(var s=e.length;s>0&&e[s-1][2]>i;s--)e[s]=e[s-1];e[s]=[o,a,i]},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={455:0,275:0,885:0,281:0,188:0,267:0,445:0,987:0,132:0,652:0,409:0};r.O.j=t=>0===e[t];var t=(t,o)=>{var a,i,[n,c,d]=o,u=0;if(n.some((t=>0!==e[t]))){for(a in c)r.o(c,a)&&(r.m[a]=c[a]);if(d)var s=d(r)}for(t&&t(o);u<n.length;u++)i=n[u],r.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return r.O(s)},o=self.webpackChunksticky_chat_widget=self.webpackChunksticky_chat_widget||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})(),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(876))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(382))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(112))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(853))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(56))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(608))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(344))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(793))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(878))),r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(725)));var a=r.O(void 0,[275,885,281,188,267,445,987,132,652,409],(()=>r(490)));a=r.O(a)})();