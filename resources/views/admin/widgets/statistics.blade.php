<div class="dashboard-container">
    <!-- Header Dashboard -->
    <div class="dashboard-header mb-4">
        <div class="d-flex align-items-center">
            <div class="school-logo me-3">
                <img src="{{ asset('/img/logo.png') }}" alt="Logo SMK Nurul Jadid" class="logo-img" onerror="this.style.display='none'">
            </div>
            <div>
                <h4 class="fw-bold mb-1 text-dark">Dashboard</h4>
                <p class="text-muted mb-0">Pangkalan data dan analisis sistem SMK Nurul Jadid</p>
            </div>
        </div>
    </div>

    {{-- Kartu Statistik Utama --}}
    <div class="row g-3 mb-4">
        @php
            $mainStats = [     
                'totalKepsek' => ['label' => 'Kepala Sekolah', 'value' => $totalKepsek ?? 0,'icon' => 'fas fa-user-tie'],       
                'totalBerita' => ['label' => 'Berita', 'value' => $totalBerita ?? 0, 'icon' => 'fas fa-newspaper'],
                'totalPengumuman' => ['label' => 'Pengumuman', 'value' => $totalPengumuman ?? 0,'icon' => 'fas fa-bullhorn'],
                'totalDownload' => ['label' => 'Dokumen', 'value' => $totalDownload ?? 0,'icon' => 'fas fa-download']
                // 'totalUser' => ['label' => 'User', 'value' => $totalUser ?? 0, 'icon' => 'fas fa-users'],
            ];
        @endphp
        
        @foreach ($mainStats as $key => $stat)
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-card-main">
                <div class="stat-icon">
                    <i class="{{ $stat['icon'] }}"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" data-value="{{ $stat['value'] }}">
                        {{ $stat['value'] >= 1000 ? number_format($stat['value'] / 1000, 1) . 'K' : number_format($stat['value']) }}
                    </h3>
                    <p class="stat-label">{{ $stat['label'] }}</p>
                    @if($stat['value'] >= 1000)
                    <small class="text-muted">({{ number_format($stat['value']) }} data)</small>
                    @endif
                </div>
                <div class="stat-badge">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Grid Statistik Lengkap --}}
    <div class="row g-3 mb-4">
        @php
            $allStats = [
                // 'totalDownload' => ['label' => 'Dokumen', 'icon' => 'fas fa-download'],
                'totalEkstrakurikuler' => ['label' => 'Ekstrakurikuler', 'icon' => 'fas fa-dumbbell'],
                'totalEkstraKategori' => ['label' => 'Kategori Ekstra', 'icon' => 'fas fa-tags'],
                'totalJurusan' => ['label' => 'Jurusan', 'icon' => 'fas fa-graduation-cap'],
                'totalFasilitas' => ['label' => 'Fasilitas', 'icon' => 'fas fa-school'],
                'totalGafoto' => ['label' => 'Galeri Foto', 'icon' => 'fas fa-images'],
                'totalGavideo' => ['label' => 'Galeri Video', 'icon' => 'fas fa-video'],
                // 'totalIdentitas' => ['label' => 'Identitas Sekolah', 'icon' => 'fas fa-id-card'],
                'totalAlumni' => ['label' => 'Alumni', 'icon' => 'fas fa-user-graduate'],
                'totalKataAlumni' => ['label' => 'Kata Alumni', 'icon' => 'fas fa-comment-alt'],
                // 'totalKepsek' => ['label' => 'Kepala Sekolah', 'icon' => 'fas fa-user-tie'],
                'totalLayanan' => ['label' => 'Layanan', 'icon' => 'fas fa-concierge-bell'],
                // 'totalPengumuman' => ['label' => 'Pengumuman', 'icon' => 'fas fa-bullhorn'],
                'totalPrestasi' => ['label' => 'Prestasi', 'icon' => 'fas fa-trophy'],
                // 'totalProfilSekolah' => ['label' => 'Profil Sekolah', 'icon' => 'fas fa-info-circle'],
                // 'totalVisiMisi' => ['label' => 'Visi & Misi', 'icon' => 'fas fa-bullseye'],
            ];
        @endphp

        @foreach ($allStats as $key => $stat)
        @php
            $value = ${$key} ?? 0;
            $formattedValue = $value >= 1000 ? number_format($value / 1000, 1) . 'K' : number_format($value);
        @endphp
        <div class="col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="stat-card stat-card-secondary">
                <div class="stat-icon-small">
                    <i class="{{ $stat['icon'] }}"></i>
                </div>
                <div class="stat-content text-center">
                    <h6 class="stat-label-small">{{ $stat['label'] }}</h6>
                    <h4 class="stat-value-small" data-value="{{ $value }}">
                        {{ $formattedValue }}
                    </h4>
                    @if($value >= 1000)
                    <small class="text-muted small-note">{{ number_format($value) }}</small>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Info Total Data --}}
    @php
        $totalAllData = array_sum([
            $totalAlumni ?? 0, $totalBerita ?? 0, $totalDownload ?? 0, $totalEkstrakurikuler ?? 0,
            $totalEkstraKategori ?? 0, $totalFasilitas ?? 0, $totalGafoto ?? 0, $totalGavideo ?? 0,
            $totalIdentitas ?? 0, $totalJurusan ?? 0, $totalKataAlumni ?? 0, $totalKepsek ?? 0,
            $totalLayanan ?? 0, $totalPengumuman ?? 0, $totalPrestasi ?? 0, $totalProfilSekolah ?? 0,
            // $totalUser ?? 0,
            $totalVisiMisi ?? 0
        ]);
    @endphp
    
    @if($totalAllData > 0)
    <div class="total-data-info mb-4">
        <div class="alert alert-success border-0">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-database me-2"></i>
                    <strong>Total Semua Data:</strong> 
                    <span class="total-count">{{ number_format($totalAllData) }}</span> records
                </div>
                <div class="text-end">
                    <small class="text-muted">
                        Rata-rata: {{ number_format(round($totalAllData / 18)) }} data per kategori
                    </small>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Section Charts --}}
    <div class="row g-4">
        {{-- Bar Chart --}}
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Data Sistem
                    </h5>
                    <div class="chart-actions">
                        <button class="btn-chart-action active" data-chart="bar">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                        <button class="btn-chart-action" data-chart="line">
                            <i class="fas fa-chart-line"></i>
                        </button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="chartStats" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Pie Chart --}}
        <div class="col-lg-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">
                        <i class="fas fa-chart-pie me-2"></i>
                        Distribusi Data
                    </h5>
                    <div class="chart-filter">
                        <select id="pieChartFilter" class="form-select form-select-sm">
                            <option value="all">Semua Data</option>
                            <option value="top5">Top 5 Terbanyak</option>
                            <option value="above10">Data > 10</option>
                        </select>
                    </div>
                </div>
                <div class="chart-container-pie">
                    <canvas id="pieChartStats" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Table (untuk data besar) --}}
    @if($totalAlumni > 100 || $totalAllData > 1000)
    <div class="row mt-4">
        <div class="col-12">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">
                        <i class="fas fa-table me-2"></i>
                        Detail Statistik Data
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th class="text-end">Jumlah Data</th>
                                <th class="text-end">Persentase</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allStats as $key => $stat)
                            @php
                                $value = ${$key} ?? 0;
                                $percentage = $totalAllData > 0 ? round(($value / $totalAllData) * 100, 1) : 0;
                            @endphp
                            <tr>
                                <td>
                                    <i class="{{ $stat['icon'] }} me-2 text-primary"></i>
                                    {{ $stat['label'] }}
                                </td>
                                <td class="text-end fw-bold">{{ number_format($value) }}</td>
                                <td class="text-end">
                                    <span class="badge bg-light text-dark">{{ $percentage }}%</span>
                                </td>
                                <td>
                                    @if($value == 0)
                                        <span class="badge bg-danger">Kosong</span>
                                    @elseif($value < 10)
                                        <span class="badge bg-warning">Sedikit</span>
                                    @elseif($value < 100)
                                        <span class="badge bg-info">Cukup</span>
                                    @else
                                        <span class="badge bg-success">Banyak</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Footer Info --}}
    <div class="dashboard-footer mt-4">
        <div class="alert alert-info alert-dashboard">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-3 fs-5"></i>
                <div>
                    <strong>Informasi:</strong> Statistik diperbarui otomatis berdasarkan data terkini di database.
                    Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}
                    @if($totalAllData > 1000)
                    | <strong>Total Data Sistem: {{ number_format($totalAllData) }}</strong>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script>
    // Data untuk charts
    const statsData = {
        @foreach($allStats as $key => $stat)
        "{{ $stat['label'] }}": {{ ${$key} ?? 0 }},
        @endforeach
    };

    const labels = Object.keys(statsData);
    const dataValues = Object.values(statsData);
    
    // Format number function
    function formatNumber(num) {
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1) + 'Jt';
        } else if (num >= 1000) {
            return (num / 1000).toFixed(1) + 'K';
        }
        return num.toString();
    }

    // Filter data untuk pie chart
    function getPieChartData(filterType = 'all') {
        let filteredLabels = [...labels];
        let filteredData = [...dataValues];
        
        if (filterType === 'top5') {
            // Ambil top 5 data terbanyak
            const indexed = dataValues.map((value, index) => ({ value, index }));
            indexed.sort((a, b) => b.value - a.value);
            const top5 = indexed.slice(0, 5);
            
            filteredLabels = top5.map(item => labels[item.index]);
            filteredData = top5.map(item => item.value);
        } else if (filterType === 'above10') {
            // Filter data yang lebih dari 10
            filteredLabels = labels.filter((label, index) => dataValues[index] > 10);
            filteredData = dataValues.filter(value => value > 10);
        }
        
        return { labels: filteredLabels, data: filteredData };
    }

    // Warna untuk charts
    const chartColors = [
        '#0d6efd', '#20c997', '#ffc107', '#dc3545', '#198754', 
        '#6610f2', '#fd7e14', '#6f42c1', '#0dcaf0', '#d63384',
        '#6f42c1', '#fd7e14', '#20c997', '#0d6efd', '#ffc107'
    ];

    // Bar/Line Chart
    const ctx = document.getElementById('chartStats');
    let currentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Data',
                data: dataValues,
                backgroundColor: chartColors,
                borderColor: chartColors.map(color => color),
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: false 
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw.toLocaleString()} data`;
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        precision: 0,
                        callback: function(value) {
                            return formatNumber(value);
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChartStats');
    let pieChartData = getPieChartData('all');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: pieChartData.labels,
            datasets: [{
                data: pieChartData.data,
                backgroundColor: chartColors.slice(0, pieChartData.labels.length),
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 11
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value.toLocaleString()} data (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '0%',
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Pie Chart Filter
    document.getElementById('pieChartFilter').addEventListener('change', function() {
        const filterType = this.value;
        const newData = getPieChartData(filterType);
        
        pieChart.data.labels = newData.labels;
        pieChart.data.datasets[0].data = newData.data;
        pieChart.data.datasets[0].backgroundColor = chartColors.slice(0, newData.labels.length);
        pieChart.update();
    });

    // Chart Type Toggle
    document.querySelectorAll('.btn-chart-action').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.btn-chart-action').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
            
            const chartType = this.getAttribute('data-chart');
            currentChart.destroy();
            currentChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Data',
                        data: dataValues,
                        backgroundColor: chartType === 'line' ? '#0d6efd' : chartColors,
                        borderColor: chartType === 'line' ? '#0d6efd' : chartColors.map(color => color),
                        borderWidth: 3,
                        fill: chartType === 'line',
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#0d6efd',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            display: false 
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw.toLocaleString()} data`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                precision: 0,
                                callback: function(value) {
                                    return formatNumber(value);
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        });
    });

    // Responsive adjustment for pie chart
    function adjustPieChart() {
        if (window.innerWidth < 992) {
            pieChart.options.plugins.legend.position = 'bottom';
        } else {
            pieChart.options.plugins.legend.position = 'right';
        }
        pieChart.update();
    }

    window.addEventListener('resize', adjustPieChart);
    adjustPieChart();
