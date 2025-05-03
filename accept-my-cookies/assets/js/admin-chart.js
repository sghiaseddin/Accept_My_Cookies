document.addEventListener('DOMContentLoaded', function () {
    const rawData = acceptMyCookiesChartData.data;
    const labels = [...Array(31).keys()].map(i => i + 1); // days 1–31

    const canvas = document.createElement('canvas');
    document.getElementById('accept-my-cookies-charts').appendChild(canvas);

    const datasets = [];

    Object.entries(rawData).forEach(([attribute, values]) => {
        const trueData = labels.map(day => values['1'][day] || 0);
        const falseData = labels.map(day => values['0'][day] || 0);

        datasets.push({
            label: `${attribute}: True`,
            data: trueData,
            borderColor: getColor(attribute),
            borderWidth: 2,
            tension: 0.4,
        });

        datasets.push({
            label: `${attribute}: False`,
            data: falseData,
            borderColor: getColor(attribute),
            borderDash: [5, 5],
            borderWidth: 2,
            tension: 0.4,
        });
    });

    new Chart(canvas, {
        type: 'line',
        data: {
            labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: { boxWidth: 23, boxHeight: 0 }
                }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Count' } },
                x: { title: { display: true, text: 'Day of Month' } }
            }
        }
    });

    function getColor(attribute) {
        const colors = {
            essentials: '#1f77b4',
            analytics_storage: '#2ca02c',
            ad_storage: '#ff7f0e',
            ad_user_data: '#d62728',
            ad_personalization: '#9467bd'
        };
        return colors[attribute] || '#888';
    }
});