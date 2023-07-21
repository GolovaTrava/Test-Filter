jQuery(document).ready(function(){
    jQuery('#filter').submit(function(){
        var filter = jQuery(this);
        jQuery.ajax({
            url : '/wp-admin/admin-ajax.php',
            data : filter.serialize(),
            type : 'POST',
            beforeSend : function(xhr){
                filter.find('button').text('Завантажую...');
            },
            success : function(data){
                filter.find('button').text('Фільтрувати');
                jQuery('#response').html(data);
            }
        });
        return false;
    });
});


