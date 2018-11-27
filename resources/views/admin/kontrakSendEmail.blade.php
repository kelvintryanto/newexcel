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
                $selectStmt = $con->prepare('SELECT * FROM payrollKontrak as pk,karyawankontrak as kk,users as u where pk.no_id = kk.no_id and u.name = pk.nama');
                $selectStmt->execute();
                $users = $selectStmt->fetchAll();

                foreach ($users as $user) {
                    $bulan = $user['bulan'];
                        
                        switch ($bulan){
                            case "1" : $periode = "Januari "; break;
                            case "2" : $periode = "Februari "; break;
                            case "3" : $periode = "Maret "; break;
                            case "4" : $periode = "April "; break;
                            case "5" : $periode = "Mei "; break;
                            case "6" : $periode = "Juni "; break;
                            case "7" : $periode = "Juli "; break;
                            case "8" : $periode = "Agustus "; break;
                            case "9" : $periode = "September "; break;
                            case "10" : $periode = "Oktober "; break;
                            case "11" : $periode = "November "; break;
                            case "11" : $periode = "Desember "; break;                    
                        }

                        $periode .= $user['tahun'];
                    
                    $tableContent = $tableContent.'<tr>'.
                                // '<td>'.$user['no'].'</td>'.
                                //slip gaji column 1
                                '<td>'.$user['nama'].'</td>'. //0
                                '<td hidden>'.$user['no_id'].'</td>'. //1
                                '<td hidden>'.$user['kode_status'].'</td>'.//2
                                '<td hidden>PT MANDIRI KONSULTAMA PERKASA</td>'. //3
                                '<td hidden>'.$periode.'</td>'. //4
                                //slip gaji column 2
                                '<td hidden>'.$user['jabatan'].'</td>'. //5
                                '<td hidden>'.$user['channel'].'</td>'. //6
                                '<td hidden>'.$user['mulai_kerja'].'</td>'. //7
                                '<td hidden>'.$user['kode_negara'].'</td>'. //8
                                //space untuk tanda tangan

                                //penerimaan header
                                '<td hidden>'.$user['subtotal_penerimaan'].'</td>'. //9
                                //penerimaan column 1
                                '<td hidden>'.$user['commision'].'</td>'. //10
                                '<td hidden>'.$user['override'].'</td>'. //11
                                '<td hidden>'.$user['monthlyperformance'].'</td>'. //12
                                '<td hidden>'.$user['quarterlyproduction'].'</td>'. //13
                                '<td hidden>'.$user['monthlyrecruit'].'</td>'. //14
                                '<td hidden>'.$user['operationalallowance'].'</td>'. //15
                                //penerimaan column 2
                                '<td hidden>'.$user['otherallowance'].'</td>'.//16
                                '<td hidden>'.$user['allowance1'].'</td>'. //17
                                '<td hidden>'.$user['allowance2'].'</td>'. //18
                                '<td hidden>'.$user['allowance3'].'</td>'. //19
                                //space kosong
                                '<td hidden>'.$user['tax_allowance'].'</td>'. //20
                                
                                //pemotongan header
                                '<td hidden>'.$user['subtotal_potongan'].'</td>'. //21
                                // pemotongan column 1
                                '<td hidden>'.$user['uangmuka'].'</td>'. //22
                                '<td hidden>'.$user['pemotongan1'].'</td>'. //23
                                '<td hidden>'.$user['pemotongan2'].'</td>'. //24
                                '<td hidden>'.$user['pemotongan3'].'</td>'. //25
                                '<td hidden>'.$user['pemotongan4'].'</td>'. //26
                                //pemotongan column 2
                                '<td hidden>'.$user['pemotongan5'].'</td>'. //27
                                '<td hidden>'.$user['pemotongan6'].'</td>'. //28
                                '<td hidden>'.$user['pemotongan7'].'</td>'. //29
                                '<td hidden>'.$user['pph2126'].'</td>'. //30
                                '<td hidden>'.$user['sanksipajak'].'</td>'. //31
                                
                                // saldo/take home pay
                                '<td hidden>'.$user['nilaidibayar'].'</td>'. //32

                                //tambahan bulan dan tahun untuk filter
                                '<td style="text-align:center">'.$user['bulan'].'</td>'.
                                '<td style="text-align:center">'.$user['tahun'].'</td>'.
                                '<td>'.$user['email'].'</td>'.
                                '<td name="btn_send" id="btn_send" style="text-align:center"><button>Send</button></td';
                                
                }

                if(isset($_POST['search']))
                {

                    $start = $_POST['start'];
                    $second = $_POST['second'];
                    $tableContent = '';
                    $selectStmt = $con->prepare('SELECT * FROM payrollKontrak as pk,karyawankontrak as kk,users as u where bulan like :start AND tahun like :second and pk.no_id = kk.no_id and u.name = pk.nama');
                    $selectStmt->execute(array(
                            ':start'=>$start,
                            ':second'=>$second
                        ));
                    $users = $selectStmt->fetchAll();

                    foreach ($users as $user) {
                        $bulan = $user['bulan'];
                        
                        switch ($bulan){
                            case "1" : $periode = "Januari "; break;
                            case "2" : $periode = "Februari "; break;
                            case "3" : $periode = "Maret "; break;
                            case "4" : $periode = "April "; break;
                            case "5" : $periode = "Mei "; break;
                            case "6" : $periode = "Juni "; break;
                            case "7" : $periode = "Juli "; break;
                            case "8" : $periode = "Agustus "; break;
                            case "9" : $periode = "September "; break;
                            case "10" : $periode = "Oktober "; break;
                            case "11" : $periode = "November "; break;
                            case "11" : $periode = "Desember "; break;                    
                        }

                        $periode .= $user['tahun'];
                        $tableContent = $tableContent.'<tr>'.
                                // '<td>'.$user['no'].'</td>'.
                                //slip gaji column 1
                                '<td>'.$user['nama'].'</td>'. //0
                                '<td hidden>'.$user['no_id'].'</td>'. //1
                                '<td hidden>'.$user['kode_status'].'</td>'.//2
                                '<td hidden>PT MANDIRI KONSULTAMA PERKASA</td>'. //3
                                '<td hidden>'.$periode.'</td>'. //4
                                //slip gaji column 2
                                '<td hidden>'.$user['jabatan'].'</td>'. //5
                                '<td hidden>'.$user['channel'].'</td>'. //6
                                '<td hidden>'.$user['mulai_kerja'].'</td>'. //7
                                '<td hidden>'.$user['kode_negara'].'</td>'. //8
                                //space untuk tanda tangan

                                //penerimaan header
                                '<td hidden>'.$user['subtotal_penerimaan'].'</td>'. //9
                                //penerimaan column 1
                                '<td hidden>'.$user['commision'].'</td>'. //10
                                '<td hidden>'.$user['override'].'</td>'. //11
                                '<td hidden>'.$user['monthlyperformance'].'</td>'. //12
                                '<td hidden>'.$user['quarterlyproduction'].'</td>'. //13
                                '<td hidden>'.$user['monthlyrecruit'].'</td>'. //14
                                '<td hidden>'.$user['operationalallowance'].'</td>'. //15
                                //penerimaan column 2
                                '<td hidden>'.$user['otherallowance'].'</td>'.//16
                                '<td hidden>'.$user['allowance1'].'</td>'. //17
                                '<td hidden>'.$user['allowance2'].'</td>'. //18
                                '<td hidden>'.$user['allowance3'].'</td>'. //19
                                //space kosong
                                '<td hidden>'.$user['tax_allowance'].'</td>'. //20
                                
                                //pemotongan header
                                '<td hidden>'.$user['subtotal_potongan'].'</td>'. //21
                                // pemotongan column 1
                                '<td hidden>'.$user['uangmuka'].'</td>'. //22
                                '<td hidden>'.$user['pemotongan1'].'</td>'. //23
                                '<td hidden>'.$user['pemotongan2'].'</td>'. //24
                                '<td hidden>'.$user['pemotongan3'].'</td>'. //25
                                '<td hidden>'.$user['pemotongan4'].'</td>'. //26
                                //pemotongan column 2
                                '<td hidden>'.$user['pemotongan5'].'</td>'. //27
                                '<td hidden>'.$user['pemotongan6'].'</td>'. //28
                                '<td hidden>'.$user['pemotongan7'].'</td>'. //29
                                '<td hidden>'.$user['pph2126'].'</td>'. //30
                                '<td hidden>'.$user['sanksipajak'].'</td>'. //31
                                
                                // saldo/take home pay
                                '<td hidden>'.$user['nilaidibayar'].'</td>'. //32

                                //tambahan bulan dan tahun untuk filter
                                '<td style="text-align:center">'.$user['bulan'].'</td>'.
                                '<td style="text-align:center">'.$user['tahun'].'</td>'.
                                '<td>'.$user['email'].'</td>'.
                                '<td name="btn_send" id="btn_send" style="text-align:center"><button>Send</button></td';
                    }
                }
            ?>

            <!-- Pemilihan Bulan dan Tahun Sending Email Karyawan Kontrak -->
            <div style="float: right; padding: 10px;">
                <form action="{{route('kontrakSendEmail')}}" method="POST">
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
                   {{ csrf_field() }}
                    <table id="table" class="table table-hover" style="font-size: 12px;">
                        <tr class="table-head">
                            <th hidden colspan="9" style="text-align: center;">SLIP GAJI</th>
                            <th hidden colspan="12" style="text-align: center;">PENERIMAAN</th>
                            <th hidden colspan="11" style="text-align: center;">PEMOTONGAN</th>
                            <!-- HEADER + SALDO/TAKE HOME PAY -->
                            <th hidden rowspan="2" style="text-align: center;">Take Home Pay</th>
                            <!-- <th  style="text-align: center;">Bulan</th>                                                   
                            <th  style="text-align: center;">Tahun</th>
                            <th  style="text-align: center;">Email</th>
                            <th  style="text-align: center;">Send Email</th> -->
                        </tr>
                        <tr class="table-head">
                            <!-- Slip Gaji Column 1-->
                            <th style="text-align: center;">Nama Karyawan</th>
                            <!-- setelah dihidden -->
                            <th  style="text-align: center;">Bulan</th>                                                   
                            <th  style="text-align: center;">Tahun</th>
                            <th  style="text-align: center;">Email</th>
                            <th  style="text-align: center;">Send Email</th>
                            <!-- setelah dihidden -->

                            <th hidden style="text-align: center;">No.ID</th>
                            <th hidden style="text-align: center;">Status</th>
                            <th hidden style="text-align: center;">Nama Perusahaan</th>
                            <th hidden style="text-align: center;">Periode Payroll</th>
                            <!-- Slip Gaji Column 2 -->
                            <th hidden style="text-align: center;">Position</th>
                            <th hidden style="text-align: center;">Channel</th>
                            <th hidden style="text-align: center;">Tgl.Masuk</th>
                            <th hidden style="text-align: center;">Kode Negara</th>
                            <!-- Space Column -->

                            <!-- HEADER + PENERIMAAN -->
                            <th hidden style="text-align: center;">Penerimaan</th>
                            <!-- Penerimaan Column 1-->
                            <th hidden style="text-align: center;">Commision</th>
                            <th hidden style="text-align: center;">Override</th>
                            <th hidden style="text-align: center;">Monthly Performance Allowance</th>
                            <th hidden style="text-align: center;">Quarterly Production Allowance</th>
                            <th hidden style="text-align: center;">Monthly Recruit Bonus</th>
                            <th hidden style="text-align: center;">Operational Allowance</th>
                            <!-- Penerimaan Column 2 -->
                            <th hidden style="text-align: center;">Other Allowance</th>
                            <th hidden style="text-align: center;">Other Allowance 1</th>
                            <th hidden style="text-align: center;">Other Allowance 2</th>
                            <th hidden style="text-align: center;">Other Allowance 3</th>
                            <!-- Space Column -->                            
                            <th hidden style="text-align: center;">Tax Allowance</th>

                            <!-- HEADER + PEMOTONGAN -->
                            <th hidden style="text-align: center;">Pemotongan</th>
                            <!-- Pemotongan Column 1 -->
                            <th hidden style="text-align: center;">Uang Muka</th>
                            <th hidden style="text-align: center;">Pemotongan 1</th>
                            <th hidden style="text-align: center;">Pemotongan 2</th>
                            <th hidden style="text-align: center;">Pemotongan 3</th>
                            <th hidden style="text-align: center;">Pemotongan 4</th>
                            <th hidden style="text-align: center;">Pemotongan 5</th>
                            <th hidden style="text-align: center;">Pemotongan 6</th>
                            <th hidden style="text-align: center;">Pemotongan 7</th>
                            <th hidden style="text-align: center;">PPh 21</th>
                            <th hidden style="text-align: center;">Sanksi Pajak</th>
                        </tr>

                        <!-- input untuk menampung nilai variable payroll kontrak -->
                        <input hidden name="nama" type="text" id="nama">
                        <input hidden name="no_id" type="text" id="no_id">
                        <input hidden name="status" type="text" id="status">
                        <input hidden name="perusahaan" type="text" id="perusahaan">
                        <input hidden name="periode" type="text" id="periode">
                        <input hidden name="position" type="text" id="position">
                        <input hidden name="channel" type="text" id="channel">
                        <input hidden name="mulai_kerja" type="text" id="mulai_kerja">
                        <input hidden name="kode_negara" type="text" id="kode_negara">
                        <input hidden name="penerimaan" type="text" id="penerimaan">
                        <input hidden name="commision" type="text" id="commision">
                        <input hidden name="override" type="text" id="override">
                        <input hidden name="monthlyperformance" type="text" id="monthlyperformance">
                        <input hidden name="quarterlyproduction" type="text" id="quarterlyproduction">
                        <input hidden name="monthlyrecruit" type="text" id="monthlyrecruit">
                        <input hidden name="operationalallowance" type="text" id="operationalallowance">
                        <input hidden name="otherallowance" type="text" id="otherallowance">
                        <input hidden name="allowance1" type="text" id="allowance1">
                        <input hidden name="allowance2" type="text" id="allowance2">
                        <input hidden name="allowance3" type="text" id="allowance3">
                        <input hidden name="tax_allowance" type="text" id="tax_allowance">
                        <input hidden name="pemotongan" type="text" id="pemotongan">
                        <input hidden name="uangmuka" type="text" id="uangmuka">
                        <input hidden name="pemotongan1" type="text" id="pemotongan1">
                        <input hidden name="pemotongan2" type="text" id="pemotongan2">
                        <input hidden name="pemotongan3" type="text" id="pemotongan3">
                        <input hidden name="pemotongan4" type="text" id="pemotongan4">
                        <input hidden name="pemotongan5" type="text" id="pemotongan5">
                        <input hidden name="pemotongan6" type="text" id="pemotongan6">
                        <input hidden name="pemotongan7" type="text" id="pemotongan7">
                        <input hidden name="pph21" type="text" id="pph21">
                        <input hidden name="sanksipajak" type="text" id="sanksipajak">
                        <input hidden name="nilaidibayar" type="text" id="nilaidibayar">

                        <!-- tampilkan table content difilter maupun tidak difilter -->
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
            // masukkan nilai ke dalam input type untuk post ke server side php
            document.getElementById("nama").value = this.cells[0].innerHTML;
            document.getElementById("no_id").value = this.cells[1].innerHTML;
            document.getElementById("status").value = this.cells[2].innerHTML;
            document.getElementById("perusahaan").value = this.cells[3].innerHTML;
            document.getElementById("periode").value = this.cells[4].innerHTML;
            document.getElementById("position").value = this.cells[5].innerHTML;
            document.getElementById("channel").value = this.cells[6].innerHTML;
            document.getElementById("mulai_kerja").value = this.cells[7].innerHTML;
            document.getElementById("kode_negara").value = this.cells[8].innerHTML;
            document.getElementById("penerimaan").value = this.cells[9].innerHTML;
            document.getElementById("commision").value = this.cells[10].innerHTML;
            document.getElementById("override").value = this.cells[11].innerHTML;
            document.getElementById("monthlyperformance").value = this.cells[12].innerHTML;
            document.getElementById("quarterlyproduction").value = this.cells[13].innerHTML;
            document.getElementById("monthlyrecruit").value = this.cells[14].innerHTML;
            document.getElementById("operationalallowance").value = this.cells[15].innerHTML;
            document.getElementById("otherallowance").value = this.cells[16].innerHTML;
            document.getElementById("allowance1").value = this.cells[17].innerHTML;
            document.getElementById("allowance2").value = this.cells[18].innerHTML;
            document.getElementById("allowance3").value = this.cells[19].innerHTML;
            document.getElementById("tax_allowance").value = this.cells[20].innerHTML;
            document.getElementById("pemotongan").value = this.cells[21].innerHTML;
            document.getElementById("uangmuka").value = this.cells[22].innerHTML;
            document.getElementById("pemotongan1").value = this.cells[23].innerHTML;
            document.getElementById("pemotongan2").value = this.cells[24].innerHTML;
            document.getElementById("pemotongan3").value = this.cells[25].innerHTML;
            document.getElementById("pemotongan4").value = this.cells[26].innerHTML;
            document.getElementById("pemotongan5").value = this.cells[27].innerHTML;
            document.getElementById("pemotongan6").value = this.cells[28].innerHTML;
            document.getElementById("pemotongan7").value = this.cells[29].innerHTML;
            document.getElementById("pph21").value = this.cells[30].innerHTML;
            document.getElementById("sanksipajak").value = this.cells[31].innerHTML;
            document.getElementById("nilaidibayar").value = this.cells[32].innerHTML;
        }
    }

    $(".alert-success").fadeTo(1000, 500).slideUp(500, function()
    {
        $(".alert-success").slideUp(500);
    });
</script>
@endsection