</script>

<style>
.dashboard-container {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 1px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.dashboard-header {
    padding-bottom: 1rem;
    border-bottom: 2px solid rgba(0,0,0,0.05);
}

.school-logo {
    width: 60px;
    height: 60px;
    border-radius: 7px;
    overflow: hidden;
    /* background: white; */
    padding: 5px;
    /* box-shadow: 0 2px 8px rgba(0,0,0,0.1); */
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.dashboard-icon {
    /* background: linear-gradient(135deg, #0d6efd, #6610f2); */
    color: #0d6efd;
    width: 60px;
    height: 60px;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* Stat Cards */
.stat-card {
    background: #fff;
    border-radius: 3px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.05);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stat-card-main {
    display: flex;
    align-items: center;
}

.stat-card-secondary {
    text-align: center;
    padding: 1.5rem 1rem;
    position: relative;
    min-height: 140px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.stat-icon {
    /* background: linear-gradient(135deg, #0d6efd, #6610f2); */
    color: #0d6efd;
    width: 60px;
    height: 60px;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 3.5rem;
}

.stat-icon-small {
    /* background: linear-gradient(135deg, #20c997, #198754); */
    color: #0d6efd;
    width: 50px;
    height: 50px;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
    font-size: 3.2rem;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #555555;
    margin: 0;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 600;
    margin: 0;
}

.stat-value-small {
    font-size: 1.8rem;
    font-weight: 700;
    color: #555555;
    margin: 0.5rem 0 0 0;
}

.stat-label-small {
    font-size: 0.85rem;
    color: #6c757d;
    font-weight: 600;
    margin: 0;
    line-height: 1.2;
}

.stat-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: rgba(13, 110, 253, 0.2);
    font-size: 1.2rem;
}

/* Chart Cards */
.chart-card {
    background: white;
    border-radius: 3px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.chart-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    flex: 1;
}

.chart-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-chart-action {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    color: #6c757d;
    width: 36px;
    height: 36px;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-chart-action:hover,
.btn-chart-action.active {
    background: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.chart-container {
    position: relative;
    height: 300px;
}

.chart-container-pie {
    position: relative;
    height: 380px;
    padding: 10px;
}

/* Footer Alert */
.alert-dashboard {
    border-radius: 3px;
    border: none;
    background: rgba(13, 110, 253, 0.05);
    border-left: 4px solid #0d6efd;
    color: #2c3e50;
    padding: 1rem 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .dashboard-header .d-flex {
        flex-direction: column;
        text-align: center;
    }
    
    .school-logo, .dashboard-icon {
        margin: 0 auto 1rem auto;
    }
    
    .stat-card-main {
        flex-direction: column;
        text-align: center;
    }
    
    .stat-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .chart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .chart-actions {
        align-self: flex-end;
    }
    
    .chart-container-pie {
        height: 320px;
    }
    
    .stat-card-secondary {
        min-height: 120px;
        padding: 1rem 0.5rem;
    }

        .dashboard-header {
        display: flex;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
    }

    .dashboard-header .school-logo {
        margin: 0 auto 10px auto !important;
        justify-content: center !important;
        align-items: center !important;
        display: flex !important;
        float: none !important;
    }

    .dashboard-header .logo-img {
        width: 70px;
        height: auto;
        display: block;
        margin: 0 auto;
    }
}

@media (max-width: 576px) {
    .stat-icon-small {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .stat-value-small {
        font-size: 1.4rem;
    }
    
    .stat-label-small {
        font-size: 0.75rem;
    }

    /* ==== LOGO RESPONSIVE (untuk HP ≤ 430–576px) ==== */
    .dashboard-header .d-flex {
        flex-direction: column !important; /* ubah susunan vertikal */
        align-items: center !important;    /* sejajarkan di tengah */
        justify-content: center;
        text-align: center;
        gap: 0.5rem;
    }

    .school-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70px;           /* ukuran sedikit lebih kecil */
        height: 70px;
        margin: 0 auto 0.75rem auto; /* beri jarak bawah */
        padding: 5px;
    }

    .logo-img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
}

</style>