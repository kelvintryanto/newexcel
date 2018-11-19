@extends('admin.layout.auth')

@section('content')
<?php $page = 'admin/kontrakHome'?>
<div class="container" style="margin-left: 0px; margin-right: 0px; padding: 15px; width: 100%;">
    <div class="row">
        <div class="col-md-12">
            <div>
                <button class="accordion">Upload Karyawan <span class="caret"></span></button>
                <div class="panel-accordion">
                    <form class="form-horizontal" method="POST" action="{{ route('import_parse') }}" enctype="multipart/form-data">
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

            <div style="margin-top: 20px; overflow-x: auto; width: 100%;">
                <table class="table table-hover scrollable" style="font-size: 12px;">
                    <tr rowspan="2">
                        <th hidden rowspan="2" style="text-align: center;">NO</th>
                        <th rowspan="2" style="text-align: center;">NO.ID</th>
                        <th rowspan="2" style="text-align: center;">NAMA KARYAWAN</th>
                        <th colspan="2" style="text-align: center;">NPWP</th>
                        <th colspan="2" style="text-align: center;">JENIS PENGHASILAN</th>
                        <th>Kerja 1 Tempat</th>
                        <th rowspan="2" style="text-align: center;">ALAMAT 1</th>
                        <th rowspan="2" style="text-align: center;">ALAMAT 2</th>
                        <th rowspan="2" style="text-align: center;">No.KTP/PASPOR</th>
                        <th style="text-align: center;">KODE NEGARA</th>
                        <th rowspan="2" style="text-align: center;">STATUS</th>
                        <th rowspan="2" style="text-align: center;">TANGGUNGAN</th>
                        <th rowspan="2" style="text-align: center;">KODE STATUS</th>
                        <th rowspan="2" style="text-align: center;">L/P</th>
                        <th rowspan="2" style="text-align: center;">MULAI KERJA</th>
                        <th rowspan="2" style="text-align: center;">AKHIR KERJA</th>
                        <th rowspan="2" style="text-align: center;">PTKP/BULAN</th>
                    </tr>
                    <tr class="table-head">
                        <th>NO.</th>
                        <th>SEJAK</th>
                        <th>CD.</th>
                        <th>NAMA</th>
                        <th>Y/T</th>
                        <th>(DIISI BILA WP LN)</th>
                    </tr>
                    <?php
                    $conn=mysqli_connect("localhost","root","","newexcel");
                    if($conn->connect_error){
                        die("Connection failed:". $conn-> connect_error);
                    }
                    $sql = "SELECT no,no_id,nama,no_npwp,npwp_sejak,cd_jenishasil,nama_jenishasil,kerja_di_1_tempat,alamat_1,alamat_2,no_ktp,kode_negara,status,tanggungan,kode_status,jenis_kelamin,mulai_kerja,akhir_kerja,ptkp from karyawan";
                    $result = $conn-> query($sql);

                    if ($result-> num_rows > 0) {
                        while ($row = $result-> fetch_assoc()) {
                            echo "<tr><td hidden>".$row["no"]."</td><td>".$row["no_id"]."</td><td>".$row["nama"]."</td><td>".$row["no_npwp"]."</td><td>".$row["npwp_sejak"]."</td><td>".$row["cd_jenishasil"]."</td><td>".$row["nama_jenishasil"]."</td><td>".$row["kerja_di_1_tempat"]."</td><td>".$row["alamat_1"]."</td><td>".$row["alamat_2"]."</td><td>".$row["no_ktp"]."</td><td>".$row["kode_negara"]."</td><td>".$row["status"]."</td><td>".$row["tanggungan"]."</td><td>".$row["kode_status"]."</td><td>".$row["jenis_kelamin"]."</td><td>".$row["mulai_kerja"]."</td><td>".$row["akhir_kerja"]."</td><td>".$row["ptkp"]."</td></tr>";

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

            <!-- <div style="padding: 5px; font-size: 12px;">
                <table>

                </table>
                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.NPWP : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">NPWP_Sejak : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>

                <p class="tab-left">No.ID : <input type="text" name="no_id" style="width: 400px;"></p>
                <p class="tab-right">Nama : <input type="text" name="nama" style="width: 400px;"></p><br>
            </div> -->

            <!-- </div> -->
        </div>
    </div>
</div>
</div>
@endsection