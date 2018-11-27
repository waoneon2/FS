jQuery(function($) {
// http://jsfiddle.net/Conner/hvfpaks4/6/
// "This one is for the space under the premier college preparatory program in the middle school section"

    $('#hvfpaks4-6').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Washington State Standardized Testing'
        },
        subtitle: {
            text: 'Seven Year Average Scores'
        },
        xAxis: {
            categories: [
                'Washington',
                'Bellingham',
                'St Pauls',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Test Scores (%)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{colorbypoint:true};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: '7th Grade ELA/Literacy',color: '#5b9bd5',
            data: [{y:65.9, color: '#5b9bd5'}, {y:73.9, color: '#5b9bd5'}, {y:93.5, color: '#5b9bd5'}]
            

        }, {
            name: '7th Grade Math',color: '#a5a5a5',
            data: [{y:57.2, color: '#a5a5a5'}, {y:68.5, color: '#a5a5a5'}, {y:82.1, color: '#a5a5a5'}]

        }, {
            name: '8th Grade Science',color: '#4472c4',
            data: [{y:60.9, color: '#4472c4'}, {y:72.0, color: '#4472c4'}, {y:85.8, color: '#4472c4'}]

        }]
    });

// http://jsfiddle.net/Conner/hvfpaks4/7/
// "This one is for the space under the academics section in the lower school section."

    $('#hvfpaks4-7').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Washington State Standardized Testing'
        },
        subtitle: {
            text: 'Seven Year Average Scores'
        },
        xAxis: {
            categories: [
                'Washington',
                'Bellingham',
                'St Pauls',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Test Scores (%)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{colorbypoint:true};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: '4th Grade ELA/Literacy',color: '#5b9bd5',
            data: [{y:63.6, color: '#5b9bd5'}, {y:69.1, color: '#5b9bd5'}, {y:87.6, color: '#5b9bd5'}]
            

        }, {
            name: '4th Grade Math',color: '#a5a5a5',
            data: [{y:59.5, color: '#a5a5a5'}, {y:64.2, color: '#a5a5a5'}, {y:83.3, color: '#a5a5a5'}]

        }, {
            name: '5th Grade Science',color: '#4472c4',
            data: [{y:56.7, color: '#4472c4'}, {y:68.6, color: '#4472c4'}, {y:81.6, color: '#4472c4'}]

        }]
    });

// http://jsfiddle.net/Conner/hvfpaks4/8/
// "This is the last one and it should be under the Premier College Preparatory Program in the Upper School."

    $('#hvfpaks4-8').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Average Advanced Placement Scores by Grade'
     
        },
        xAxis: {
            categories: [
                '12th',
                '11th',
                '10th',
                '9th',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Mean Test Scores'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{colorbypoint:true};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'St. Pauls',color: '#5b9bd5',
            data: [{y:3.75, color: '#5b9bd5'}, {y:3.94, color: '#5b9bd5'}, {y:4, color: '#5b9bd5'}, {y:4, color: '#5b9bd5'}]
            

        }, {
            name: 'Washington',color: '#a5a5a5',
            data: [{y:2.96, color: '#a5a5a5'}, {y:2.97, color: '#a5a5a5'}, {y:2.95, color: '#a5a5a5'}, {y:2.92, color: '#a5a5a5'}]

        }, {
            name: 'United States',color: '#4472c4',
            data: [{y:2.84, color: '#4472c4'}, {y:2.87, color: '#4472c4'}, {y:2.86, color: '#4472c4'}, {y:2.69, color: '#4472c4'}]
            

        }]
    });
});
