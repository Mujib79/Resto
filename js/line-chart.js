function showChart(){
    var tahun = document.getElementById('pilihtahun').value;
    ajax_operation("GET","manager/show-lineChart/"+tahun,"#ChartContent");
}

function addChart(val, tahun){
    const CHART = document.getElementById('lineChart');
    console.log(CHART);

    let lineChart = new Chart(CHART, {
        type: 'bar',
        data:
        {
            labels: ["Januari", "Februari", "Maret", "Apri", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                fill: false,
                label: 'Laporan Pemasukan Bulanan Tahun '+tahun,
                data: [ val[0], val[1], val[2], val[3], val[4], val[5], val[6], val[7], val[8], val[9], val[10], val[11] ],
                backgroundColor: '#320404',
                hoverBackgroundColor : '#5c2727',
                responsive: true,
                borderWidth: 3,
            }]
        },
        
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        },


    });
}
