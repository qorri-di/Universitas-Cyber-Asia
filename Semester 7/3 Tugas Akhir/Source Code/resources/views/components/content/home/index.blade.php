<div class="flex flex-col p-4 w-full">
    {{-- Chart Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Activity API -->
        <div class="bg-white p-4 rounded shadow">
            <h4 class="font-bold text-center mb-2">Activity API</h4>
            <canvas id="chartApi"></canvas>
        </div>

        <!-- Activity EDR -->
        <div class="bg-white p-4 rounded shadow">
            <h4 class="font-bold text-center mb-2">Activity EDR</h4>
            <canvas id="chartEdr"></canvas>
        </div>

        <!-- Activity ZTA -->
        <div class="bg-white p-4 rounded shadow">
            <h4 class="font-bold text-center mb-2">Activity ZTA</h4>
            <canvas id="chartZta"></canvas>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const apiLabels = {!! json_encode($chartApi->pluck('label')) !!};
        const apiTotal = {!! json_encode($chartApi->pluck('total_request')) !!};
        const apiSuccess = {!! json_encode($chartApi->pluck('success')) !!};
        const apiFailed = {!! json_encode($chartApi->pluck('failed')) !!};
        const apiRespTime = {!! json_encode($chartApi->pluck('avg_response')) !!};

        const edrLabels = {!! json_encode($chartEdr->pluck('label')) !!};
        const edrTotal = {!! json_encode($chartEdr->pluck('total_request')) !!};
        const edrSuccess = {!! json_encode($chartEdr->pluck('success')) !!};
        const edrFailed = {!! json_encode($chartEdr->pluck('failed')) !!};
        const edrRespTime = {!! json_encode($chartEdr->pluck('avg_response')) !!};

        const ztaLabels = {!! json_encode($chartZta->pluck('label')) !!};
        const ztaTotal = {!! json_encode($chartZta->pluck('total_request')) !!};
        const ztaSuccess = {!! json_encode($chartZta->pluck('success')) !!};
        const ztaFailed = {!! json_encode($chartZta->pluck('failed')) !!};
        const ztaRespTime = {!! json_encode($chartZta->pluck('avg_response')) !!};

        const createBarChart = (ctxId, labels, successData, failedData) => {
            new Chart(document.getElementById(ctxId), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Success',
                            data: successData,
                            backgroundColor: 'rgba(34,197,94,0.7)', // Green
                        },
                        {
                            label: 'Failed',
                            data: failedData,
                            backgroundColor: 'rgba(239,68,68,0.7)', // Red
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            ticks: { autoSkip: false }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        createBarChart('chartApi', apiLabels, apiSuccess, apiFailed);
        createBarChart('chartEdr', edrLabels, edrSuccess, edrFailed);
        createBarChart('chartZta', ztaLabels, ztaSuccess, ztaFailed);
    </script>
</div>
