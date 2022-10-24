<script type="text/javascript">
    var temperatur = [];
    var nadi = [];
    var pernapasan = [];
    var sistol = [];
    var diastol = [];
    var skala_nyeri = [];
    var spo2 = [];
    var gula_darah_sewaktu = [];
    var map_sistol_diastol = [];
    var produksi_urine = [];
    var tanggal = [];
    var temperatur_json = [];
    var nadi_json = [];
    var pernapasan_json = [];
    var sistol_json = [];
    var diastol_json = [];
    var skala_nyeri_json = [];
    var spo2_json = [];
    var gula_darah_sewaktu_json = [];
    var map_sistol_diastol_json = [];
    var produksi_urine_json = [];
    var berat_badan = [];
    var berat_badan_json = [];
    var data_master = {};
    var count = "{{count($vitals)}}"
</script>


@foreach ($vitals as $item)
<script type="text/javascript">
    temperatur.push("{{$item->temperatur}}")
    nadi.push("{{$item->nadi}}")
    pernapasan.push("{{$item->pernapasan}}")
    sistol.push("{{$item->sistol}}")
    diastol.push("{{$item->diastol}}")
    skala_nyeri.push("{{$item->skala_nyeri}}")
    spo2.push("{{$item->spo2}}")
    gula_darah_sewaktu.push("{{$item->gula_darah_sewaktu}}")
    map_sistol_diastol.push("{{$item->map_sistol_diastol}}")
    produksi_urine.push("{{$item->produksi_urine}}")
    tanggal.push("{{$item->created_at_formatted_graph}}")
    berat_badan.push("{{$item->berat_badan}}")
</script>
@endforeach
<script type="text/javascript">
</script>

<script type="text/javascript">
    temperatur.reverse();
    nadi.reverse();
    pernapasan.reverse();
    sistol.reverse();
    diastol.reverse();
    skala_nyeri.reverse();
    spo2.reverse();
    gula_darah_sewaktu.reverse();
    map_sistol_diastol.reverse();
    produksi_urine.reverse();
    tanggal.reverse();
    berat_badan.reverse();
</script>

<script type="text/javascript">
    for (i = 0; i < count; i++) {    

        var temperatur_current = temperatur[i];  
        var nadi_current = nadi[i];  
        var pernapasan_current = pernapasan[i];  
        var sistol_current = sistol[i];  
        var diastol_current = diastol[i];  
        var skala_nyeri_current = skala_nyeri[i];  
        var spo2_current = spo2[i];  
        var gula_darah_sewaktu_current = gula_darah_sewaktu[i];  
        var map_sistol_diastol_current = map_sistol_diastol[i];  
        var produksi_urine_current = produksi_urine[i];  
        var berat_badan_current = berat_badan[i];
        var tanggal_current = tanggal[i];   

        if(temperatur_current != ''){
            temperatur_json.push({ 
                "date" : tanggal_current,
                "value"  : temperatur_current
            });
        }

        if(nadi_current != ''){
            nadi_json.push({ 
                "date" : tanggal_current,
                "value"  : nadi_current
            });
        }
        
        if(pernapasan_current != ''){
            pernapasan_json.push({ 
                "date" : tanggal_current,
                "value"  : pernapasan_current
            });
        }

        if(sistol_current != ''){
            sistol_json.push({ 
                "date" : tanggal_current,
                "value"  : sistol_current
            });
        }

        if(diastol_current != ''){
            diastol_json.push({ 
                "date" : tanggal_current,
                "value"  : diastol_current
            });
        }

        if(skala_nyeri_current != ''){
            skala_nyeri_json.push({ 
                "date" : tanggal_current,
                "value"  : skala_nyeri_current
            });
        }

        if(spo2_current != ''){
            spo2_json.push({ 
                "date" : tanggal_current,
                "value"  : spo2_current
            });
        }

        if(gula_darah_sewaktu_current != ''){
            gula_darah_sewaktu_json.push({ 
                "date" : tanggal_current,
                "value"  : gula_darah_sewaktu_current
            });
        }

        if(diastol_current != ''){
            map_sistol_diastol_json.push({ 
                "date" : tanggal_current,
                "value"  : map_sistol_diastol_current
            });
        }

        if(produksi_urine_current != ''){
            produksi_urine_json.push({ 
                "date" : tanggal_current,
                "value"  : produksi_urine_current
            });
        }

        if(berat_badan_current != ''){
            berat_badan_json.push({
                "date" : tanggal_current,
                "value" : berat_badan_current
            })
        }
    }
    data_master.temperatur = temperatur_json;
    data_master.nadi = nadi_json;
    data_master.pernapasan = pernapasan_json;
    data_master.sistol = sistol_json;
    data_master.diastol = diastol_json;
    data_master.skala_nyeri = skala_nyeri_json;
    data_master.spo2 = spo2_json;
    data_master.gula_darah_sewaktu = gula_darah_sewaktu_json;
    data_master.map_sistol_diastol = map_sistol_diastol_json;
    data_master.produksi_urine = produksi_urine_json;
    data_master.berat_badan = berat_badan_json;
</script>

<script type="text/javascript">

    var chartData = data_master.temperatur
    chart = AmCharts.makeChart("vitalSignCharts",
    {
        "type": "serial",
        "categoryField": "date",
        "dataDateFormat": "YYYY-MM-DD HH:NN",
        "pathToImages": "{{url('plugins/amcharts/images')}}/",
        "categoryAxis": {
            "minPeriod": "mm",
            "parseDates": true
        },
        "chartCursor": {
            "enabled": true,
            "categoryBalloonDateFormat": "DD MMM, JJ:NN"
        },
        "chartScrollbar": {
            "enabled": true
        },
        "trendLines": [],
        "graphs": [
        {
            "fillAlphas": 0.7,
            "id": "AmGraph-1",
            "lineAlpha": 0,
            "valueField": "value",
            "bullet" : "square",
            "bulletBorderThickness" : 1,
            "bulletBorderAlpha" : 1
        }
        ],
        "guides": [],
        "valueAxes": [
        {
            "id": "ValueAxis-1",
            "title": "Axis title"
        }
        ],
        "allLabels": [],
        "balloon": {},
        "legend": {
            "enabled": true
        },
        "dataProvider": chartData
    }
    );
</script>

<script type="text/javascript">
    function selectDataset(value) {
        chart.dataProvider =  data_master[value]
        chart.validateData();
        chart.startEffect = 'easeInSine';
        chart.startvalue = 0.5;
        chart.animateAgain();

        $('.vital-sign-chart-title').text(value);
    }
</script>