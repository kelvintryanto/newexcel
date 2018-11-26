@extends('admin.layout.auth')

@section('content')
<?php $page = 'admin/kontrakSendEmail'?>
<div class="container" style="margin-left: 0px; margin-right: 0px; padding: 15px; width: 100%;">
    <div class="row">
        <div class="col-md-12">
             @if(\Session::has('alert-failed'))
                <div class="alert alert-failed">
                    <div>{{Session::get('alert-failed')}}</div>
                </div>
                @endif
                @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
                @endif

            <?php
                $dsn = 'mysql:host=localhost;dbname=newexcel';
                $username = 'root';
                $password = '';

                try{
                    $con = new PDO($dsn, $username,$password);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(Exception $ex){

                    echo 'Not Connected '.$ex->getMessage();
                }

                $tableContent = '';
                $start = '';
                $second = '';
                $selectStmt = $con->prepare('SELECT * FROM payroll');
                $selectStmt->execute();
                $users = $selectStmt->fetchAll();

                foreach ($users as $user) {
                    
                    $tableContent = $tableContent.'<tr>'.
                                // '<td>'.$user['no'].'</td>'.
                                '<td>'.$user['nik'].'</td>'.
                                '<td>'.$user['nama'].'</td>'.
                                '<td>'.$user['divisi'].'</td>'.
                                '<td>'.$user['keterangan_divisi'].'</td>'.
                                '<td>'.$user['kehadiran'].'</td>'.
                                '<td>'.$user['gaji_pokok'].'</td>'.
                                '<td>'.$user['insentif'].'</td>'.
                                '<td>'.$user['uang_makan'].'</td>'.
                                '<td>'.$user['transport'].'</td>'.
                                '<td>'.$user['asuransi'].'</td>'.
                                '<td>'.$user['lembur'].'</td>'.
                                '<td>'.$user['pengobatan'].'</td>'.
                                '<td>'.$user['lain'].'</td>'.
                                '<td>'.$user['pajak'].'</td>'.
                                '<td>'.$user['bpjs_non_tax'].'</td>'.
                                '<td>'.$user['bpjs_tax'].'</td>'.
                                '<td>'.$user['pot_gaji'].'</td>'.
                                '<td>'.$user['natura'].'</td>'.
                                '<td>'.$user['bantuan'].'</td>'.
                                '<td>'.$user['thr'].'</td>'.
                                '<td>'.$user['sub_total'].'</td>'.
                                '<td>'.$user['bulan'].'</td>'.
                                '<td>'.$user['tahun'].'</td>';
                }

                if(isset($_POST['search']))
                {

                    $start = $_POST['start'];
                    $second = $_POST['second'];
                    $tableContent = '';
                    $selectStmt = $con->prepare('SELECT * FROM payroll WHERE bulan like :start AND tahun like :second');
                    $selectStmt->execute(array(
                            ':start'=>$start,
                            ':second'=>$second
                        ));
                    $users = $selectStmt->fetchAll();

                    foreach ($users as $user) {
                        
                        $tableContent = $tableContent.'<tr>'.
                                    // '<td>'.$user['no'].'</td>'.
                                    '<td>'.$user['nik'].'</td>'.
                                    '<td>'.$user['nama'].'</td>'.
                                    '<td>'.$user['divisi'].'</td>'.
                                    '<td>'.$user['keterangan_divisi'].'</td>'.
                                    '<td>'.$user['kehadiran'].'</td>'.
                                    '<td>'.$user['gaji_pokok'].'</td>'.
                                    '<td>'.$user['insentif'].'</td>'.
                                    '<td>'.$user['uang_makan'].'</td>'.
                                    '<td>'.$user['transport'].'</td>'.
                                    '<td>'.$user['asuransi'].'</td>'.
                                    '<td>'.$user['lembur'].'</td>'.
                                    '<td>'.$user['pengobatan'].'</td>'.
                                    '<td>'.$user['lain'].'</td>'.
                                    '<td>'.$user['pajak'].'</td>'.
                                    '<td>'.$user['bpjs_non_tax'].'</td>'.
                                    '<td>'.$user['bpjs_tax'].'</td>'.
                                    '<td>'.$user['pot_gaji'].'</td>'.
                                    '<td>'.$user['natura'].'</td>'.
                                    '<td>'.$user['bantuan'].'</td>'.
                                    '<td>'.$user['thr'].'</td>'.
                                    '<td>'.$user['sub_total'].'</td>'.
                                    '<td>'.$user['bulan'].'</td>'.
                                    '<td>'.$user['tahun'].'</td>';
                    }
                }
            ?>

            <!-- Pemilihan Bulan dan Tahun Sending Email Karyawan Kontrak -->
            <div style="float: right; padding: 10px;">
                <form action="{{route('payroll')}}" method="POST">
                {{ csrf_field() }}
                <b>Bulan</b>
                <select id="bulan" name="start" style="margin-right: 10px;">
                    <option value="1" <?php if($start == '1') {echo 'selected';} ?>>Januari</option>
                    <option value="2" <?php if($start == '2') {echo 'selected';} ?>>Februari</option>
                    <option value="3" <?php if($start == '3') {echo 'selected';} ?>>Maret</option>
                    <option value="4" <?php if($start == '4') {echo 'selected';} ?>>April</option>
                    <option value="5" <?php if($start == '5') {echo 'selected';} ?>>Mei</option>
                    <option value="6" <?php if($start == '6') {echo 'selected';} ?>>Juni</option>
                    <option value="7" <?php if($start == '7') {echo 'selected';} ?>>Juli</option>
                    <option value="8" <?php if($start == '8') {echo 'selected';} ?>>Agustus</option>
                    <option value="9" <?php if($start == '9') {echo 'selected';} ?>>September</option>
                    <option value="10" <?php if($start == '10') {echo 'selected';} ?>>Oktober</option>
                    <option value="11" <?php if($start == '11') {echo 'selected';} ?>>November</option>
                    <option value="12" <?php if($start == '12') {echo 'selected';} ?>>Desember</option>
                </select>

                <b>Tahun</b>
                <select id="tahun" name="second">
                <option value="2018" <?php if($second == '2018') {echo 'selected';} ?>>2018</option>
                    <option value="2019" <?php if($second == '2019') {echo 'selected';} ?>>2019</option>
                    <option value="2020" <?php if($second == '2020') {echo 'selected';} ?>>2020</option>
                    <option value="2021" <?php if($second == '2021') {echo 'selected';} ?>>2021</option>
                </select>
                <input type="submit" name="search" value="Filter">
                </form>
            </div>

            <!-- Table Sending Email Karyawan Kontrak -->
            <div>
                <form action="{{ route('sendEmail') }}" method="POST" enctype="multipart/form-data">
                <input hidden name="nama" type="text" id="nama">
                <input hidden name="gaji" type="text" id="gaji">
                <input hidden name="email" type="text" id="email">
                   {{ csrf_field() }}
                    <table id="table" class="table table-hover" style="font-size: 12px;">
                        <tr class="table-head">
                            <!-- Slip Gaji Column 1-->
                            <th style="text-align: center;">Nama Karyawan</th>
                            <th style="text-align: center;">No.ID</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Nama Perusahaan</th>
                            <th style="text-align: center;">Periode Payroll</th>
                            <!-- Slip Gaji Column 2 -->
                            <th style="text-align: center;">Position</th>
                            <th style="text-align: center;">Channel</th>
                            <th style="text-align: center;">Tgl.Masuk</th>
                            <th style="text-align: center;">Kode Negara</th>
                            <!-- Space Column -->

                            <!-- HEADER + PENERIMAAN -->
                            <th style="text-align: center;">Penerimaan</th>
                            <!-- Penerimaan Column 1-->
                            <th style="text-align: center;">Commision</th>
                            <th style="text-align: center;">Override</th>
                            <th style="text-align: center;">Monthly Performance Allowance</th>
                            <th style="text-align: center;">Quarterly Production Allowance</th>
                            <th style="text-align: center;">Monthly Recruit Bonus</th>
                            <th style="text-align: center;">Operational Allowance</th>
                            <!-- Penerimaan Column 2 -->
                            <th style="text-align: center;">Other Allowance</th>
                            <th style="text-align: center;">Other Allowance 1</th>
                            <th style="text-align: center;">Other Allowance 2</th>
                            <th style="text-align: center;">Other Allowance 3</th>
                            <!-- Space Column -->                            
                            <th style="text-align: center;">Tax Allowance</th>

                            <!-- HEADER + PEMOTONGAN -->
                            <th style="text-align: center;">Pemotongan</th>
                            <!-- Pemotongan Column 1 -->
                            <th style="text-align: center;">Uang Muka</th>
                            <th style="text-align: center;">Pemotongan 1</th>
                            <th style="text-align: center;">Pemotongan 2</th>
                            <th style="text-align: center;">Pemotongan 3</th>
                            <th style="text-align: center;">Pemotongan 4</th>
                            <th style="text-align: center;">Pemotongan 5</th>
                            <th style="text-align: center;">Pemotongan 6</th>
                            <th style="text-align: center;">Pemotongan 7</th>
                            <th style="text-align: center;">PPh 21</th>
                            <th style="text-align: center;">Sanksi Pajak</th>

                            <!-- HEADER + SALDO/TAKE HOME PAY -->
                            <th style="text-align: center;">Take Home Pay</th>                                                    
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Send Email</th>
                        </tr>

                        <?php

                            echo $tableContent;

                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    var table = document.getElementById('table'),rIndex;
    for(var i = 0; i < table.rows.length;i++)
    {
        table.rows[i].onclick=function()
        {
            rIndex = this.rowIndex;
            document.getElementById("nama").value = this.cells[0].innerHTML;
            document.getElementById("gaji").value = this.cells[1].innerHTML;
            document.getElementById("email").value = this.cells[2].innerHTML;
        }
    }

    $(".alert-success").fadeTo(1000, 500).slideUp(500, function()
    {
        $(".alert-success").slideUp(500);
    });
</script>
@endsection