/*
Template Name: SIAKAD - Sistem Informasi Akademik
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Timeline Chart init js
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        colors = JSON.parse(colors);
        return colors.map(function (value) {
            var newValue = value.replace(" ", "");
            if (newValue.indexOf(",") === -1) {
                var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                if (color) return color;
                else return newValue;;
            } else {
                var val = value.split(',');
                if (val.length == 2) {
                    var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                    rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                    return rgbaColor;
                } else {
                    return newValue;
                }
            }
        });
    }
}



// Basic Timeline Charts
var chartTimelineBasicColors = getChartColorsArray("basic_timeline");
if (chartTimelineBasicColors) {
    var options = {
        series: [{
            data: [{
                x: 'Code',
                y: [
                    new Date('2019-03-02').getTime(),
                    new Date('2019-03-04').getTime()
                ]
            },
            {
                x: 'Test',
                y: [
                    new Date('2019-03-04').getTime(),
                    new Date('2019-03-08').getTime()
                ]
            },
            {
                x: 'Validation',
                y: [
                    new Date('2019-03-08').getTime(),
                    new Date('2019-03-12').getTime()
                ]
            },
            {
                x: 'Deployment',
                y: [
                    new Date('2019-03-12').getTime(),
                    new Date('2019-03-18').getTime()
                ]
            }
            ]
        }],
        chart: {
            height: 350,
            type: 'rangeBar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        xaxis: {
            type: 'datetime'
        },
        colors: chartTimelineBasicColors
    };

    var chart = new ApexCharts(document.querySelector("#basic_timeline"), options);
    chart.render();
}


// Different Color For Each Bar
var chartTimelineColors = getChartColorsArray("color_timeline");
if (chartTimelineColors) {
    var options = {
        series: [{
            data: [{
                x: 'Analysis',
                y: [
                    new Date('2019-02-27').getTime(),
                    new Date('2019-03-04').getTime()
                ],
                fillColor: chartTimelineColors[0]
            },
            {
                x: 'Design',
                y: [
                    new Date('2019-03-04').getTime(),
                    new Date('2019-03-08').getTime()
                ],
                fillColor: chartTimelineColors[1]
            },
            {
                x: 'Coding',
                y: [
                    new Date('2019-03-07').getTime(),
                    new Date('2019-03-10').getTime()
                ],
                fillColor: chartTimelineColors[2]
            },
            {
                x: 'Testing',
                y: [
                    new Date('2019-03-08').getTime(),
                    new Date('2019-03-12').getTime()
                ],
                fillColor: chartTimelineColors[3]
            },
            {
                x: 'Deployment',
                y: [
                    new Date('2019-03-12').getTime(),
                    new Date('2019-03-17').getTime()
                ],
                fillColor: chartTimelineColors[4]
            }
            ]
        }],
        chart: {
            height: 350,
            type: 'rangeBar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                distributed: true,
                dataLabels: {
                    hideOverflowingLabels: false
                }
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                var label = opts.w.globals.labels[opts.dataPointIndex]
                var a = moment(val[0])
                var b = moment(val[1])
                var diff = b.diff(a, 'days')
                return label + ': ' + diff + (diff > 1 ? ' days' : ' day')
            },
        },
        xaxis: {
            type: 'datetime'
        },
        yaxis: {
            show: true
        },

    };

    var chart = new ApexCharts(document.querySelector("#color_timeline"), options);
    chart.render();
}

// Multi Series Timeline
var chartTimelineMultiSeriesColors = getChartColorsArray("multi_series");
if (chartTimelineMultiSeriesColors) {
    var options = {
        series: [{
            name: 'Bob',
            data: [{
                x: 'Design',
                y: [
                    new Date('2019-03-05').getTime(),
                    new Date('2019-03-08').getTime()
                ]
            },
            {
                x: 'Code',
                y: [
                    new Date('2019-03-08').getTime(),
                    new Date('2019-03-11').getTime()
                ]
            },
            {
                x: 'Test',
                y: [
                    new Date('2019-03-11').getTime(),
                    new Date('2019-03-16').getTime()
                ]
            }
            ]
        },
        {
            name: 'Joe',
            data: [{
                x: 'Design',
                y: [
                    new Date('2019-03-02').getTime(),
                    new Date('2019-03-05').getTime()
                ]
            },
            {
                x: 'Code',
                y: [
                    new Date('2019-03-06').getTime(),
                    new Date('2019-03-09').getTime()
                ]
            },
            {
                x: 'Test',
                y: [
                    new Date('2019-03-10').getTime(),
                    new Date('2019-03-19').getTime()
                ]
            }
            ]
        }
        ],
        chart: {
            height: 350,
            type: 'rangeBar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                var a = moment(val[0])
                var b = moment(val[1])
                var diff = b.diff(a, 'days')
                return diff + (diff > 1 ? ' days' : ' day')
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [50, 0, 100, 100]
            }
        },
        xaxis: {
            type: 'datetime'
        },
        legend: {
            position: 'top'
        },
        colors: chartTimelineMultiSeriesColors
    };

    var chart = new ApexCharts(document.querySelector("#multi_series"), options);
    chart.render();
}

// Advanced Timeline (Multiple Range)
var chartTimelineAdvancedColors = getChartColorsArray("advanced_timeline");
if (chartTimelineAdvancedColors) {
    var options = {
        series: [{
            name: 'Bob',
            data: [{
                x: 'Design',
                y: [
                    new Date('2019-03-05').getTime(),
                    new Date('2019-03-08').getTime()
                ]
            },
            {
                x: 'Code',
                y: [
                    new Date('2019-03-02').getTime(),
                    new Date('2019-03-05').getTime()
                ]
            },
            {
                x: 'Code',
                y: [
                    new Date('2019-03-05').getTime(),
                    new Date('2019-03-07').getTime()
                ]
            },
            {
                x: 'Test',
                y: [
                    new Date('2019-03-03').getTime(),
                    new Date('2019-03-09').getTime()
                ]
            },
            {
                x: 'Test',
                y: [
                    new Date('2019-03-08').getTime(),
                    new Date('2019-03-11').getTime()
                ]
            },
            {
                x: 'Validation',
                y: [
                    new Date('2019-03-11').getTime(),
                    new Date('2019-03-16').getTime()
                ]
            },
            {
                x: 'Design',
                y: [
                    new Date('2019-03-01').getTime(),
                    new Date('2019-03-03').getTime()
                ]
            }
            ]
        },
        {
            name: 'Joe',
            data: [{
                x: 'Design',
                y: [
                    new Date('2019-03-02').getTime(),
                    new Date('2019-03-05').getTime()
                ]
            },
            {
                x: 'Test',
                y: [
                    new Date('2019-03-06').getTime(),
                    new Date('2019-03-16').getTime()
                ]
            },
            {
                x: 'Code',
                y: [
                    new Date('2019-03-03').getTime(),
                    new Date('2019-03-07').getTime()
                ]
            },
            {
                x: 'Deployment',
                y: [
                    new Date('2019-03-20').getTime(),
                    new Date('2019-03-22').getTime()
                ]
            },
            {
                x: 'Design',
                y: [
                    new Date('2019-03-10').getTime(),
                    new Date('2019-03-16').getTime()
                ]
            }
            ]
        },
        {
            name: 'Dan',
            data: [{
                x: 'Code',
                y: [
                    new Date('2019-03-10').getTime(),
                    new Date('2019-03-17').getTime()
                ]
            },
            {
                x: 'Validation',
                y: [
                    new Date('2019-03-05').getTime(),
                    new Date('2019-03-09').getTime()
                ]
            },
            ]
        }
        ],
        chart: {
            height: 350,
            type: 'rangeBar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '80%'
            }
        },
        xaxis: {
            type: 'datetime'
        },
        stroke: {
            width: 1
        },
        fill: {
            type: 'solid',
            opacity: 0.6
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        },
        colors: chartTimelineAdvancedColors
    };

    var chart = new ApexCharts(document.querySelector("#advanced_timeline"), options);
    chart.render();
}

// Multiple series � Group rows
var chartMultiSeriesGroupColors = getChartColorsArray("multi_series_group");
if (chartMultiSeriesGroupColors) {
    var options = {
        series: [
            // George Washington
            {
                name: 'George Washington',
                data: [
                    {
                        x: 'President',
                        y: [
                            new Date(1789, 3, 30).getTime(),
                            new Date(1797, 2, 4).getTime()
                        ]
                    },
                ]
            },
            // John Adams
            {
                name: 'John Adams',
                data: [
                    {
                        x: 'President',
                        y: [
                            new Date(1797, 2, 4).getTime(),
                            new Date(1801, 2, 4).getTime()
                        ]
                    },
                    {
                        x: 'Vice President',
                        y: [
                            new Date(1789, 3, 21).getTime(),
                            new Date(1797, 2, 4).getTime()
                        ]
                    }
                ]
            },
            // Thomas Jefferson
            {
                name: 'Thomas Jefferson',
                data: [
                    {
                        x: 'President',
                        y: [
                            new Date(1801, 2, 4).getTime(),
                            new Date(1809, 2, 4).getTime()
                        ]
                    },
                    {
                        x: 'Vice President',
                        y: [
                            new Date(1797, 2, 4).getTime(),
                            new Date(1801, 2, 4).getTime()
                        ]
                    },
                    {
                        x: 'Secretary of State',
                        y: [
                            new Date(1790, 2, 22).getTime(),
                            new Date(1793, 11, 31).getTime()
                        ]
                    }
                ]
            },
            // Aaron Burr
            {
                name: 'Aaron Burr',
                data: [
                    {
                        x: 'Vice President',
                        y: [
                            new Date(1801, 2, 4).getTime(),
                            new Date(1805, 2, 4).getTime()
                        ]
                    }
                ]
            },
            // George Clinton
            {
                name: 'George Clinton',
                data: [
                    {
                        x: 'Vice President',
                        y: [
                            new Date(1805, 2, 4).getTime(),
                            new Date(1812, 3, 20).getTime()
                        ]
                    }
                ]
            },
            // John Jay
            {
                name: 'John Jay',
                data: [
                    {
                        x: 'Secretary of State',
                        y: [
                            new Date(1789, 8, 25).getTime(),
                            new Date(1790, 2, 22).getTime()
                        ]
                    }
                ]
            },
            // Edmund Randolph
            {
                name: 'Edmund Randolph',
                data: [
                    {
                        x: 'Secretary of State',
                        y: [
                            new Date(1794, 0, 2).getTime(),
                            new Date(1795, 7, 20).getTime()
                        ]
                    }
                ]
            },
            // Timothy Pickering
            {
                name: 'Timothy Pickering',
                data: [
                    {
                        x: 'Secretary of State',
                        y: [
                            new Date(1795, 7, 20).getTime(),
                            new Date(1800, 4, 12).getTime()
                        ]
                    }
                ]
            },
            // Charles Lee
            {
                name: 'Charles Lee',
                data: [
                    {
                        x: 'Secretary of State',
                        y: [
                            new Date(1800, 4, 13).getTime(),
                            new Date(1800, 5, 5).getTime()
                        ]
                    }
                ]
            },
            // John Marshall
            {
                name: 'John Marshall',
                data: [
                    {
                        x: 'Secretary of State',
                        y: [
                            new Date(1800, 5, 13).getTime(),
                            new Date(1801, 2, 4).getTime()
                        ]
                    }
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'rangeBar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '35%',
                rangeBarGroupRows: true
            }
        },
        colors: chartMultiSeriesGroupColors,
        fill: {
            type: 'solid'
        },
        xaxis: {
            type: 'datetime'
        },
        legend: {
            position: 'right'
        },
        tooltip: {
            custom: function (opts) {
                const fromYear = new Date(opts.y1).getFullYear()
                const toYear = new Date(opts.y2).getFullYear()
                const values = opts.ctx.rangeBar.getTooltipValues(opts)

                return (
                    '<div class="apexcharts-tooltip-rangebar">' +
                    '<div> <span class="series-name" style="color: ' +
                    values.color +
                    '">' +
                    (values.seriesName ? values.seriesName : '') +
                    '</span></div>' +
                    '<div> <span class="category">' +
                    values.ylabel +
                    ' </span> <span class="value start-value">' +
                    fromYear +
                    '</span> <span class="separator">-</span> <span class="value end-value">' +
                    toYear +
                    '</span></div>' +
                    '</div>'
                )
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#multi_series_group"), options);
    chart.render();
}

// dumbbell_chart
var dumbbellChartColors = getChartColorsArray("dumbbell_chart");
if (dumbbellChartColors) {
    var options = {
        series: [
            {
                data: [
                    {
                        x: 'Operations',
                        y: [2800, 4500]
                    },
                    {
                        x: 'Customer Success',
                        y: [3200, 4100]
                    },
                    {
                        x: 'Engineering',
                        y: [2950, 7800]
                    },
                    {
                        x: 'Marketing',
                        y: [3000, 4600]
                    },
                    {
                        x: 'Product',
                        y: [3500, 4100]
                    },
                    {
                        x: 'Data Science',
                        y: [4500, 6500]
                    },
                    {
                        x: 'Sales',
                        y: [4100, 5600]
                    }
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'rangeBar',
            zoom: {
                enabled: false
            }
        },
        colors: ['#EC7D31', '#36BDCB'],
        plotOptions: {
            bar: {
                horizontal: true,
                isDumbbell: true,
                dumbbellColors: dumbbellChartColors
            }
        },
        title: {
            text: 'Paygap Disparity'
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            position: 'top',
            horizontalAlign: 'left',
            customLegendItems: ['Female', 'Male']
        },
        fill: {
            type: 'gradient',
            gradient: {
                gradientToColors: ['#36BDCB'],
                inverseColors: false,
                stops: [0, 100]
            }
        },
        grid: {
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: false
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#dumbbell_chart"), options);
    chart.render();
}