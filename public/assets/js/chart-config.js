const chartConfig = {
    chart: {
        height: 300,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '33%',
            borderRadius: 12,
            startingShape: 'rounded',
            endingShape: 'rounded'
        }
    },
    colors: [config.colors.primary, config.colors.info],
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
    },
    legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
            height: 8,
            width: 8,
            radius: 12,
            offsetX: -3
        },
        labels: {
            colors: axisColor
        },
        itemMargin: {
            horizontal: 10
        }
    },
    grid: {
        borderColor: borderColor,
        padding: {
            top: 0,
            bottom: -8,
            left: 20,
            right: 20
        }
    },
    xaxis: {
        labels: {
            style: {
                fontSize: '13px',
                colors: axisColor
            }
        },
        axisTicks: {
            show: false
        },
        axisBorder: {
            show: false
        }
    },
    yaxis: {
        labels: {
            style: {
                fontSize: '13px',
                colors: axisColor
            }
        }
    },
    responsive: [
        // ... Keep all the breakpoint configurations as is ...
    ],
    states: {
        hover: {
            filter: {
                type: 'none'
            }
        },
        active: {
            filter: {
                type: 'none'
            }
        }
    }
};
