/**
* asRange v0.3.4
* https://github.com/amazingSurge/jquery-asRange
*
* Copyright (c) amazingSurge
* Released under the LGPL-3.0 license
*/
!function(t,e){if("function"==typeof define&&define.amd)define(["jquery"],e);else if("undefined"!=typeof exports)e(require("jquery"));else{var i={exports:{}};e(t.jQuery),t.jqueryAsRangeEs=i.exports}}(this,function(t){"use strict";function e(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t){var e=t.originalEvent;return e.touches&&e.touches.length&&e.touches[0]&&(e=e.touches[0]),e}function s(t){for(var e=arguments.length,i=Array(e>1?e-1:0),s=1;s<e;s++)i[s-1]=arguments[s];if("string"==typeof t){var a=t;if(/^_/.test(a))return!1;if(!(/^(get)$/.test(a)||"val"===a&&0===i.length))return this.each(function(){var t=n.default.data(this,v);t&&"function"==typeof t[a]&&t[a].apply(t,i)});var o=this.first().data(v);if(o&&"function"==typeof o[a])return o[a].apply(o,i)}return this.each(function(){(0,n.default)(this).data(v)||(0,n.default)(this).data(v,new d(this,t))})}var n=function(t){return t&&t.__esModule?t:{default:t}}(t),a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},o=function(){function t(t,e){for(var i=0;i<e.length;i++){var s=e[i];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(t,s.key,s)}}return function(e,i,s){return i&&t(e.prototype,i),s&&t(e,s),e}}(),r={namespace:"asRange",skin:null,max:100,min:0,value:null,step:10,limit:!0,range:!1,direction:"h",keyboard:!0,replaceFirst:!1,tip:!0,scale:!0,format:function(t){return t}},u=function(){function t(i,s,a){e(this,t),this.$element=i,this.uid=s,this.parent=a,this.options=n.default.extend(!0,{},this.parent.options),this.direction=this.options.direction,this.value=null,this.classes={active:this.parent.namespace+"-pointer_active"}}return o(t,[{key:"mousedown",value:function(t){var e=this.parent.direction.axis,s=this.parent.direction.position,a=this.parent.$wrap.offset();this.$element.trigger(this.parent.namespace+"::moveStart",this),this.data={},this.data.start=t[e],this.data.position=t[e]-a[s];var o=this.parent.getValueFromPosition(this.data.position);return this.set(o),n.default.each(this.parent.pointer,function(t,e){e.deactive()}),this.active(),this.mousemove=function(t){var s=i(t),n=this.parent.getValueFromPosition(this.data.position+(s[e]||this.data.start)-this.data.start);return this.set(n),t.preventDefault(),!1},this.mouseup=function(){return(0,n.default)(document).off(".asRange mousemove.asRange touchend.asRange mouseup.asRange touchcancel.asRange"),this.$element.trigger(this.parent.namespace+"::moveEnd",this),!1},(0,n.default)(document).on("touchmove.asRange mousemove.asRange",n.default.proxy(this.mousemove,this)).on("touchend.asRange mouseup.asRange",n.default.proxy(this.mouseup,this)),!1}},{key:"active",value:function(){this.$element.addClass(this.classes.active)}},{key:"deactive",value:function(){this.$element.removeClass(this.classes.active)}},{key:"set",value:function(t){this.value!==t&&(this.parent.step&&(t=this.matchStep(t)),!0===this.options.limit?t=this.matchLimit(t):(t<=this.parent.min&&(t=this.parent.min),t>=this.parent.max&&(t=this.parent.max)),this.value=t,this.updatePosition(),this.$element.focus(),this.$element.trigger(this.parent.namespace+"::move",this))}},{key:"updatePosition",value:function(){var t={};t[this.parent.direction.position]=this.getPercent()+"%",this.$element.css(t)}},{key:"getPercent",value:function(){return(this.value-this.parent.min)/this.parent.interval*100}},{key:"get",value:function(){return this.value}},{key:"matchStep",value:function(t){var e=this.parent.step,i=e.toString().split(".")[1];return t=Math.round(t/e)*e,i&&(t=t.toFixed(i.length)),parseFloat(t)}},{key:"matchLimit",value:function(t){var e=void 0,i=void 0,s=this.parent.pointer;return e=1===this.uid?this.parent.min:s[this.uid-2].value,i=s[this.uid]&&null!==s[this.uid].value?s[this.uid].value:this.parent.max,t<=e&&(t=e),t>=i&&(t=i),t}},{key:"destroy",value:function(){this.$element.off(".asRange"),this.$element.remove()}}]),t}(),l={defaults:{scale:{valuesNumber:3,gap:1,grid:5}},init:function(t){var e=n.default.extend({},this.defaults,t.options.scale).scale;e.values=[],e.values.push(t.min);for(var i=(t.max-t.min)/(e.valuesNumber-1),s=1;s<=e.valuesNumber-2;s++)e.values.push(i*s);e.values.push(t.max);var a={scale:t.namespace+"-scale",lines:t.namespace+"-scale-lines",grid:t.namespace+"-scale-grid",inlineGrid:t.namespace+"-scale-inlineGrid",values:t.namespace+"-scale-values"},o=e.values.length,r=((e.grid-1)*(e.gap+1)+e.gap)*(o-1)+o,u=100/(r-1),l=100/(o-1);this.$scale=(0,n.default)("<div></div>").addClass(a.scale),this.$lines=(0,n.default)("<ul></ul>").addClass(a.lines),this.$values=(0,n.default)("<ul></ul>").addClass(a.values);for(var h=0;h<r;h++){(0===h||h===r||h%((r-1)/(o-1))==0?(0,n.default)('<li class="'+a.grid+'"></li>'):h%e.grid==0?(0,n.default)('<li class="'+a.inlineGrid+'"></li>'):(0,n.default)("<li></li>")).css({left:u*h+"%"}).appendTo(this.$lines)}for(var p=0;p<o;p++)(0,n.default)("<li><span>"+e.values[p]+"</span></li>").css({left:l*p+"%"}).appendTo(this.$values);this.$lines.add(this.$values).appendTo(this.$scale),this.$scale.appendTo(t.$wrap)},update:function(t){this.$scale.remove(),this.init(t)}},h={defaults:{},init:function(t){var e=this;if(this.$arrow=(0,n.default)("<span></span>").appendTo(t.$wrap),this.$arrow.addClass(t.namespace+"-selected"),!1===t.options.range&&t.p1.$element.on(t.namespace+"::move",function(t,i){e.$arrow.css({left:0,width:i.getPercent()+"%"})}),!0===t.options.range){var i=function(){var i=t.p2.getPercent()-t.p1.getPercent(),s=void 0;i>=0?s=t.p1.getPercent():(i=-i,s=t.p2.getPercent()),e.$arrow.css({left:s+"%",width:i+"%"})};t.p1.$element.on(t.namespace+"::move",i),t.p2.$element.on(t.namespace+"::move",i)}}},p={defaults:{active:"always"},init:function(t){var e=this,i=n.default.extend({},this.defaults,t.options.tip);this.opts=i,this.classes={tip:t.namespace+"-tip",show:t.namespace+"-tip-show"},n.default.each(t.pointer,function(i,s){var o=(0,n.default)("<span></span>").appendTo(t.pointer[i].$element);o.addClass(e.classes.tip),"onMove"===e.opts.active&&(o.css({display:"none"}),s.$element.on(t.namespace+"::moveEnd",function(){return e.hide(o),!1}).on(t.namespace+"::moveStart",function(){return e.show(o),!1})),s.$element.on(t.namespace+"::move",function(){var e=void 0;if(e=t.options.range?t.get()[i]:t.get(),"function"==typeof t.options.format)if(t.options.replaceFirst&&"number"!=typeof e){if("string"==typeof t.options.replaceFirst&&(e=t.options.replaceFirst),"object"===a(t.options.replaceFirst))for(var s in t.options.replaceFirst)Object.hasOwnProperty(t.options.replaceFirst,s)&&(e=t.options.replaceFirst[s])}else e=t.options.format(e);return o.text(e),!1})})},show:function(t){t.addClass(this.classes.show),t.css({display:"block"})},hide:function(t){t.removeClass(this.classes.show),t.css({display:"none"})}},c={},d=function(){function t(i,s){var a=this;e(this,t);var o={};if(this.element=i,this.$element=(0,n.default)(i),this.$element.is("input")){var u=this.$element.val();"string"==typeof u&&(o.value=u.split(",")),n.default.each(["min","max","step"],function(t,e){var i=parseFloat(a.$element.attr(e));isNaN(i)||(o[e]=i)}),this.$element.css({display:"none"}),this.$wrap=(0,n.default)("<div></div>"),this.$element.after(this.$wrap)}else this.$wrap=this.$element;if(this.options=n.default.extend({},r,s,this.$element.data(),o),this.namespace=this.options.namespace,this.components=n.default.extend(!0,{},c),this.options.range&&(this.options.replaceFirst=!1),this.value=this.options.value,null===this.value&&(this.value=this.options.min),this.options.range?n.default.isArray(this.value)?1===this.value.length&&(this.value[1]=this.value[0]):this.value=[this.value,this.value]:n.default.isArray(this.value)&&(this.value=this.value[0]),this.min=this.options.min,this.max=this.options.max,this.step=this.options.step,this.interval=this.max-this.min,this.initialized=!1,this.updating=!1,this.disabled=!1,"v"===this.options.direction?this.direction={axis:"pageY",position:"top"}:this.direction={axis:"pageX",position:"left"},this.$wrap.addClass(this.namespace),this.options.skin&&this.$wrap.addClass(this.namespace+"_"+this.options.skin),this.max<this.min||this.step>=this.interval)throw new Error("error options about max min step");this.init()}return o(t,[{key:"init",value:function(){this.$wrap.append('<div class="'+this.namespace+'-bar" />'),this.buildPointers(),this.components.selected.init(this),!1!==this.options.tip&&this.components.tip.init(this),!1!==this.options.scale&&this.components.scale.init(this),this.set(this.value),this.bindEvents(),this._trigger("ready"),this.initialized=!0}},{key:"_trigger",value:function(t){for(var e=arguments.length,i=Array(e>1?e-1:0),s=1;s<e;s++)i[s-1]=arguments[s];var n=[this].concat(i);this.$element.trigger(this.namespace+"::"+t,n);var a="on"+(t=t.replace(/\b\w+\b/g,function(t){return t.substring(0,1).toUpperCase()+t.substring(1)}));"function"==typeof this.options[a]&&this.options[a].apply(this,i)}},{key:"buildPointers",value:function(){this.pointer=[];var t=1;this.options.range&&(t=2);for(var e=1;e<=t;e++){var i=(0,n.default)('<div class="'+this.namespace+"-pointer "+this.namespace+"-pointer-"+e+'"></div>').appendTo(this.$wrap),s=new u(i,e,this);this.pointer.push(s)}this.p1=this.pointer[0],this.options.range&&(this.p2=this.pointer[1])}},{key:"bindEvents",value:function(){var t=this,e=this;this.$wrap.on("touchstart.asRange mousedown.asRange",function(t){if(!0!==e.disabled){if((t=i(t)).which?3===t.which:2===t.button)return!1;var s=e.$wrap.offset(),n=t[e.direction.axis]-s[e.direction.position];return e.getAdjacentPointer(n).mousedown(t),!1}}),this.$element.is("input")&&this.$element.on(this.namespace+"::change",function(){var e=t.get();t.$element.val(e)}),n.default.each(this.pointer,function(i,s){s.$element.on(t.namespace+"::move",function(){return e.value=e.get(),!(!e.initialized||e.updating)&&(e._trigger("change",e.value),!1)})})}},{key:"getValueFromPosition",value:function(t){return t>0?this.min+t/this.getLength()*this.interval:0}},{key:"getAdjacentPointer",value:function(t){var e=this.getValueFromPosition(t);if(this.options.range){var i=this.p1.value,s=this.p2.value,n=Math.abs(i-s);return i<=s?e>i+n/2?this.p2:this.p1:e>s+n/2?this.p1:this.p2}return this.p1}},{key:"getLength",value:function(){return"v"===this.options.direction?this.$wrap.height():this.$wrap.width()}},{key:"update",value:function(t){var e=this;this.updating=!0,n.default.each(["max","min","step","limit","value"],function(i,s){t[s]&&(e[s]=t[s])}),(t.max||t.min)&&this.setInterval(t.min,t.max),t.value||(this.value=t.min),n.default.each(this.components,function(t,i){"function"==typeof i.update&&i.update(e)}),this.set(this.value),this._trigger("update"),this.updating=!1}},{key:"get",value:function(){var t=[];if(n.default.each(this.pointer,function(e,i){t[e]=i.get()}),this.options.range)return t;if(t[0]===this.options.min&&("string"==typeof this.options.replaceFirst&&(t[0]=this.options.replaceFirst),"object"===a(this.options.replaceFirst)))for(var e in this.options.replaceFirst)Object.hasOwnProperty(this.options.replaceFirst,e)&&(t[0]=e);return t[0]}},{key:"set",value:function(t){if(this.options.range){if("number"==typeof t&&(t=[t]),!n.default.isArray(t))return;n.default.each(this.pointer,function(e,i){i.set(t[e])})}else this.p1.set(t);this.value=t}},{key:"val",value:function(t){return t?(this.set(t),this):this.get()}},{key:"setInterval",value:function(t,e){this.min=t,this.max=e,this.interval=e-t}},{key:"enable",value:function(){return this.disabled=!1,this.$wrap.removeClass(this.namespace+"_disabled"),this._trigger("enable"),this}},{key:"disable",value:function(){return this.disabled=!0,this.$wrap.addClass(this.namespace+"_disabled"),this._trigger("disable"),this}},{key:"destroy",value:function(){n.default.each(this.pointer,function(t,e){e.destroy()}),this.$wrap.destroy(),this._trigger("destroy")}}],[{key:"registerComponent",value:function(t,e){c[t]=e}},{key:"setDefaults",value:function(t){n.default.extend(r,n.default.isPlainObject(t)&&t)}}]),t}();d.registerComponent("scale",l),d.registerComponent("selected",h),d.registerComponent("tip",p),function(){var t=(0,n.default)(document);t.on("asRange::ready",function(e,i){var s=void 0,a={keys:{UP:38,DOWN:40,LEFT:37,RIGHT:39,RETURN:13,ESCAPE:27,BACKSPACE:8,SPACE:32},map:{},bound:!1,press:function(t){var e=t.keyCode||t.which;if(e in a.map&&"function"==typeof a.map[e])return a.map[e](t),!1},attach:function(e){var i=void 0,s=void 0;for(i in e)e.hasOwnProperty(i)&&((s=i.toUpperCase())in a.keys?a.map[a.keys[s]]=e[i]:a.map[s]=e[i]);a.bound||(a.bound=!0,t.bind("keydown",a.press))},detach:function(){a.bound=!1,a.map={},t.unbind("keydown",a.press)}};!0===i.options.keyboard&&n.default.each(i.pointer,function(t,e){s=i.options.step?i.options.step:1;var n=function(){var t=e.value;e.set(t-s)},o=function(){var t=e.value;e.set(t+s)};e.$element.attr("tabindex","0").on("focus",function(){return a.attach({left:n,right:o}),!1}).on("blur",function(){return a.detach(),!1})})})}();var f={version:"0.3.4"},v="asRange",m=n.default.fn.asRange;n.default.fn.asRange=s,n.default.asRange=n.default.extend({setDefaults:d.setDefaults,noConflict:function(){return n.default.fn.asRange=m,s}},f)});
//# sourceMappingURL=jquery-asRange.min.js.map

