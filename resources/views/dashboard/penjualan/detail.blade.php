<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold">Detail Penjualan {{ $stokis->nama_stokis }}</h3>
            <p class="mb-0 no-print">Lihat rincian dan informasi lengkap dari setiap transaksi penjualan yang tercatat.
            </p>
            <div class="mt-4 print">
                <div class="data mb-4">
                    <div>
                        <strong>Nama Stokis:</strong> {{ $stokis->nama_stokis }}
                    </div>
                    <div>
                        <strong>Kokab:</strong> {{ $stokis->kokab->nama_kokab ?? 'N/A' }}
                    </div>
                    <div>
                        <strong>Kecamatan:</strong> {{ $stokis->kecamatan->nama_kecamatan ?? 'N/A' }}
                    </div>
                    <div>
                        <strong>Member:</strong> {{ $stokis->member }}
                    </div>
                    <div>
                        <strong>Nama Member:</strong> {{ $stokis->nama_member }}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table caption-top">
                        <caption>Riwayat Penjualan</caption>
                        <thead class="table-dark">
                            <tr class="border-0">
                                <th class="rounded-start">Tahun</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>Mei</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Agt</th>
                                <th>Sep</th>
                                <th>Okt</th>
                                <th>Nov</th>
                                <th>Des</th>
                                <th class="rounded-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $penjualanItem)
                                @if (isset($penjualanItem->tahun))
                                    <tr>
                                        <td>{{ $penjualanItem->tahun ?? '-' }}</td>
                                        <td>{{ $penjualanItem->jan ?? '-' }}</td>
                                        <td>{{ $penjualanItem->feb ?? '-' }}</td>
                                        <td>{{ $penjualanItem->mar ?? '-' }}</td>
                                        <td>{{ $penjualanItem->apr ?? '-' }}</td>
                                        <td>{{ $penjualanItem->mei ?? '-' }}</td>
                                        <td>{{ $penjualanItem->jun ?? '-' }}</td>
                                        <td>{{ $penjualanItem->jul ?? '-' }}</td>
                                        <td>{{ $penjualanItem->agt ?? '-' }}</td>
                                        <td>{{ $penjualanItem->sep ?? '-' }}</td>
                                        <td>{{ $penjualanItem->okt ?? '-' }}</td>
                                        <td>{{ $penjualanItem->nov ?? '-' }}</td>
                                        <td>{{ $penjualanItem->des ?? '-' }}</td>
                                        <td>{{ $penjualanItem->total ?? '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td class="rounded-start"><strong>Subtotal</strong></td>
                                <td>{{ $penjualan->sum('jan') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('feb') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('mar') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('apr') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('mei') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('jun') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('jul') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('agt') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('sep') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('okt') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('nov') ?? '-' }}</td>
                                <td>{{ $penjualan->sum('des') ?? '-' }}</td>
                                <td class="rounded-end">{{ $penjualan->sum('total') ?? '-' }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="mt-3">
                    <canvas id="penjualanChart" width="600" height="200"></canvas>
                </div>
                <div class="mt-3 no-print">
                    <a class="btn btn-primary" onclick="window.print()">Cetak/Simpan</a>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    <script>
        const penjualanData = @json($penjualan);

        function getDataForYear(year) {
            const yearData = penjualanData.filter(item => item.tahun == year);

            const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

            const bulanData = bulan.map((month, index) => {
                const monthData = yearData.map(item => item[month.toLowerCase()]);
                return monthData.reduce((acc, val) => acc + val, 0);
            });

            return bulanData;
        }

        const tahunList = [...new Set(penjualanData.map(item => item.tahun))];

        const datasets = tahunList.map((tahun, index) => ({
            label: `${tahun}`,
            data: getDataForYear(tahun),
            borderColor: `hsl(${(index * 60) % 360}, 100%, 50%)`,
            fill: false,
            tension: 0.1,
            borderWidth: 1.5,
        }));

        const ctx = document.getElementById('penjualanChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov',
                    'Des'
                ],
                datasets: datasets,
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Bulan',
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Penjualan',
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
</x-layout>
