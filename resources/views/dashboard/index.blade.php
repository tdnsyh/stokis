<x-layout>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Dashboard</h3>
            <p class="mb-0">Tampilan keseluruhan yang memudahkan pengelolaan data stokis, penjualan, dan wilayah secara
                efisien.</p>
            <div class="mt-4">
                <div class="row row-cols-1 row-cols-4">
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="card-title text-white">Total Kokab</div>
                                <h3 class="fw-bold text-white">{{ $totalKokab }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="card-title text-white">Total Kecamatan</div>
                                <h3 class="fw-bold text-white">{{ $totalKecamatan }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="card-title text-white">
                                    Total Stokis
                                </div>
                                <h3 class="fw-bold text-white">{{ $totalStokis }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="card-title text-white">Total Penjualan</div>
                                <h3 class="fw-bold text-white">
                                    {{ number_format($totalPenjualanKeseluruhan, 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Grafik</h3>
                <div class="row row-cols-1 row-cols-2">
                    <div class="col">
                        <canvas id="penjualanChart"></canvas>
                    </div>
                    <div class="col">
                        <div class="card bg-secondary">
                            <div class="card-body">
                                <h3 class="text-white">Total Penjualan per Tahun</h3>
                                <ul class="list-group">
                                    @foreach ($penjualanPerTahun as $data)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white">
                                            <span>Tahun {{ $data->tahun }}</span>
                                            <span>{{ number_format($data->total_penjualan, 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top">
                    <h3>
                        Top 3 Stokis
                    </h3>
                    <div class="table responsive">
                        <table class="table">
                            <thead class="table-dark border-0">
                                <tr>
                                    <th class="rounded-start">#</th>
                                    <th>Nama Stokis</th>
                                    <th class="rounded-end">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topStokis as $index => $stokis)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $stokis->nama_stokis }}</td>
                                        <td>{{ number_format($stokis->penjualan_sum_total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('penjualanChart').getContext('2d');

        var datasets = [];
        var colors = ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)',
            'rgba(75, 192, 192, 0.2)'
        ];
        var borderColors = ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)'];

        @foreach ($penjualanPerTahunn as $key => $data)
            datasets.push({
                label: '{{ $data->tahun }}',
                data: [
                    {{ $data->jan }},
                    {{ $data->feb }},
                    {{ $data->mar }},
                    {{ $data->apr }},
                    {{ $data->mei }},
                    {{ $data->jun }},
                    {{ $data->jul }},
                    {{ $data->agt }},
                    {{ $data->sep }},
                    {{ $data->okt }},
                    {{ $data->nov }},
                    {{ $data->des }},
                ],
                backgroundColor: colors[{{ $key }}],
                borderColor: borderColors[{{ $key }}],
                borderWidth: 1
            });
        @endforeach

        var penjualanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true
                        }
                    },
                    x: {
                        title: {
                            display: true,
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-layout>
