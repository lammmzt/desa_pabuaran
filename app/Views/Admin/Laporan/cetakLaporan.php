<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengauan Surat Periode <?= date('d-m-Y', strtotime($tanggal_awal)) ?> s/d
        <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></title>
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
    }

    p {
        margin-top: 0;
        margin-bottom: 5px;
    }

    .table-header {
        width: 100%;
        margin-top: 0px;
    }

    .table-header tr:nth-child(even) {
        background-color: white;
    }

    .table-header td {
        padding: 5px;
    }

    .table-header td:first-child {
        padding-top: 0;
    }

    .table-header td:last-child {
        padding-bottom: 2px;
    }

    table {
        width: 99%;
        border-collapse: collapse;
    }

    table th {
        background-color: #f2f2f2;
        color: black;
    }

    table th,
    table td {
        padding: 8px;
        text-align: left;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }


    /* repeat .kop surat */
    .kop_surat {
        text-align: center;
        margin-bottom: 20px;
    }

    .kop_surat img {
        width: 100%;
        height: 150px;
    }

    /* table td auto fit  */
    table td {
        word-wrap: break-word;
        max-width: 200px;
        /* Set a max width for the cells */
    }

    /* media a4 */
    @page {
        size: 297mm 210mm;
    }
    </style>
    <script>
    window.print();

    window.onafterprint = function() {
        window.close();
    }
    </script>

<body>

    <div class="kop_surat">
        <!-- <img src="<?= base_url('Assets/img/KOP SURAT DISPERMADES BATANG.png') ?>" alt=""
            style="width: 100%; height: 130px;"> -->
        <table border="0" cellpadding="5" cellspacing="0" class="table-header">
            <tr>
                <td colspan="2">
                    <h2>Laporan Pengajuan Surat Periode <?= date('d-m-Y', strtotime($tanggal_awal)) ?> s/d
                        <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></h2>
                </td>
            </tr>

        </table>
    </div>
    <table border="1" cellpadding="5" cellspacing="0" style="margin: 0 auto; width: 95%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: center">No</th>
                <th style="text-align: center">Nomor Surat</th>
                <th style="text-align: center">Tanggal</th>
                <th style="text-align: center">Pemohon</th>
                <th style="text-align: center">Jenis Surat</th>
                <th style="text-align: center">Prihal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            ?>
            <?php foreach($data_surat as $jns): ?>
            <tr>
                <td style="text-align: center"><?= $no++; ?></td>
                <td style="text-align: center"><?= $jns['no_surat']; ?></td>
                <td style="text-align: center"><?= $jns['tanggal_surat']; ?></td>
                <td style="text-align: center"><?= $jns['nama_warga']; ?></td>
                <td style="text-align: center"><?= $jns['nama_jenis_surat']; ?></td>
                <td style="text-align: center"><?= $jns['keperluan_pengajuan']; ?></td>
            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>


</body>

</html>