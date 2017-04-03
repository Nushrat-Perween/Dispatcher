/**
Address editable input.
Internally value stored as {city: "Moscow", street: "Lenina", building: "15"}

@class address
@extends abstractinput
@final
@example
<a href="#" id="address" data-type="address" data-pk="1">awesome</a>
<script>
$(function(){
    $('#address').editable({
        url: '/post',
        title: 'Enter city, street and building #',
        value: {
            city: "Moscow", 
            street: "Lenina", 
            building: "15"
        }
    });
});
</script>
**/
(function ($) {
    "use strict";
    
    var Address = function (options) {
        this.init('address', options, Address.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(Address, $.fn.editabletypes.abstractinput);

    $.extend(Address.prototype, {
        /**
        Renders input from tpl

        @method render() 
        **/        
        render: function() {
           this.$input = this.$tpl.find('input');
        },
        
        /**
        Default method to show value in element. Can be overwritten by display option.
        
        @method value2html(value, element) 
        **/
        value2html: function(value, element) {
            if(!value) {
                $(element).empty();
                return; 
            }
            var html = 'Location - '+$('<div>').text(value.location).html()+ ', ' + $('<div>').text(value.street).html() + ', ' + $('<div>').text(value.building).html() + ', ' +  $('<div>').text(value.city).html()+ ', ' +  $('<div>').text(value.state).html()+ ', ' +  $('<div>').text(value.postal_address).html() ;
            $(element).html(html); 
        },
        
        /**
        Gets value from element's html
        
        @method html2value(html) 
        **/        
        html2value: function(html) {        
          /*
            you may write parsing method to get value by element's html
            e.g. "Moscow, st. Lenina, bld. 15" => {city: "Moscow", street: "Lenina", building: "15"}
            but for complex structures it's not recommended.
            Better set value directly via javascript, e.g. 
            editable({
                value: {
                    city: "Moscow", 
                    street: "Lenina", 
                    building: "15"
                }
            });
          */ 
          return null;  
        },
      
       /**
        Converts value to string. 
        It is used in internal comparing (not for sending to server).
        
        @method value2str(value)  
       **/
       value2str: function(value) {
           var str = '';
           if(value) {
               for(var k in value) {
                   str = str + k + ':' + value[k] + ';';  
               }
           }
           return str;
       }, 
       
       /*
        Converts string to value. Used for reading value from 'data-value' attribute.
        
        @method str2value(str)  
       */
       str2value: function(str) {
           /*
           this is mainly for parsing value defined in data-value attribute. 
           If you will always set value by javascript, no need to overwrite it
           */
           return str;
       },                
       
       /**
        Sets value of input.
        
        @method value2input(value) 
        @param {mixed} value
       **/         
       value2input: function(value) {
           if(!value) {
             return;
           }
           this.$input.filter('[name="location"]').val(value.location);
           this.$input.filter('[name="street"]').val(value.street);
           this.$input.filter('[name="building"]').val(value.building);
           this.$input.filter('[name="city"]').val(value.city);
           this.$input.filter('[name="latitude"]').val(value.latitude);
           this.$input.filter('[name="longitude"]').val(value.longitude);
           this.$input.filter('[name="state"]').val(value.state);
           this.$input.filter('[name="postal_code"]').val(value.postal_code);
       },       
       
       /**
        Returns value of input.
        
        @method input2value() 
       **/          
       input2value: function() { 
           return {
        	   	 location: this.$input.filter('[name="location"]').val(), 
              street: this.$input.filter('[name="street"]').val(), 
              building: this.$input.filter('[name="building"]').val(),
              city: this.$input.filter('[name="city"]').val(), 
              latitude: this.$input.filter('[name="latitude"]').val(), 
              longitude: this.$input.filter('[name="longitude"]').val(), 
              state: this.$input.filter('[name="state"]').val(), 
              postal_code: this.$input.filter('[name="postal_code"]').val()
           };
       },        
       
        /**
        Activates input: sets focus on the first field.
        
        @method activate() 
       **/        
       activate: function() {
            this.$input.filter('[name="location"]').focus();
       },  
       
       /**
        Attaches handler to submit form in case of 'showbuttons=false' mode
        
        @method autosubmit() 
       **/       
       autosubmit: function() {
           this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
           });
       }       
    });

    Address.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl:  '<div class="editable-address"><label><span>Location Lookup / Name: </span><input type="text" name="location" class="form-control"></label></div>' +
		'<div class="editable-address"><label><span>Street: </span><input type="text" name="street" onclick="initGoogleAutoSuggest();" class="form-control goolge_city" data-type="geo_code" id="street">'+
		 '<input type="hidden" name="latitude" id="street_latitude"><input type="hidden" name="longitude" id="street_longitude"></label></div>' +
		'<div class="editable-address"><label><span>Apartment / Suits / Building: </span><input type="text" name="building" class="form-control"></label></div>' +
    '<div class="editable-address"><label><span>City: </span><input type="text" name="city"  onclick="initGoogleAutoSuggest();" class="form-control goolge_city" data-type="geo_code" id="city" >'+
    '</label></div>' +
    '<div class="editable-address"><label><span>State / Region: </span><input type="text" name="state" class="form-control"></label></div>'+
    '<div class="editable-address"><label><span>Postal Code: </span><input type="text" name="postal_code" class="form-control"></label></div>',
             
        inputclass: ''
    });

    $.fn.editabletypes.address = Address;

}(window.jQuery));

function initGoogleAutoSuggest() {
	var options = {
			  		types: ['(cities)'],
			  		componentRestrictions: {country: "in"}
			 	};
	$( ".goolge_city" ).each(function( index, element ) {
		var autocomplete = new google.maps.places.Autocomplete(element, options);
		autocomplete.addListener('place_changed', function(){
			if($(element).attr("data-type") == "city_name") {
				var place = autocomplete.getPlace();
				$(element).val(place.address_components[1].short_name);
			}
			if($(element).attr("data-type") == "geo_code") {
				var place = autocomplete.getPlace();
				var input_id = $(element).attr("id");
				$("#"+input_id+"_latitude").val(place.geometry.location.lat());
				$("#"+input_id+"_longitude").val(place.geometry.location.lng());
			}
		});
	});
}
