<html>
<head>
	<title>My first chart using FusionCharts Suite XT</title>
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
	<script type="text/javascript">
		FusionCharts.ready(function(){
			var chartObj = new FusionCharts({
    type: 'column2d',
    renderAt: 'chart-container',
    width: '680',
    height: '390',
    dataFormat: 'json',
    dataSource: {
                "chart": {
                    "caption": "Stock de piezas",
                    "subCaption": "Mora Valk",
                    "xAxisName": "Nombre",
                    "yAxisName": "Cantidad",
                    "numberPrefix": "",
                    "theme": "none"
                },
        "data": [
            @foreach($piezas as $pieza)
            {
                "label": "{{$pieza->nombre}}",
                "value": "{{$pieza->stock}}"
            },
            @endforeach
        ],
        "trendlines": [{
            "line": [{
                "startvalue": "3",
                "valueOnRight": "1",
                "displayvalue": "Stock minimo"
            }]
        }]
    }
});
			chartObj.render();
		});
	</script>
	</head>
	<body>
		<div id="chart-container">FusionCharts XT will load here!</div>
	</body>
</html>