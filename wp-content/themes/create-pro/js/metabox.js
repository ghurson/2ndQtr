/**
 * Admin Metabox 
 * Metabox custom jquery functions
 */
 
jQuery(document).ready(function() {
    var active = 0;
    if (jQuery.cookie('#create-ui-tabs')) {
        active = jQuery.cookie('#create-ui-tabs');
        jQuery.cookie('#create-ui-tabs', null);
    }

    var tabs = jQuery('#create-ui-tabs').tabs({
        active: active
    });

});