(function(e){var t=[];var r=e("#state-selector #state");var a=e("#state-selector .text-danger");e("#state-selector #state option").each(function(){if(e(this).val()){t.push({label:e(this).html(),value:e(this).val(),country:e(this).data("country")})}});function o(){a.hide();r.html("");r.attr("disabled","disabled")}function i(){e("#app-lib-register-download").parsley()}e("#country-selector #country").on("change",function(){var s=e(this).val();o();e.each(t,function(){if(this.country==s){r.append('<option value="'+this.value+'">'+this.label+"</option>")}});if(e("#state-selector #state option").length){a.show();r.prepend('<option value="" selected="selected"></option>');r.attr("required","required");r.attr("data-parsley-required","true");r.removeAttr("disabled")}else{r.prepend('<option value="0" selected="selected"></option>');r.removeAttr("required");r.removeAttr("data-parsley-required")}i()});o();i()})(jQuery);