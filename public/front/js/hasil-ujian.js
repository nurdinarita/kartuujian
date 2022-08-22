function openNav() {
    $('#nav-right').css({ 'left': '0px' });
}
function closeNav() {
    $('#nav-right').css({ 'left': '100%' });
}
$('.nav-hamburger').click(function() {
    openNav();
});
$('.nav-close').click(function() {
    closeNav();
});

let borderWidthCount = '';
if(jawabanBenar > 0 && jawabanSalah == 0 && tidakDiJawab == 0) {
    borderWidthCount = 0;
} else if(jawabanBenar == 0 && jawabanSalah > 0 && tidakDiJawab == 0) {
    borderWidthCount = 0;
} else if(jawabanBenar == 0 && jawabanSalah == 0 && tidakDiJawab > 0) {
    borderWidthCount = 0;
} else if (jawabanBenar > 0 || jawabanSalah > 0 || tidakDiJawab > 0) {
    borderWidthCount = 1;
}

var config = {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                jawabanBenar,
                jawabanSalah,
                tidakDiJawab
            ],
            backgroundColor: [
                window.chartColors.green,
                window.chartColors.red,
                window.chartColors.orange,
            ],
            label: 'Dataset 1',
            borderColor: 'white',
            borderWidth: borderWidthCount
        }],
        labels: [
            'Jawaban Benar',
            'Jawaban Salah',
            'Tidak Dijawab'
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false
        },
    },
};

window.onload = function() {
    var ctx = document.getElementById('chart-area').getContext('2d');
    window.myPie = new Chart(ctx, config);
};