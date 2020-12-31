(function($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    //$("#TB_ajaxContent" ).removeAttr("style").css({"width" : "783px", height: '500px'});

    class TestimonialSettings {
        constructor(id, arg){
            this.id = id;
            this.arg = arg;
            this.val = document.getElementById(this.id).value
            console.log(this.id+" : "+this.arg+" : "+this.val);
        }

        get set() {
            if (this.val)
                return " "+this.go();
            else
                return "";
        }

        go(){
            return this.arg+'="'+this.val+'"';
        }
    }

    $(document).on("click", "#testimonial-insert", function() {
        testimonial_container();
    });

    $(document).on("change", "#wp_testimonials_id", function() {
        console.log($(this, $("#wp_testimonials_id")).prop('selectedIndex'));
        if (!$(this, $("#wp_testimonials_id")).val()) {
            $("#wprem_testimonial_base_options").hide();
        } else {
            $("#wprem_testimonial_base_options").show();
        }
        if ($(this, $("#wp_testimonials_id")).prop('selectedIndex') == 1) {
            $("#wprem_testimonial_options").show();
        } else {
            $("#wprem_testimonial_options").hide();
        }
        if ($(this, $("#wp_testimonials_id")).prop('selectedIndex') == 1 || $(this, $("#wp_testimonials_id")).prop('selectedIndex') == 2) {
        	$("#wprem_testimonials_category").show();
        }else{
			$("#wprem_testimonials_category").hide();
        }
    });

    $(document).on("change", "#wp_testimonial_view", function() {
        console.log($(this).val());
        if ($(this).val() === 'slide') {
            $("#wprem_testimonial_slideroptions").show();
        } else {
            $("#wprem_testimonial_slideroptions").hide();
        }
    });

    function getfield(n, o) {
        if ($(n).val()) {
            if (isNaN($(n).val())) {
                return o + '="' + $(n).val() + '" ';
            } else {
                return o + '=' + $(n).val() + ' ';
            }
        } else {
            return '';
        }
    }

    function testimonial_container() {
        /*var view = 'view="' + $("#wp_testimonial_view").val() + '" ';
        var cat = $("#wprem_testimonials_category").val() ? 'cat="' + $("#wprem_testimonials_category]").val() + '" ' : '';
        var id = getfield("#wp_testimonials_id", "id");
        var ttitle = getfield("#wp_testimonial_title", "ttitle");
        var cname = getfield("#wp_testimonial_clientname", 'cname');
        var ctitle = getfield("#wp_testimonial_clienttitle", "ctitle");
        var coname = getfield("#wp_testimonial_companyname", "coname");
        var courl = getfield("#wp_testimonial_companyurl", "courl");
        var date = getfield("#wp_testimonial_date", "date");
        var arrows = getfield("#wp_testimonial_sliderarrows", "arrows");
        var bullets = getfield("#wp_testimonial_sliderbullets", "bullets");
        var delay = getfield("input[name=wp_testimonial_sliderdelay", "delay");
        var orderby = getfield("#wp_testimonial_orderby", "orderby");
        var order = getfield("#wp_testimonial_order", "order");
        var excerpt = getfield("#wp_testimonial_excerpt", "excerpt");*/

        const view = new TestimonialSettings('wp_testimonial_view','view');
        const cat = new TestimonialSettings('wprem_testimonials_category','cat');
        const id = new TestimonialSettings('wp_testimonials_id','id');
        const content = new TestimonialSettings('wp_testimonial_content','content');
        const ttitle = new TestimonialSettings('wp_testimonial_title','ttitle');
        const cname = new TestimonialSettings('wp_testimonial_clientname','cname');
        const ctitle = new TestimonialSettings('wp_testimonial_clienttitle','ctitle');
        const coname = new TestimonialSettings('wp_testimonial_companyname','coname');
        const courl = new TestimonialSettings('wp_testimonial_companyurl','courl');
        const date = new TestimonialSettings('wp_testimonial_date','date');
        const arrows = new TestimonialSettings('wp_testimonial_sliderarrows','arrows');
        const bullets = new TestimonialSettings('wp_testimonial_sliderbullets','bullets');
        const delay = new TestimonialSettings('wp_testimonial_sliderdelay','delay');
        const orderby = new TestimonialSettings('wp_testimonial_orderby','orderby');
        const order = new TestimonialSettings('wp_testimonial_order','order');
        const excerpt = new TestimonialSettings('wp_testimonial_excerpt','excerpt');
        const columns = new TestimonialSettings('wp_testimonial_columns','columns');

        if ($("#wp_testimonial_view").val() !== 'slide'){
        	const arrows = '';
        	const bullets = '';
        	const delay = '';
        }

        if (!$("#wp_testimonials_id").val()) {
            window.send_to_editor();
        } else {
            window.send_to_editor("[wp-testimonial"+view.set+id.set+cat.set+ttitle.set+cname.set+ctitle.set+coname.set+courl.set+date.set+arrows.set+bullets.set+delay.set+orderby.set+order.set+excerpt.set+content.set+columns.set+"]");
        }
    }

})(jQuery);