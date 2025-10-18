<?php require_once '../app/views/layouts/header.php'; ?>

<h1 class="mb-4">Dashboard</h1>

<div class="row g-4 mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-start-primary h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Siswa Terdaftar</div>
                        <div class="h5 mb-0 fw-bold text-gray-800"><?php echo $totalSiswa; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people-fill fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 fw-bold">Grafik Jumlah Siswa per Kelas</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 320px;">
                    <canvas id="siswaPerKelasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-start-primary { border-left: .25rem solid #2F4858 !important; }
    .text-primary { color: #2F4858 !important; }
    .text-gray-300 { color: #dddfeb !important; }
</style>

<?php require_once '../app/views/layouts/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('siswaPerKelasChart').getContext('2d');
        const siswaPerKelasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chartLabels); ?>,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: <?php echo json_encode($chartData); ?>,
                    backgroundColor: 'rgba(47, 72, 88, 0.8)',
                    borderColor: 'rgba(47, 72, 88, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        });
    });
</script>