/*!
 * LABELAUTY jQuery Plugin
 *
 * @file: jquery-labelauty.js
 * @author: Francisco Neves (@fntneves)
 * @site: www.francisconeves.com
 * @license: MIT License
 */

(function( $ ){

	$.fn.labelauty = function( options )
	{
		/*
		 * Our default settings
		 * Hope you don't need to change anything, with these settings
		 */
		var settings = $.extend(
		{
			// Development Mode
			// This will activate console debug messages
			"development": false,

			// Trigger Class
			// This class will be used to apply styles
			"class": "labelauty",

			// Use icon?
			// If false, then only a text label represents the input
			"icon": true,

			// Use text label ?
			// If false, then only an icon represents the input
			"label": true,

			// Separator between labels' messages
			// If you use this separator for anything, choose a new one
			"separator": "|",

			// Default Checked Message
			// This message will be visible when input is checked
			"checked_label": "Checked",

			// Default UnChecked Message
			// This message will be visible when input is unchecked
			"unchecked_label": "Unchecked",

			// Force random ID's
			// Replace original ID's with random ID's,
			"force_random_id": false,

			// Minimum Label Width
			// This value will be used to apply a minimum width to the text labels
			"minimum_width": false,

			// Use the greatest width between two text labels ?
			// If this has a true value, then label width will be the greatest between labels
			"same_width": true
		}, options);

		/*
		 * Let's create the core function
		 * It will try to cover all settings and mistakes of using
		 */
		return this.each(function()
		{
			var $object = $( this );
			var selected = $object.is(':checked');
			var type = $object.attr('type');
			var use_icons = true;
			var use_labels = true;
			var labels;
			var labels_object;
			var input_id;
			
			//Get the aria label from the input element
			var aria_label = $object.attr( "aria-label" );
			
			// Hide the object form screen readers
			$object.attr( "aria-hidden", true );
			
			// Test if object is a check input
			// Don't mess me up, come on
			if( $object.is( ":checkbox" ) === false && $object.is( ":radio" ) === false )
				return this;

			// Add "labelauty" class to all checkboxes
			// So you can apply some custom styles
			$object.addClass( settings["class"] );
			
			// Get the value of "data-labelauty" attribute
			// Then, we have the labels for each case (or not, as we will see)
			labels = $object.attr( "data-labelauty" );
			
			use_labels = settings.label;
			use_icons = settings.icon;

			// It's time to check if it's going to the right way
			// Null values, more labels than expected or no labels will be handled here
			if( use_labels === true )
			{
				if( labels == null || labels.length === 0 )
				{
					// If attribute has no label and we want to use, then use the default labels
					labels_object = [settings.unchecked_label, settings.checked_label]
				}
				else
				{
					// Ok, ok, it's time to split Checked and Unchecked labels
					// We split, by the "settings.separator" option
					labels_object = labels.split( settings.separator );

					// Now, let's check if exist _only_ two labels
					// If there's more than two, then we do not use labels :(
					// Else, do some additional tests
					if( labels_object.length > 2 )
					{
						use_labels = false;
						debug( settings.development, "There's more than two labels. LABELAUTY will not use labels." );
					}
					else
					{
						// If there's just one label (no split by "settings.separator"), it will be used for both cases
						// Here, we have the possibility of use the same label for both cases
						if( labels_object.length === 1 )
							debug( settings.development, "There's just one label. LABELAUTY will use this one for both cases." );
					}
				}
			}

			/*
			 * Let's begin the beauty
			 */

			// Start hiding ugly checkboxes
			// Obviously, we don't need native checkboxes :O
			$object.css({ display : "none" });
						
			// We don't need more data-labelauty attributes!
			// Ok, ok, it's just for beauty improvement
			$object.removeAttr( "data-labelauty" );
			
			// Now, grab checkbox ID Attribute for "label" tag use
			// If there's no ID Attribute, then generate a new one
			input_id = $object.attr( "id" );

			if( settings.force_random_id || input_id == null || input_id.trim() === "")
			{
				var input_id_number = 1 + Math.floor( Math.random() * 1024000 );
				input_id = "labelauty-" + input_id_number;

				// Is there any element with this random ID ?
				// If exists, then increment until get an unused ID
				while( $( input_id ).length !== 0 )
				{
					input_id_number++;
					input_id = "labelauty-" + input_id_number;
					debug( settings.development, "Holy crap, between 1024 thousand numbers, one raised a conflict. Trying again." );
				}

				$object.attr( "id", input_id );
			}

			// Now, add necessary tags to make this work
			// Here, we're going to test some control variables and act properly
			
			var element = jQuery(create( input_id, aria_label, selected, type, labels_object, use_labels, use_icons ));
			
			element.click(function(){
				if($object.is(':checked')){
					$(element).attr('aria-checked', false);
				}else{
					$(element).attr('aria-checked', true);
				}
			});
			
			element.keypress(function(event){
				event.preventDefault();
				if(event.keyCode === 32 || event.keyCode === 13){		
					if($object.is(':checked')){
						$object.prop('checked', false);
						$(element).attr('aria-checked',false);
					}else{
						$object.prop('checked', true);
						$(element).attr('aria-checked', true);
					}
				}
			});
			
			$object.after(element);
			
			// Now, add "min-width" to label
			// Let's say the truth, a fixed width is more beautiful than a variable width
			if( settings.minimum_width !== false )
				$object.next( "label[for=" + input_id + "]" ).css({ "min-width": settings.minimum_width });

			// Now, add "min-width" to label
			// Let's say the truth, a fixed width is more beautiful than a variable width
			if( settings.same_width != false && settings.label == true )
			{
				var label_object = $object.next( "label[for=" + input_id + "]" );
				var unchecked_width = getRealWidth(label_object.find( "span.labelauty-unchecked" ));
				var checked_width = getRealWidth(label_object.find( "span.labelauty-checked" ));

				if( unchecked_width > checked_width )
					label_object.find( "span.labelauty-checked" ).width( unchecked_width );
				else
					label_object.find( "span.labelauty-unchecked" ).width( checked_width );
			}
		});
	};

	/*
	 * Tricky code to work with hidden elements, like tabs.
	 * Note: This code is based on jquery.actual plugin.
	 * https://github.com/dreamerslab/jquery.actual
	 */
	function getRealWidth( element )
	{
		var width = 0;
		var $target = element;
		var css_class = 'hidden_element';

		$target = $target.clone().attr('class', css_class).appendTo('body');
		width = $target.width(true);
		$target.remove();

		return width;
	}

	function debug( debug, message )
	{
		if( debug && window.console && window.console.log )
			window.console.log( "jQuery-LABELAUTY: " + message );
	}

	function create( input_id, aria_label, selected, type, messages_object, label, icon )
	{	
		var block;
		var unchecked_message;
		var checked_message;
		var aria = "";
		
		if( messages_object == null )
			unchecked_message = checked_message = "";
		else
		{
			unchecked_message = messages_object[0];

			// If checked message is null, then put the same text of unchecked message
			if( messages_object[1] == null )
				checked_message = unchecked_message;
			else
				checked_message = messages_object[1];
		}
		
		if(aria_label == null)
			aria = "";	
		else
			aria = 'tabindex="0" role="' + type + '" aria-checked="' + selected + '" aria-label="' + aria_label + '"';
		
		if( label == true && icon == true)
		{
			block = '<label for="' + input_id + '" ' + aria + '>' +
						'<span class="labelauty-unchecked-image"></span>' +
						'<span class="labelauty-unchecked">' + unchecked_message + '</span>' +
						'<span class="labelauty-checked-image"></span>' +
						'<span class="labelauty-checked">' + checked_message + '</span>' +
					'</label>';
		}
		else if( label == true )
		{
			block = '<label for="' + input_id + '" ' + aria + '>' +
				'<span class="labelauty-unchecked">' + unchecked_message + '</span>' +
				'<span class="labelauty-checked">' + checked_message + '</span>' +
				'</label>';
		}
		else
		{
			block = '<label for="' + input_id + '" ' + aria + '>' +
						'<span class="labelauty-unchecked-image"></span>' +
						'<span class="labelauty-checked-image"></span>' +
					'</label>';
		}
		
		return block;
	}

}( jQuery ));

//# sourceMappingURL=cms-settings-system-libs.js.map
