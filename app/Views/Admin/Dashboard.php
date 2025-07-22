<?= $this->extend('Template/index'); ?>
<?= $this->Section('content'); ?>
<!-- Content Row -->

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $jumlah_pengguna; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Jenis Surat</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $jumlah_jenis_surat; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengajuan
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?= $jumlah_pengajuan; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Terlayani</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $jumlah_surat; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Laporan Pengajuan Surat
                </h6>
                <div class="dropdown no-arrow">

                    <form method="post" action="<?= base_url('Home'); ?>">
                        <select name="tahun" id="tahun" class="form-control" required onchange="this.form.submit();">
                            <?php 
                       $tahun = date('Y');
                       for($i = $tahun; $i >= 2024; $i--){
                       echo '<option value="'.$i.'" '.($selected_year == $i ? 'selected' : '').'>'.$i.'</option>';
                       }
                       ?>
                        </select>
                    </form>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartPengajuanSurat"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<!-- grafik -->
<script>
var data_grafik = <?= json_encode($data_grafik); ?>;
var bulan_ = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
var bulan = [];
var data_surat = [];
var data_pengajuan = [];
data_grafik.forEach(function(data) {
    bulan.push(bulan_[data.bulan - 1]);
    data_surat.push(data.data_surat);
    data_pengajuan.push(data.data_pengajuan);
});

var ctx = document.getElementById('chartPengajuanSurat').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: bulan,
        datasets: [{
            label: 'Surat',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: data_surat
        }, {
            label: 'Pengajuan',
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            data: data_pengajuan
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{ // y axis untuk menampilkan angka
                ticks: {
                    beginAtZero: true
                },


            }]
        },
        legend: {
            display: true
        },
        elements: {
            point: {
                radius: 0
            }
        },
        hover: {
            mode: 'index',
            intersect: false
        },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        maintainAspectRatio: false,

    }
});
</script>
<?= $this->endSection('script'); ?>