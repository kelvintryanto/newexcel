@extends('admin.layout.auth')

@section('content')
<?php $page = 'admin/kontrakPayroll'?>
<div class="container" style="margin-left: 0px; margin-right: 0px; padding: 15px; width: 100%;">
    <div class="row">
        <div class="col-md-12">
            <div>
                <button class="accordion">Upload Payroll<span class="caret"></span></button>
                <div class="panel-accordion">
                    <form class="form-horizontal" method="POST" action="{{ route('import_parsePayrollKontrak') }}" enctype="multipart/form-data">
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
            $selectStmt = $con->prepare('SELECT * FROM payrollkontrak');
            $selectStmt->execute();
            $users = $selectStmt->fetchAll();

            foreach ($users as $user) {
                
                $tableContent = $tableContent.'<tr>'.
                '<td>'.$user['nbp'].'</td>'.
                '<td>'.$user['no_id'].'</td>'.
                '<td>'.$user['nama'].'</td>'.
                '<td>'.$user['cd_jenispenghasilan'].'</td>'.
                '<td>'.$user['keterangan_jenispenghasilan'].'</td>'.
                '<td>'.$user['code'].'</td>'.
                '<td>'.$user['channel'].'</td>'.
                '<td>'.$user['jabatan'].'</td>'.
                '<td>'.$user['jmlhari'].'</td>'.
                '<td>'.$user['commision'].'</td>'.
                '<td>'.$user['override'].'</td>'.
                '<td>'.$user['monthlyperformance'].'</td>'.
                '<td>'.$user['quarterlyproduction'].'</td>'.
                '<td>'.$user['monthlyrecruit'].'</td>'.
                '<td>'.$user['operationalallowance'].'</td>'.
                '<td>'.$user['allowance1'].'</td>'.
                '<td>'.$user['allowance2'].'</td>'.
                '<td>'.$user['allowance3'].'</td>'.
                '<td>'.$user['tax_allowance'].'</td>'.
                '<td>'.$user['subtotal_penerimaan'].'</td>'.
                '<td>'.$user['uangmuka'].'</td>'.
                '<td>'.$user['pemotongan1'].'</td>'.
                '<td>'.$user['pemotongan2'].'</td>'.
                '<td>'.$user['pemotongan3'].'</td>'.
                '<td>'.$user['pemotongan4'].'</td>'.
                '<td>'.$user['pemotongan5'].'</td>'.
                '<td>'.$user['pemotongan6'].'</td>'.
                '<td>'.$user['pemotongan7'].'</td>'.
                '<td>'.$user['pph2126'].'</td>'.
                '<td>'.$user['sanksipajak'].'</td>'.
                '<td>'.$user['subtotal_potongan'].'</td>'.
                '<td>'.$user['nilaidibayar'].'</td>'.
                '<td>'.$user['bulan'].'</td>'.
                '<td>'.$user['tahun'].'</td>';
            }

            if(isset($_POST['search']))
            {

                $start = $_POST['start'];
                $second = $_POST['second'];
                $tableContent = '';
                $selectStmt = $con->prepare('SELECT * FROM payrollkontrak WHERE bulan like :start AND tahun like :second');
                $selectStmt->execute(array(
                    ':start'=>$start,
                    ':second'=>$second
                ));
                $users = $selectStmt->fetchAll();

                foreach ($users as $user) {
                    
                    $tableContent = $tableContent.'<tr>'.
                    '<td>'.$user['nbp'].'</td>'.
                    '<td>'.$user['no_id'].'</td>'.
                    '<td>'.$user['nama'].'</td>'.
                    '<td>'.$user['cd_jenispenghasilan'].'</td>'.
                    '<td>'.$user['keterangan_jenispenghasilan'].'</td>'.
                    '<td>'.$user['code'].'</td>'.
                    '<td>'.$user['channel'].'</td>'.
                    '<td>'.$user['jabatan'].'</td>'.
                    '<td>'.$user['jmlhari'].'</td>'.
                    '<td>'.$user['commision'].'</td>'.
                    '<td>'.$user['override'].'</td>'.
                    '<td>'.$user['monthlyperformance'].'</td>'.
                    '<td>'.$user['quarterlyproduction'].'</td>'.
                    '<td>'.$user['monthlyrecruit'].'</td>'.
                    '<td>'.$user['operationalallowance'].'</td>'.
                    '<td>'.$user['allowance1'].'</td>'.
                    '<td>'.$user['allowance2'].'</td>'.
                    '<td>'.$user['allowance3'].'</td>'.
                    '<td>'.$user['tax_allowance'].'</td>'.
                    '<td>'.$user['subtotal_penerimaan'].'</td>'.
                    '<td>'.$user['uangmuka'].'</td>'.
                    '<td>'.$user['pemotongan1'].'</td>'.
                    '<td>'.$user['pemotongan2'].'</td>'.
                    '<td>'.$user['pemotongan3'].'</td>'.
                    '<td>'.$user['pemotongan4'].'</td>'.
                    '<td>'.$user['pemotongan5'].'</td>'.
                    '<td>'.$user['pemotongan6'].'</td>'.
                    '<td>'.$user['pemotongan7'].'</td>'.
                    '<td>'.$user['pph2126'].'</td>'.
                    '<td>'.$user['sanksipajak'].'</td>'.
                    '<td>'.$user['subtotal_potongan'].'</td>'.
                    '<td>'.$user['nilaidibayar'].'</td>'.
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
                    <select style="margin-right: 10px;" name="start" style="margin-right: 10px;">
                        <option value="All">All</option>
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
                <table class="table table-hover scrollable" style="font-size: 12px; height">
                    <tr class="table-head">
                        <th rowspan="2" style="text-align: center;">NO.BUKTI POTONG</th>
                        <th rowspan="2" style="text-align: center;">NO.ID</th>
                        <th rowspan="2" style="text-align: center;">NAMA KARYAWAN</th>
                        <th colspan="2" style="text-align: center;">JENIS PENGHASILAN</th>
                        <th colspan="3" style="text-align: center;">CHANNEL & JABATAN</th>
                        <th colspan="12" style="text-align: center">PENERIMAAN</th>
                        <th colspan="11" style="text-align: center">POTONGAN</th>
                        <th rowspan="2">NILAI DIBAYAR</th>
                        <th rowspan="2">BULAN</th>
                        <th rowspan="2">TAHUN</th>
                    </tr>
                    <tr class="table-head">
                        <th style="text-align: center;">CD.</th>
                        <th style="text-align: center;">KETERANGAN</th>
                        <th style="text-align: center;">CODE</th>
                        <th style="text-align: center;">CHANNEL</th>
                        <th style="text-align: center;">JABATAN</th>
                        <th style="text-align: center;">JUMLAH HARI KERJA</th>
                        <th style="text-align: center;">COMMISION</th>
                        <th style="text-align: center;">OVERRIDE</th>
                        <th style="text-align: center;">MONTHLY PERFORMANCE</th>
                        <th style="text-align: center;">QUARTERLY PRODUCTION</th>
                        <th style="text-align: center;">MONTHLY RECRUIT</th>
                        <th style="text-align: center;">OPERATIONAL ALLOWANCE</th>
                        <th style="text-align: center;">OTHER ALLOWANCE 1</th>
                        <th style="text-align: center;">OTHER ALLOWANCE 2</th>
                        <th style="text-align: center;">OTHER ALLOWANCE 3</th>
                        <th style="text-align: center;">TAX ALLOWANCE</th>
                        <th style="text-align: center;">SUB TOTAL</th>
                        <th style="text-align: center;">UANG MUKA</th>
                        <th style="text-align: center;">PEMOTONGAN 1</th>
                        <th style="text-align: center;">PEMOTONGAN 2</th>
                        <th style="text-align: center;">PEMOTONGAN 3</th>
                        <th style="text-align: center;">PEMOTONGAN 4</th>
                        <th style="text-align: center;">PEMOTONGAN 5</th>
                        <th style="text-align: center;">PEMOTONGAN 6</th>
                        <th style="text-align: center;">PEMOTONGAN 7</th>
                        <th style="text-align: center;">PPH 21/26</th>
                        <th style="text-align: center;">SANKSI PAJAK</th>
                        <th style="text-align: center;">SUB.TOTAL</th>
                        
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