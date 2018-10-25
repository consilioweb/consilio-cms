;(function($){
    function icons_boxs() {
        $('#sparklinedash').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#7460ee'
        });
        $('#sparklinedash2').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#7460ee'
        });
        $('#sparklinedash3').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#7460ee'
        });
    }
    function graph_dash(){
        new Chartist.Line('.total-revenue4', {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            series: [
                [0, 2, 3, 0, 13, 1, 4, 1, 0 ,0 ,0, 0],
                [0, 4, 0, 4, 0, 4, 0, 4, 0 ,0 ,0, 0]
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
    new icons_boxs();
    new graph_dash();
}(jQuery));
