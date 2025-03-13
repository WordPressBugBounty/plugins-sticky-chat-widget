!function(e){"use strict";var a=[],t="",s="";function d(){var a=e("#filter-end-date").val(),t=e("#filter-start-date").val();""!=a&&(e("#filter-start-date").datetimepicker("destroy"),e("#filter-start-date").datetimepicker({format:"Y-m-d",maxDateTime:a,timepicker:!1})),""!=t&&(e("#filter-end-date").datetimepicker("destroy"),e("#filter-end-date").datetimepicker({format:"Y-m-d",minDateTime:t,timepicker:!1}))}e(document).on("ready",(function(){e(document).on("click",".ajax-pagination a",(function(a){a.preventDefault();var t=e(this).prop("href");e(".gp-loader").addClass("disabled");var s=new URLSearchParams(t).get("paged"),d=new URL(window.location.href),o=d.searchParams;null!=s?o.set("paged",s):o.set("paged",1),d.search=o.toString();var n=d.toString();history.replaceState({},"",n),e("#ajax-table").load(n+" #ajax-table-data",(function(){e(".gp-loader").removeClass("disabled")}))})),e(document).on("mouseenter",".col-link a",(function(){e(this).addClass("active-tooltip")})),e(document).on("mouseleave",".col-link a",(function(){e(this).removeClass("active-tooltip")})),e(document).on("click",".leads-export:not(.disabled)",(function(a){e(this).addClass("disabled"),a.preventDefault();var t=new URLSearchParams(window.location.href),s=t.get("start_date"),d=t.get("end_date"),o=t.get("search_lead");e.ajax({type:"POST",url:LEADS_DATA.AJAX_URL,data:{start_date:s,end_date:d,search:o,action:"scw_leads_download_csv",nonce:e(this).attr("data-nonce")},success:function(a){var t=document.createElement("a"),s=new Blob(["\ufeff"+a],{type:"text/csv;charset=utf-8;"}),d=URL.createObjectURL(s);t.href=d;var o=e.now();t.download="report-"+o+".csv",document.body.appendChild(t),t.click(),document.body.removeChild(t),e(".leads-export").removeClass("disabled")}})})),e(document).on("change",".leads_selected",(function(){e(".leads-record .leads_selected:checked").length>0?e(".action-btn-row .gp-action-button.danger.delete-leads").removeClass("disabled"):e(".action-btn-row .gp-action-button.danger.delete-leads").addClass("disabled")})),e(document).on("click",".delete-leads:not(.disabled)",(function(){e(".leads-record .leads_selected:checked").each((function(){a.push(e(this).val())})),e("#delete-leads").addClass("active")})),e(document).on("click",".delete-all-leads",(function(){e("#delete-all-leads").addClass("active")})),e(document).on("click",".delete-single-lead",(function(){t=e(this).attr("data-id"),s=e(this).attr("data-nonce"),e("#delete-single-lead").addClass("active")})),e(document).on("click","#delete_leads",(function(t){e(this).addClass("disabled"),e(this).closest(".gp-modal").find(".gp-modal-content").addClass("form-loading"),t.preventDefault(),e.ajax({url:LEADS_DATA.AJAX_URL,data:{ids:a,action:"gsb_buttons_remove_leads",nonce:e("#remove_leads_nonce").val()},type:"post",success:function(a){e("#delete-leads").removeClass("active"),e("#delete-leads").removeClass("disabled"),e(this).closest(".gp-modal").find(".gp-modal-content").removeClass("form-loading"),a=e.parseJSON(a);var t=new SwipeHandler,s=new ToastsHandler(t);1==a.status?(s.createToast({type:"success",icon:"info-circle",message:a.message,duration:5e3}),setTimeout((function(){window.location.reload()}),1e3)):(e(".save-changes").prop("disabled",!1),s.createToast({type:"error",icon:"info-circle",message:a.message,duration:5e3}))}})})),e(document).on("click","#delete_single_lead",(function(a){e(this).addClass("disabled"),e(this).closest(".gp-modal").find(".gp-modal-content").addClass("form-loading"),a.preventDefault(),e.ajax({url:LEADS_DATA.AJAX_URL,data:{id:t,action:"gsb_buttons_remove_single_lead",nonce:s},type:"post",success:function(a){e("#delete-single-lead").removeClass("active"),e("#delete_single_lead").removeClass("disabled"),e(this).closest(".gp-modal").find(".gp-modal-content").removeClass("form-loading"),a=e.parseJSON(a);var t=new SwipeHandler,s=new ToastsHandler(t);1==a.status?(s.createToast({type:"success",icon:"info-circle",message:a.message,duration:5e3}),setTimeout((function(){window.location.reload()}),1e3)):(e(".save-changes").prop("disabled",!1),s.createToast({type:"error",icon:"info-circle",message:a.message,duration:5e3}))}})})),e(document).on("click","#delete_all_leads",(function(t){e(this).addClass("disabled"),e(this).closest(".gp-modal").find(".gp-modal-content").addClass("form-loading"),t.preventDefault(),e.ajax({url:LEADS_DATA.AJAX_URL,data:{ids:a,action:"gsb_buttons_remove_all_leads",nonce:e("#remove_all_leads_nonce").val()},type:"post",success:function(a){e("#delete-all-leads").removeClass("active"),e("#delete-all-leads").removeClass("disabled"),e(this).closest(".gp-modal").find(".gp-modal-content").removeClass("form-loading"),a=e.parseJSON(a);var t=new SwipeHandler,s=new ToastsHandler(t);1==a.status?(s.createToast({type:"success",icon:"info-circle",message:a.message,duration:5e3}),setTimeout((function(){window.location.reload()}),1e3)):(e(".save-changes").prop("disabled",!1),s.createToast({type:"error",icon:"info-circle",message:a.message,duration:5e3}))}})})),e(document).on("click",".hide-gp-modal , .gp-modal-close-btn, .gp-modal-bg",(function(){e(".gp-modal").removeClass("active")})),e(document).on("keyup",(function(a){27==a.which&&e(".gp-modal").removeClass("active")})),e("#filter-start-date").datetimepicker({format:"Y-m-d",closeOnDateSelect:!0,closeOnTimeSelect:!0,timepicker:!1}).on("change",(function(){d()})),e("#filter-end-date").datetimepicker({format:"Y-m-d",closeOnDateSelect:!0,closeOnTimeSelect:!1,timepicker:!1}).on("change",(function(){d()})),e(document).on("click",".submit-filter",(function(a){a.preventDefault();var t=e(this).closest(".filter-inputs").find("#filter-start-date").val(),s=e(this).closest(".filter-inputs").find("#filter-end-date").val(),d=e(this).closest(".filter-inputs").find("#search-filter").val(),o=new URL(window.location.href),n=o.searchParams;n.set("start_date",t),n.set("end_date",s),n.set("search_lead",d),1==new URLSearchParams(window.location.href).get("paged")&&n.delete("paged"),o.search=n.toString();var l=o.toString();history.replaceState({},"",l),e("#ajax-table").load(l+" #ajax-table-data",(function(){e(".gp-loader").removeClass("disabled")}))}))}))}(jQuery);