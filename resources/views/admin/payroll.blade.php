@extends('admin.layout.auth')

@section('content')
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
            
            <!-- Pemilihan Bulan dan Tahun -->
            <div style="float: right; padding: 10px;">
                <b>Bulan</b>
                <select style="margin-right: 10px;">
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
                    $conn=mysqli_connect("localhost","root","","newexcel");
                    if($conn->connect_error){
                        die("Connection failed:". $conn-> connect_error);
                    }
                    $sql = "SELECT no,nik,nama,divisi,keterangan_divisi,kehadiran,gaji_pokok,insentif,uang_makan,transport,asuransi,lembur,pengobatan,lain,pajak,bpjs_non_tax,bpjs_tax,pot_gaji,natura,bantuan,thr,sub_total,bulan,tahun from payroll";
                    $result = $conn-> query($sql);

                    if ($result-> num_rows > 0) {
                        while ($row = $result-> fetch_assoc()) {
                            echo "<tr><td>".$row["no"]."</td><td>".$row["nik"]."</td><td>".$row["nama"]."</td><td>".$row["divisi"]."</td><td>".$row["keterangan_divisi"]."</td><td>".$row["kehadiran"]."</td><td>".$row["gaji_pokok"]."</td><td>".$row["insentif"]."</td><td>".$row["uang_makan"]."</td><td>".$row["transport"]."</td><td>".$row["asuransi"]."</td><td>".$row["lembur"]."</td><td>".$row["pengobatan"]."</td><td>".$row["lain"]."</td><td>".$row["pajak"]."</td><td>".$row["bpjs_non_tax"]."</td><td>".$row["bpjs_tax"]."</td><td>".$row["pot_gaji"]."</td><td>".$row["natura"]."</td><td>".$row["bantuan"]."</td><td>".$row["thr"]."</td><td>".$row["sub_total"]."</td><td>".$row["bulan"]."</td><td>".$row["tahun"]."</td></tr>";

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