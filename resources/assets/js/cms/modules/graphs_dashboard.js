;(function($){
    function graph_dash(){

        var app_url = $("#app_url").val();
        var app_hash = $("#app_hash").val();


        $.ajax({
            type    : 'POST',
            url     : app_url + '/api/graph/visitors',
            data    : {
                hash : app_hash
            },
            success: function(data){

                new Chartist.Line('.graph-visitors', {
                    labels: [data.meses],
                    series: [
                    [13, 1]
                    ]
                }, {
                    high: 15,
                    low: 0,
                    showArea: false,
                    fullWidth: true,
                    plugins: [
                    Chartist.plugins.tooltip() 
                    ],
                    axisY: {
                        onlyInteger: true,
                        offset: 20,
                        labelInterpolationFnc: function(value) {
                            return (value / 1);
                        }
                    }
                });
            }
        });




    }
    new graph_dash();
}(jQuery));
