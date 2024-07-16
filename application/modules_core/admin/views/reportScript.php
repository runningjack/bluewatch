

<script type="text/javascript">
	function displayChart(obj) {
$("#chartModal").modal();
Highcharts.chart('chartDiv1', {
    chart: {
        type: 'pie'
    },
    title: {
        text: obj.id + ", 2019"
    },
    subtitle: {
        text: 'Click the slices to view percentage of unit'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.d}</b> of total<br/>'
    },

    series: [
        {
            name: "Budget Category",
            colorByPoint: true,
            data: [
                {
                    name: "Entertainment",
                    y: 62.75,
                    d: 200000,
                    drilldown: "Entertainment"
                },
                {
                    name: "Travel",
                    y: 31.25,
                    d: 95000,
                    drilldown: "Travel"
                },
                {
                    name: "Other",
                    y: 6.00,
                    d: 10000,
                    drilldown: null
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Entertainment",
                id: "Entertainment",
                data: [
                    [
                        "BAU",
                        5.0,
                        200
                    ],
                    [
                        "Finance",
                        20.5,
                        300
                    ],
                    [
                        "Admin",
                        45.5,
                        1000
                    ],
                    [
                        "Sales",
                        29.0,
                        500
                    ]
                ]
            },
            {
                name: "Travel",
                id: "Travel",
                data: [
                    [
                        "BAU",
                        4.0
                    ],
                    [
                        "Finance",
                        30.5
                    ],
                    [
                        "Admin",
                        50.5
                    ],
                    [
                        "Sales",
                        15.0
                    ]
                ]
            }
        ]
    }
});
		
	
Highcharts.chart('chartDiv', {
    chart: {
        type: 'pie'
    },
    title: {
        text: obj.id + ", 2019"
    },
    subtitle: {
        text: 'Click the slices to view percentage of unit'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.d}</b> of total<br/>'
    },

    series: [
        {
            name: "Budget Category",
            colorByPoint: true,
            data: [
                {
                    name: "Entertainment",
                    y: 62.75,
                    d: 200000,
                    drilldown: "Entertainment"
                },
                {
                    name: "Travel",
                    y: 31.25,
                    d: 95000,
                    drilldown: "Travel"
                },
                {
                    name: "Other",
                    y: 6.00,
                    d: 10000,
                    drilldown: null
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Entertainment",
                id: "Entertainment",
                data: [
                    [
                        "BAU",
                        5.0,
                        200
                    ],
                    [
                        "Finance",
                        20.5,
                        300
                    ],
                    [
                        "Admin",
                        45.5,
                        1000
                    ],
                    [
                        "Sales",
                        29.0,
                        500
                    ]
                ]
            },
            {
                name: "Travel",
                id: "Travel",
                data: [
                    [
                        "BAU",
                        4.0
                    ],
                    [
                        "Finance",
                        30.5
                    ],
                    [
                        "Admin",
                        50.5
                    ],
                    [
                        "Sales",
                        15.0
                    ]
                ]
            }
        ]
    }
});

Highcharts.chart('barChart', {

    chart: {
        type: 'column'
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',]
    },

    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Amount'
        }
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
        }
    },

    plotOptions: {
        column: {
            stacking: 'normal'
        }
    },

    series: [{
        name: 'Admin',
        data: [5, 3, 4, 7, 2, 5, 3, 4, 7, 2, 7, 2],
        stack: 'budget'
    }, {
        name: 'BAU',
        data: [3, 4, 4, 2, 5, 4, 7, 2, 5, 3, 4, 7],
        stack: 'budget'
    }, {
        name: 'Admin',
        data: [2, 5, 6, 2, 1, 4, 4, 2, 5, 4, 7, 2],
        stack: 'Used'
    }, {
        name: 'BAU',
        data: [3, 0, 4, 4, 3, 1, 4, 4, 2, 5, 4, 7, 2],
        stack: 'Used'
    }]
});

}
</script>