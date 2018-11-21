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
            
            <!-- Pemilihan Bulan dan Tahun -->
            <div style="float: right; padding: 10px;">
                <form action="{{route('payroll')}}" method="POST">
                {{ csrf_field() }}
                <b>Bulan</b>
                <select style="margin-right: 10px;">
                    <option value="All">All</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>

                <b>Tahun</b>
                <select>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
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
                    </tr>
                    <tr class="table-head">
                        <th style="text-align: center;">CD.JENIS PENGHASILAN</th>
                        <th style="text-align: center;">KETERANGAN JENIS PENGHASILAN</th>
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
                    $conn=mysqli_connect("localhost","root","","newexcel");
                    if($conn->connect_error){
                        die("Connection failed:". $conn-> connect_error);
                    }
                    $sql = "SELECT nbp,no_id,nama,cd_jenispenghasilan,keterangan_jenispenghasilan,code,channel,jabatan,jmlhari,commision,override,monthlyperformance,quarterlyproduction,monthlyrecruit,operationalallowance,allowance1,allowance2,allowance3,tax_allowance,subtotal_penerimaan,uangmuka,pemotongan1,pemotongan2,pemotongan3,pemotongan4,pemotongan5,pemotongan6,pemotongan7,pph2126,sanksipajak,subtotal_potongan,nilaidibayar,bulan,tahun from payrollkontrak";
                    $result = $conn-> query($sql);

                    if ($result-> num_rows > 0) {
                        while ($row = $result-> fetch_assoc()) {
                            echo "<tr><td>".$row["nbp"]."</td><td>".$row["no_id"]."</td><td>".$row["nama"]."</td><td>".$row["cd_jenispenghasilan"]."</td><td>".$row["keterangan_jenispenghasilan"]."</td><td>".$row["code"]."</td><td>".$row["channel"]."</td><td>".$row["jabatan"]."</td><td>".$row["jmlhari"]."</td><td>".$row["commision"]."</td><td>".$row["override"]."</td><td>".$row["monthlyperformance"]."</td><td>".$row["quarterlyproduction"]."</td><td>".$row["monthlyrecruit"]."</td><td>".$row["operationalallowance"]."</td><td>".$row["allowance1"]."</td><td>".$row["allowance2"]."</td><td>".$row["allowance3"]."</td><td>".$row["tax_allowance"]."</td><td>".$row["subtotal_penerimaan"]."</td><td>".$row["uangmuka"]."</td><td>".$row["pemotongan1"]."</td><td>".$row["pemotongan2"]."</td><td>".$row["pemotongan3"]."</td><td>".$row["pemotongan4"]."</td><td>".$row["pemotongan5"]."</td><td>".$row["pemotongan6"]."</td><td>".$row["pemotongan7"]."</td><td>".$row["pph2126"]."</td><td>".$row["sanksipajak"]."</td><td>".$row["subtotal_potongan"]."</td><td>".$row["nilaidibayar"]."</td><td>".$row["bulan"]."</td><td>".$row["tahun"]."</td></tr>";

                        }
                        echo "</table>";
                    }
                    else{
                        echo "0 result";
                    }
                    $conn-> close();
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