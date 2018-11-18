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
                                    '<td>'.$user['no'].'</td>'.
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
                                        '<td>'.$user['no'].'</td>'.
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
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Keterangan Divisi</th>
                        <th>Kehadiran</th>
                        <th>Gaji Pokok</th>
                        <th>Insentif</th>
                        <th>Uang Makan</th>
                        <th>Transport</th>
                        <th>Asuransi</th>
                        <th>Lembur</th>
                        <th>Pengobatan</th>
                        <th>Lainnya</th>
                        <th>Pajak</th>
                        <th>BPJS NON TAX</th>
                        <th>BPJS TAX</th>
                        <th>POT.GAJI</th>
                        <th>NATURA</th>
                        <th>Bantuan</th>
                        <th>THR</th>
                        <th>Sub Total</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
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