

(function($) {
    $(function() {
        jQuery("#check-external_url").on("click", function() {
            var url = jQuery("#external-url").val();
            if(url == '')
                return alert("Please enter URL");
            else if(!isValidURL(url))
                return alert("Please enter valid URL like: https://schemamarkapp.com/");
            else {
                jQuery("#external-schema-details").html("<h2>LOADING....</h2>");
                data = { action: 'my_seo_settings_options_page_check_tool_external_check', url: url};
                jQuery.post(ajaxurl, data, function(response){
                    jQuery("#external-schema-details").html(response);
                });
            }
        });

        jQuery("#check-generate_json_ld_recipe").on("click", function() {
            var url = jQuery("#generate_json_ld_recipe-url").val();
            if(url == '')
                return alert("Please enter URL");
            else if(!isValidURL(url))
                return alert("Please enter valid URL like: https://schemamarkapp.com/first-post");
            else {
                jQuery("#generate_json_ld_recipe-schema-details").html("<h2>LOADING....</h2>");
                data = { action: 'my_seo_settings_options_page_check_tool_general', url: url, id: 'generate_json_ld_recipe'};
                jQuery.post(ajaxurl, data, function(response){
                    jQuery("#generate_json_ld_recipe-schema-details").html(response);
                });
            }
        });

        jQuery("#check-product_url").on("click", function() {
            var url = jQuery("#product-url").val();
            if(url == '')
                return alert("Please enter URL");
            else if(!isValidURL(url))
                return alert("Please enter valid URL like: https://schemamarkapp.com/products/smart-watch");
            else {
                jQuery("#product-schema-details").html("<h2>LOADING....</h2>");
                data = { action: 'my_seo_settings_options_page_check_tool_general', url: url, id: 'product'};
                jQuery.post(ajaxurl, data, function(response){
                    jQuery("#product-schema-details").html(response);
                });
            }
        });

        jQuery(".posts-fetch-page").on("click", function() {
            var page = jQuery(this).attr("page-id");
            jQuery(".posts-table-tbody").html("<tr><th colspan='3'>LOADING.....</th></tr>");
            data = { action: 'my_seo_settings_options_page_check_tool_general', page: page, id: "posts-fetch-page"};
            jQuery.post(ajaxurl, data, function(response){
                jQuery(".posts-fetch-page").removeClass("active-page");
                jQuery(".posts-page-"+page).addClass("active-page");
                jQuery(".posts-table-tbody").html(response);
            });
        });

        jQuery(".products-fetch-page").on("click", function() {
            var page = jQuery(this).attr("page-id");
            jQuery(".products-table-tbody").html("<tr><th colspan='3'>LOADING.....</th></tr>");
            data = { action: 'my_seo_settings_options_page_check_tool_general', page: page, id: "products-fetch-page"};
            jQuery.post(ajaxurl, data, function(response){
                jQuery(".products-fetch-page").removeClass("active-page");
                jQuery(".products-page-"+page).addClass("active-page");
                jQuery(".products-table-tbody").html(response);
            });
        });
    });
})(jQuery);

var generalTabs = [];

function getGeneralTabContent(tab, id){
    if(tab == 'generate_json_ld_recipe-schema')
        return;
    else if(generalTabs.hasOwnProperty(tab))
        return;
    else {
        jQuery("#"+tab+"-details").html("<h2>LOADING....</h2>");
        data = { action: 'my_seo_settings_options_page_check_tool_general', id: id};
        jQuery.post(ajaxurl, data, function(response){
            generalTabs[tab] = response;
            jQuery("#"+tab+"-details").html(response);
        });
    }
}

function isValidURL(url) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(url);
}

function switchGeneralTab(evt, tab, id) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("generaltabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("generaltablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tab).style.display = "block";
    evt.currentTarget.className += " active";
    getGeneralTabContent(tab, id);
}

function switchTab(evt, tab) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tab).style.display = "block";
    evt.currentTarget.className += " active";
    getTabContent(tab);
}

var tabs = [];

function getTabContent(tab){
    if(tab == 'external-schema')
        return;
    else if(tab == 'product-schema')
        return;
    else if(tabs.hasOwnProperty(tab))
        return;
    else if(tab == 'local_business-schema'){
        jQuery("#"+tab+"-details").html("<h2>LOADING....</h2>");
        data = { action: 'my_seo_settings_options_page_check_tool_general', id: 'generate_json_ld_localbusiness'};
        jQuery.post(ajaxurl, data, function(response){
            tabs[tab] = response;
            jQuery("#"+tab+"-details").html(response);
        });
    } else if(tab == 'person-schema'){
        jQuery("#"+tab+"-details").html("<h2>LOADING....</h2>");
        data = { action: 'my_seo_settings_options_page_check_tool_general', id: 'generate_json_ld_person'};
        jQuery.post(ajaxurl, data, function(response){
            tabs[tab] = response;
            jQuery("#"+tab+"-details").html(response);
        });
    } else if(tab == 'contact_page-schema'){
        jQuery("#"+tab+"-details").html("<h2>LOADING....</h2>");
        data = { action: 'my_seo_settings_options_page_check_tool_general', id: 'generate_json_ld_contactpage'};
        jQuery.post(ajaxurl, data, function(response){
            tabs[tab] = response;
            jQuery("#"+tab+"-details").html(response);
        });
    } else if(tab == 'about_page-schema'){
        jQuery("#"+tab+"-details").html("<h2>LOADING....</h2>");
        data = { action: 'my_seo_settings_options_page_check_tool_general', id: 'generate_json_ld_aboutpage'};
        jQuery.post(ajaxurl, data, function(response){
            tabs[tab] = response;
            jQuery("#"+tab+"-details").html(response);
        });
    } else if(tab == 'general-schema'){
        document.getElementById("defaultTabOpen").click();
        return '';
    } else {
        jQuery("#"+tab+"-details").html("<h2>LOADING....</h2>");
        data = { action: 'my_seo_settings_options_page_check_tool_general'};
        jQuery.post(ajaxurl, data, function(response){
            tabs[tab] = response;
            jQuery("#"+tab+"-details").html(response);
        });
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
}