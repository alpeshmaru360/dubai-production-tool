document.addEventListener('DOMContentLoaded', function () {
    const chartElement = document.getElementById('compactChart');
    const requestTrainingCounts = JSON.parse(chartElement.dataset.requestTraining);
    const witnessTestCounts = JSON.parse(chartElement.dataset.witnessTest);
    const feedbackCounts = JSON.parse(chartElement.dataset.feedback);

    // Calculate totals
    const totalRequestTraining = requestTrainingCounts.reduce((a, b) => a + b, 0);
    const totalWitnessTest = witnessTestCounts.reduce((a, b) => a + b, 0);
    const totalFeedback = feedbackCounts.reduce((a, b) => a + b, 0);

    // Update totals in the boxes
    document.getElementById('totalRequestTraining').textContent = totalRequestTraining.toString().padStart(4, '0');
    document.getElementById('totalWitnessTest').textContent = totalWitnessTest.toString().padStart(4, '0');
    document.getElementById('totalFeedback').textContent = totalFeedback.toString().padStart(4, '0');

    // Chart initialization
    const ctx = chartElement.getContext('2d');

    // Professional Color Palettes
    const gradientRequestTraining = ctx.createLinearGradient(0, 0, 0, 200);
    gradientRequestTraining.addColorStop(0, 'rgba(0, 214, 255, 1)');
    gradientRequestTraining.addColorStop(1, 'rgba(0, 214, 255, 0.3)');

    const gradientWitnessTest = ctx.createLinearGradient(0, 0, 0, 200);
    gradientWitnessTest.addColorStop(0, 'rgba(255, 140, 0, 1)');
    gradientWitnessTest.addColorStop(1, 'rgba(255, 140, 0, 0.3)');

    const gradientFeedback = ctx.createLinearGradient(0, 0, 0, 200);
    gradientFeedback.addColorStop(0, 'rgba(125, 99, 255, 1)');
    gradientFeedback.addColorStop(1, 'rgba(125, 99, 255, 0.3)');

    // Compact Chart with sleek design
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Request Training',
                    data: requestTrainingCounts,
                    backgroundColor: gradientRequestTraining,
                    borderColor: 'rgba(0, 214, 255, 1)',
                    borderWidth: 1,
                    borderRadius: 0,
                    hoverBackgroundColor: 'rgba(0, 214, 255, 0.5)',
                    hoverBorderColor: 'rgba(0, 214, 255, 1)',
                    hoverBorderWidth: 2,
                    barPercentage: 1,
                    categoryPercentage: 0.9
                },
                {
                    label: 'Witness Test',
                    data: witnessTestCounts,
                    backgroundColor: gradientWitnessTest,
                    borderColor: 'rgba(255, 140, 0, 1)',
                    borderWidth: 1,
                    borderRadius: 0,
                    hoverBackgroundColor: 'rgba(255, 140, 0, 0.5)',
                    hoverBorderColor: 'rgba(255, 140, 0, 1)',
                    hoverBorderWidth: 2,
                    barPercentage: 1,
                    categoryPercentage: 0.9
                },
                {
                    label: 'Feedback',
                    data: feedbackCounts,
                    backgroundColor: gradientFeedback,
                    borderColor: 'rgba(125, 99, 255, 1)',
                    borderWidth: 1,
                    borderRadius: 0,
                    hoverBackgroundColor: 'rgba(125, 99, 255, 0.5)',
                    hoverBorderColor: 'rgba(125, 99, 255, 1)',
                    hoverBorderWidth: 2,
                    barPercentage: 1,
                    categoryPercentage: 0.9
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: {
                            size: 10,
                            family: 'Arial, sans-serif'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    stepSize: 2,
                    ticks: {
                        callback: function (value) {
                            return value;
                        },
                        font: {
                            size: 10,
                            family: 'Arial, sans-serif'
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [5, 5]
                    }
                }
            },
            plugins: {
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.5)',
                    borderWidth: 1,
                    bodySpacing: 6,
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw + ' requests';
                        }
                    }
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 10,
                            family: 'Arial, sans-serif'
                        },
                        boxWidth: 14
                    }
                }
            },
            animation: {
                duration: 800,
                easing: 'easeOutQuart'
            }
        }
    });
});
