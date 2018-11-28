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
                
                // number format table
                $gaji_pokok="Rp ".number_format($user["gaji_pokok"],2,',','.');
                $insentif="Rp ".number_format($user["insentif"],2,',','.');
                $uang_makan="Rp ".number_format($user["uang_makan"],2,',','.');
                $transport="Rp ".number_format($user["transport"],2,',','.');
                $asuransi="Rp ".number_format($user["asuransi"],2,',','.');
                $lembur="Rp ".number_format($user["lembur"],2,',','.');
                $pengobatan="Rp ".number_format($user["pengobatan"],2,',','.');
                $lain="Rp ".number_format($user["lain"],2,',','.');
                $pajak_penerimaan="Rp ".number_format($user["pajak_penerimaan"],2,',','.');
                $bpjs_non_tax="Rp ".number_format($user["bpjs_non_tax"],2,',','.');
                $bpjs_tax="Rp ".number_format($user["bpjs_tax"],2,',','.');
                $pot_gaji="Rp ".number_format($user["pot_gaji"],2,',','.');
                $natura_penerimaan="Rp ".number_format($user["natura_penerimaan"],2,',','.');
                $bantuan="Rp ".number_format($user["bantuan"],2,',','.');
                $thr="Rp ".number_format($user["thr"],2,',','.');
                $sub_total_penerimaan="Rp ".number_format($user["sub_total_penerimaan"],2,',','.');

                $iuran="Rp ".number_format($user["iuran"],2,',','.');
                $bpjs_karyawan_tax="Rp ".number_format($user["bpjs_karyawan_tax"],2,',','.');
                $uangmuka="Rp ".number_format($user["uangmuka"],2,',','.');
                $pajak_pemotongan="Rp ".number_format($user["pajak_pemotongan"],2,',','.');
                $sanksipajak="Rp ".number_format($user["sanksipajak"],2,',','.');
                $tax="Rp ".number_format($user["tax"],2,',','.');
                $nontax="Rp ".number_format($user["nontax"],2,',','.');
                $bpjs_karyawan_non_tax="Rp ".number_format($user["bpjs_karyawan_non_tax"],2,',','.');
                $iuran2="Rp ".number_format($user["iuran2"],2,',','.');
                $natura_pemotongan="Rp ".number_format($user["natura_pemotongan"],2,',','.');
                $pinjaman_kendaraan="Rp ".number_format($user["pinjaman_kendaraan"],2,',','.');
                $pinjaman_rumah="Rp ".number_format($user["pinjaman_rumah"],2,',','.');
                $pinjaman_obat="Rp ".number_format($user["pinjaman_obat"],2,',','.');
                $pinjaman_lain2x="Rp ".number_format($user["pinjaman_lain2x"],2,',','.');                
                $sub_total_pengeluaran="Rp ".number_format($user["sub_total_pengeluaran"],2,',','.');
                $take_home_pay="Rp ".number_format($user["take_home_pay"],2,',','.');

                $tableContent = $tableContent.'<tr>'.
                // '<td>'.$user['no'].'</td>'.
                '<td>'.$user['nik'].'</td>'. //0
                '<td>'.$user['nama'].'</td>'. //1
                '<td>'.$user['divisi'].'</td>'. //2
                '<td>'.$user['keterangan_divisi'].'</td>'. //3
                '<td>'.$user['kehadiran'].'</td>'. //4
                '<td style="text-align:right">'.$gaji_pokok.'</td>'. //5
                '<td style="text-align:right">'.$insentif.'</td>'. //6
                '<td style="text-align:right">'.$uang_makan.'</td>'. //7
                '<td style="text-align:right">'.$transport.'</td>'. //8
                '<td style="text-align:right">'.$asuransi.'</td>'. //9
                '<td style="text-align:right">'.$lembur.'</td>'. //10
                '<td style="text-align:right">'.$pengobatan.'</td>'. //11
                '<td style="text-align:right">'.$lain.'</td>'. //12
                '<td style="text-align:right">'.$pajak_penerimaan.'</td>'. //13
                '<td style="text-align:right">'.$bpjs_non_tax.'</td>'. //14
                '<td style="text-align:right">'.$bpjs_tax.'</td>'. //15
                '<td style="text-align:right">'.$pot_gaji.'</td>'. //16
                '<td style="text-align:right">'.$natura_penerimaan.'</td>'. //17
                '<td style="text-align:right">'.$bantuan.'</td>'. //18
                '<td style="text-align:right">'.$thr.'</td>'. //19
                '<td style="text-align:right">'.$sub_total_penerimaan.'</td>'. //20

                '<td style="text-align:right">'.$iuran.'</td>'.  //21
                '<td style="text-align:right">'.$bpjs_karyawan_tax.'</td>'. //22
                '<td style="text-align:right">'.$uangmuka.'</td>'. //23
                '<td style="text-align:right">'.$pajak_pemotongan.'</td>'. //24
                '<td style="text-align:right">'.$sanksipajak.'</td>'. //25
                '<td style="text-align:right">'.$tax.'</td>'. //26
                '<td style="text-align:right">'.$nontax.'</td>'. //27
                '<td style="text-align:right">'.$bpjs_karyawan_non_tax.'</td>'. //28
                '<td style="text-align:right">'.$iuran2.'</td>'. //29
                '<td style="text-align:right">'.$natura_pemotongan.'</td>'. //30
                '<td style="text-align:right">'.$pinjaman_kendaraan.'</td>'. //31
                '<td style="text-align:right">'.$pinjaman_rumah.'</td>'. //32
                '<td style="text-align:right">'.$pinjaman_obat.'</td>'. //33
                '<td style="text-align:right">'.$pinjaman_lain2x.'</td>'. //34
                '<td style="text-align:right">'.$sub_total_pengeluaran.'</td>'. //35
                '<td style="text-align:right">'.$take_home_pay.'</td>'. //36

                '<td style="text-align:center">'.$user['bulan'].'</td>'. //37
                '<td style="text-align:center">'.$user['tahun'].'</td>'; //38
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

                    // number format table
                $gaji_pokok="Rp ".number_format($user["gaji_pokok"],2,',','.');
                $insentif="Rp ".number_format($user["insentif"],2,',','.');
                $uang_makan="Rp ".number_format($user["uang_makan"],2,',','.');
                $transport="Rp ".number_format($user["transport"],2,',','.');
                $asuransi="Rp ".number_format($user["asuransi"],2,',','.');
                $lembur="Rp ".number_format($user["lembur"],2,',','.');
                $pengobatan="Rp ".number_format($user["pengobatan"],2,',','.');
                $lain="Rp ".number_format($user["lain"],2,',','.');
                $pajak_penerimaan="Rp ".number_format($user["pajak_penerimaan"],2,',','.');
                $bpjs_non_tax="Rp ".number_format($user["bpjs_non_tax"],2,',','.');
                $bpjs_tax="Rp ".number_format($user["bpjs_tax"],2,',','.');
                $pot_gaji="Rp ".number_format($user["pot_gaji"],2,',','.');
                $natura_penerimaan="Rp ".number_format($user["natura_penerimaan"],2,',','.');
                $bantuan="Rp ".number_format($user["bantuan"],2,',','.');
                $thr="Rp ".number_format($user["thr"],2,',','.');
                $sub_total_penerimaan="Rp ".number_format($user["sub_total_penerimaan"],2,',','.');

                $iuran="Rp ".number_format($user["iuran"],2,',','.');
                $bpjs_karyawan_tax="Rp ".number_format($user["bpjs_karyawan_tax"],2,',','.');
                $uangmuka="Rp ".number_format($user["uangmuka"],2,',','.');
                $pajak_pemotongan="Rp ".number_format($user["pajak_pemotongan"],2,',','.');
                $sanksipajak="Rp ".number_format($user["sanksipajak"],2,',','.');
                $tax="Rp ".number_format($user["tax"],2,',','.');
                $nontax="Rp ".number_format($user["nontax"],2,',','.');
                $bpjs_karyawan_non_tax="Rp ".number_format($user["bpjs_karyawan_non_tax"],2,',','.');
                $iuran2="Rp ".number_format($user["iuran2"],2,',','.');
                $natura_pemotongan="Rp ".number_format($user["natura_pemotongan"],2,',','.');
                $pinjaman_kendaraan="Rp ".number_format($user["pinjaman_kendaraan"],2,',','.');
                $pinjaman_rumah="Rp ".number_format($user["pinjaman_rumah"],2,',','.');
                $pinjaman_obat="Rp ".number_format($user["pinjaman_obat"],2,',','.');
                $pinjaman_lain2x="Rp ".number_format($user["pinjaman_lain2x"],2,',','.');                
                $sub_total_pengeluaran="Rp ".number_format($user["sub_total_pengeluaran"],2,',','.');

                $tableContent = $tableContent.'<tr>'.
                // '<td>'.$user['no'].'</td>'.
                '<td>'.$user['nik'].'</td>'. //0
                '<td>'.$user['nama'].'</td>'. //1
                '<td>'.$user['divisi'].'</td>'. //2
                '<td>'.$user['keterangan_divisi'].'</td>'. //3
                '<td>'.$user['kehadiran'].'</td>'. //4
                '<td style="text-align:right">'.$gaji_pokok.'</td>'. //5
                '<td style="text-align:right">'.$insentif.'</td>'. //6
                '<td style="text-align:right">'.$uang_makan.'</td>'. //7
                '<td style="text-align:right">'.$transport.'</td>'. //8
                '<td style="text-align:right">'.$asuransi.'</td>'. //9
                '<td style="text-align:right">'.$lembur.'</td>'. //10
                '<td style="text-align:right">'.$pengobatan.'</td>'. //11
                '<td style="text-align:right">'.$lain.'</td>'. //12
                '<td style="text-align:right">'.$pajak_penerimaan.'</td>'. //13
                '<td style="text-align:right">'.$bpjs_non_tax.'</td>'. //14
                '<td style="text-align:right">'.$bpjs_tax.'</td>'. //15
                '<td style="text-align:right">'.$pot_gaji.'</td>'. //16
                '<td style="text-align:right">'.$natura_penerimaan.'</td>'. //17
                '<td style="text-align:right">'.$bantuan.'</td>'. //18
                '<td style="text-align:right">'.$thr.'</td>'. //19
                '<td style="text-align:right">'.$sub_total_penerimaan.'</td>'. //20

                '<td style="text-align:right">'.$iuran.'</td>'.  //21
                '<td style="text-align:right">'.$bpjs_karyawan_tax.'</td>'. //22
                '<td style="text-align:right">'.$uangmuka.'</td>'. //23
                '<td style="text-align:right">'.$pajak_pemotongan.'</td>'. //24
                '<td style="text-align:right">'.$sanksipajak.'</td>'. //25
                '<td style="text-align:right">'.$tax.'</td>'. //26
                '<td style="text-align:right">'.$nontax.'</td>'. //27
                '<td style="text-align:right">'.$bpjs_karyawan_non_tax.'</td>'. //28
                '<td style="text-align:right">'.$iuran2.'</td>'. //29
                '<td style="text-align:right">'.$natura_pemotongan.'</td>'. //30
                '<td style="text-align:right">'.$pinjaman_kendaraan.'</td>'. //31
                '<td style="text-align:right">'.$pinjaman_rumah.'</td>'. //32
                '<td style="text-align:right">'.$pinjaman_obat.'</td>'. //33
                '<td style="text-align:right">'.$pinjaman_lain2x.'</td>'. //34
                '<td style="text-align:right">'.$sub_total_pengeluaran.'</td>'. //35
                '<td style="text-align:right">'.$take_home_pay.'</td>'. //36

                '<td style="text-align:center">'.$user['bulan'].'</td>'. //37
                '<td style="text-align:center">'.$user['tahun'].'</td>'; //38
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
                        <th rowspan="3" style="text-align: center;">TAKE HOME PAY</th>
                        <th rowspan="3" style="text-align: center;">BULAN</th>
                        <th rowspan="3" style="text-align: center;">TAHUN</th>
                    </tr>

                    <tr class="table-head">
                        <!-- <th rowspan="2" style="text-align: center;">NO</th> -->
                        <th colspan="2" style="text-align: center;">DIVISI</th>
                        <th rowspan="2" style="text-align: center;">KEHADIRAN</th>
                        <th rowspan="2" style="text-align: center;">GAJI POKOK</th>
                        <th rowspan="2" style="text-align: center;">INSENTIF</th>
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
                        <th style="text-align: center;">TAX</th>
                        <th style="text-align: center;">NON TAX</th>
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