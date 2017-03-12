
(function ($) {
    
    $.duration = function (s) {
        var m = Math.floor( ( s % 3600 ) / 60 );
        return ( Math.floor( s / 3600 ) + ":" + ( m < 10 ? "0"+m : m ) );
    };
    
    $.fn.duration = function (s) {
        return this.text($.duration(s));
    };
    
})(jQuery);
