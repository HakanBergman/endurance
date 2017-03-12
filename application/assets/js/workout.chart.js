
(function ($) {
    
    var google_state = 0;
    var google_callback = [];
    
    $.fn.chart = function (options) {
        
        if(!window.google || !window.google.visualization) {
            
            if(google_state == 1) {
                google_callback.push([this, options]);
                return this;
            }
            
            google_state = 1;
            google_callback.push([this, options]);
            
            $.ajax({
                type: "GET",
                cache: true,
                dataType: "script",
                url: "//www.google.com/jsapi",
                success: function () {
                    google.load('visualization', '1.1', {
                        packages: ['controls', 'corechart'],
                        callback: function () {
                            $.each(google_callback, function (key, val) {
                                val[0].chart(val[1]);
                            });
                        }
                    });
                }
            });
            
            return this;
        }
        
        var title = options.data[0].join(", ");
        var dt = google.visualization.arrayToDataTable(options.data);
        
        if(options.data[0][1] == "Tid") {
            (function (dt, column) {
                for(var i=0;i<dt.getNumberOfRows();i++) {
                    var s = dt.getValue(i, column);
                    var m = Math.floor(s / 60);
                    var h = Math.floor(m / 60);
                    s = s % 60; m = m % 60;
                    var r = h + ":" + (m<10?"0"+m:m) + ":" + (s<10?"0"+s:s);
                    dt.setFormattedValue(i, column, r);
                }
            })(dt, 1);
        }
        
        if(options.data[0][1] == "Antal") {
            (function (dt, column) {
                for(var i=0;i<dt.getNumberOfRows();i++) {
                    dt.setFormattedValue(i, column, (Math.round(dt.getValue(i, column) * 100) / 100) + " st");
                }
            })(dt, 1);
        }
        
        var w = options.w || 468;
        var h = options.h || (w / 16 * 9);
        
        this.addClass('chart').each(function () {
            var chart = new google.visualization.PieChart(this);
            $(this).data('chart', chart);
            chart.draw(
                dt, {
                    width: w - 8,
                    height: h - 8,
                    title: title,
                    colors: options.colors,
                    pieSliceText: options.pieSliceText,
                    pieSliceTextStyle: {
                        fontSize: 10
                    }
                }
            );
        });
        
        (options.callback || $.noop).call(this);
        
        return this;
    };
    
})(jQuery);
