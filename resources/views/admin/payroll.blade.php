@extends('admin.layout.auth')

@section('content')
<?php $page = 'admin/payroll'?>
<div class="container" style="margin-left: 0px; margin-right: 0px; padding: 15px; width: 100%;">
    <div class="row">
        <div class="col-md-12">
            <div>
                <button class="accordion">Upload Payroll<span class="caret"></span></button>
                <div class="panel-accordion">
                    <form class="form-horizontal" method="POST" action="{{ route('import_parsePayroll') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                            <div class="col-md-6">
                                <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                @if ($errors->has('csv_file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('csv_file') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="header" checked> File contains header row?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Parse CSV
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                '<td>'.$user['nik'].'</td>'. //0
                '<td>'.$user['nama'].'</td>'. //1
                '<td>'.$user['divisi'].'</td>'. //2
                '<td>'.$user['keterangan_divisi'].'</td>'. //3
                '<td>'.$user['kehadiran'].'</td>'. //4
                '<td>'.$user['gaji_pokok'].'</td>'. //5
                '<td>'.$user['insentif'].'</td>'. //6
                '<td>'.$user['uang_makan'].'</td>'. //7
                '<td>'.$user['transport'].'</td>'. //8
                '<td>'.$user['asuransi'].'</td>'. //9
                '<td>'.$user['lembur'].'</td>'. //10
                '<td>'.$user['pengobatan'].'</td>'. //11
                '<td>'.$user['lain'].'</td>'. //12
                '<td>'.$user['pajak_penerimaan'].'</td>'. //13
                '<td>'.$user['bpjs_non_tax'].'</td>'. //14
                '<td>'.$user['bpjs_tax'].'</td>'. //15
                '<td>'.$user['pot_gaji'].'</td>'. //16
                '<td>'.$user['natura_penerimaan'].'</td>'. //17
                '<td>'.$user['bantuan'].'</td>'. //18
                '<td>'.$user['thr'].'</td>'. //19
                '<td>'.$user['sub_total_penerimaan'].'</td>'. //20

                '<td>'.$user['iuran'].'</td>'.  //21
                '<td>'.$user['bpjs_karyawan_tax'].'</td>'. //22
                '<td>'.$user['uangmuka'].'</td>'. //23
                '<td>'.$user['pajak_pemotongan'].'</td>'. //24
                '<td>'.$user['sanksipajak'].'</td>'. //25
                '<td>'.$user['tax'].'</td>'. //26
                '<td>'.$user['nontax'].'</td>'. //27
                '<td>'.$user['bpjs_karyawan_non_tax'].'</td>'. //28
                '<td>'.$user['iuran2'].'</td>'. //29
                '<td>'.$user['natura_pemotongan'].'</td>'. //30
                '<td>'.$user['pinjaman_kendaraan'].'</td>'. //31
                '<td>'.$user['pinjaman_rumah'].'</td>'. //32
                '<td>'.$user['pinjaman_obat'].'</td>'. //33
                '<td>'.$user['pinjaman_lain2x'].'</td>'. //34
                '<td>'.$user['sub_total_pengeluaran'].'</td>'. //35

                '<td>'.$user['bulan'].'</td>'. //36
                '<td>'.$user['tahun'].'</td>'; //37
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
                    '<td>'.$user['nik'].'</td>'. //0
                    '<td>'.$user['nama'].'</td>'. //1
                    '<td>'.$user['divisi'].'</td>'. //2
                    '<td>'.$user['keterangan_divisi'].'</td>'. //3
                    '<td>'.$user['kehadiran'].'</td>'. //4
                    '<td>'.$user['gaji_pokok'].'</td>'. //5
                    '<td>'.$user['insentif'].'</td>'. //6
                    '<td>'.$user['uang_makan'].'</td>'. //7
                    '<td>'.$user['transport'].'</td>'. //8
                    '<td>'.$user['asuransi'].'</td>'. //9
                    '<td>'.$user['lembur'].'</td>'. //10
                    '<td>'.$user['pengobatan'].'</td>'. //11
                    '<td>'.$user['lain'].'</td>'. //12
                    '<td>'.$user['pajak_penerimaan'].'</td>'. //13
                    '<td>'.$user['bpjs_non_tax'].'</td>'. //14
                    '<td>'.$user['bpjs_tax'].'</td>'. //15
                    '<td>'.$user['pot_gaji'].'</td>'. //16
                    '<td>'.$user['natura_penerimaan'].'</td>'. //17
                    '<td>'.$user['bantuan'].'</td>'. //18
                    '<td>'.$user['thr'].'</td>'. //19
                    '<td>'.$user['sub_total_penerimaan'].'</td>'. //20

                    '<td>'.$user['iuran'].'</td>'.  //21
                    '<td>'.$user['bpjs_karyawan_tax'].'</td>'. //22
                    '<td>'.$user['uangmuka'].'</td>'. //23
                    '<td>'.$user['pajak_pemotongan'].'</td>'. //24
                    '<td>'.$user['sanksipajak'].'</td>'. //25
                    '<td>'.$user['tax'].'</td>'. //26
                    '<td>'.$user['nontax'].'</td>'. //27
                    '<td>'.$user['bpjs_karyawan_non_tax'].'</td>'. //28
                    '<td>'.$user['iuran2'].'</td>'. //29
                    '<td>'.$user['natura_pemotongan'].'</td>'. //30
                    '<td>'.$user['pinjaman_kendaraan'].'</td>'. //31
                    '<td>'.$user['pinjaman_rumah'].'</td>'. //32
                    '<td>'.$user['pinjaman_obat'].'</td>'. //33
                    '<td>'.$user['pinjaman_lain2x'].'</td>'. //34
                    '<td>'.$user['sub_total_pengeluaran'].'</td>'. //35

                    '<td>'.$user['bulan'].'</td>'. //36
                    '<td>'.$user['tahun'].'</td>'; //37
                }
            }

            ?>
            
            <!-- Pemilihan Bulan dan Tahun -->
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

            <div style="margin-top: 20px; overflow-x: auto; width: 100%;">
                <table class="table table-hover scrollable" style="font-size: 12px;">
                    <tr class="table-head">
                        <th rowspan="3" style="text-align: center;">NIK</th>
                        <th rowspan="3" style="text-align: center;">NAMA</th>
                        <th colspan="19" style="text-align: center;">PENERIMAAN</th>
                        <th colspan="15" style="text-align: center;">PENGELUARAN</th>
                        <th rowspan="3" style="text-align: center;">BULAN</th>
                        <th rowspan="3" style="text-align: center;">TAHUN</th>
                    </tr>
                    <tr class="table-head">
                        <!-- <th rowspan="2" style="text-align: center;">NO</th> -->
                        <th colspan="2" style="text-align: center;">DIVISI</th>
                        <th rowspan="2" style="text-align: center;">KEHADIRAN</th>
                        <th rowspan="2" style="text-align: center;">Gaji Pokok</th>
                        <th rowspan="2" style="text-align: center;">Insentif</th>
                        <th colspan="11" style="text-align: center;">TUNJANGAN-TUNJANGAN</th>
                        <th rowspan="2" style="text-align: center;">BANTUAN/RAPEL</th>
                        <th rowspan="2" style="text-align: center;">THR</th>
                        <th rowspan="2" style="text-align: center;">SUBTOTAL</th>
                        <th rowspan="2" style="text-align: center;">IURAN</th>
                        <th rowspan="2" style="text-align: center;">BPJS KARYAWAN (TAX)</th>
                        <th rowspan="2" style="text-align: center;">UANG MUKA</th>
                        <th rowspan="2" style="text-align: center;">PAJAK</th>
                        <th rowspan="2" style="text-align: center;">SANKSI PAJAK</th>
                        <th colspan="2" style="text-align: center;">BPJS PERUSAHAAN</th>
                        <th rowspan="2" style="text-align: center;">BPJS KARYAWAN (NON TAX)</th>
                        <th rowspan="2" style="text-align: center;">IURAN 2</th>
                        <th rowspan="2" style="text-align: center;">NATURA</th>
                        <th rowspan="2" style="text-align: center;">PINJAMAN KENDARAAN</th>
                        <th rowspan="2" style="text-align: center;">PINJAMAN RUMAH</th>
                        <th rowspan="2" style="text-align: center;">PINJAMAN OBAT</th>
                        <th rowspan="2" style="text-align: center;">PINJAMAN LAIN 2X</th>
                        <th rowspan="2" style="text-align: center;">SUB TOTAL II</th>
                        
                    </tr>
                    <tr class="table-head">
                        <th style="text-align: center;">CD.</th>                        
                        <th style="text-align: center;">KETERANGAN</th>
                        <th style="text-align: center;">UANG MAKAN</th>
                        <th style="text-align: center;">TRANSPORT</th>
                        <th style="text-align: center;">ASURANSI</th>
                        <th style="text-align: center;">LEMBUR</th>
                        <th style="text-align: center;">PENGOBATAN</th>
                        <th style="text-align: center;">LAINNYA</th>
                        <th style="text-align: center;">PAJAK</th>
                        <th style="text-align: center;">BPJS NON TAX</th>
                        <th style="text-align: center;">BPJS TAX</th>
                        <th style="text-align: center;">POT.GAJI</th>
                        <th style="text-align: center;">NATURA</th>
                        <th>TAX</th>
                        <th>NON TAX</th>
                    </tr>
                    <?php

                    echo $tableContent;

                    ?>
                    
                </table>
            </div>
            <!-- <div>
                <form action="send" method="post">
                    {{csrf_field()}}
                    to: <input type="text" name="to">
                    message: <textarea name="message" cols="30" rows="10"></textarea>
                    <input type="submit" value="Send">
                </form>
            </div> -->

            <!-- </div> -->
        </div>
    </div>
</div>
@endsection