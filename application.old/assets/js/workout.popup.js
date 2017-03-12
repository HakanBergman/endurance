
(function ($) {
    
    $.popup = function (options) {
        
        var $popup = $('<div />');
     
        $.get('/popup/' + options.type + '/' + options.id + ( options.extra ? '/' + options.extra : '' )).success(function (html) {
            $popup.html(html).dialog({
                modal: true,
                resizable: false,
                width: 440,
                dialogClass: options.type,
                title: options.title,
                close: function () {
                    setTimeout(function () {
                        (options.done || $.noop).call(options.context);
                        $popup.remove();
                    }, 1);
                },
                open: function() {
                    $('.perform').bind('click',function(){
                        $popup.html(html).dialog('close');
                    })
                    
                }
            }).find('form').submit(function (e) {
                e.preventDefault();
                (options.submit || $.noop).call(options.context);
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                        (options.success || $.noop).call(options.context, data);
                        $popup.dialog('close');
                    }
                });
            });
        });
        
        return $popup;
    };
    
    $.fn.popup = function (options) {
        
        options.context = options.context || this;
        
        return this.click(function (e) {
            e.preventDefault();
            $.popup(options);
        });
    }
    
})(jQuery);
