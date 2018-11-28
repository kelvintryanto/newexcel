@extends('admin.layout.auth')

@section('content')
<?php $page = 'admin/home'?>
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
                    <tr class="table-head">
                        <th rowspan="2" style="text-align: center;">NIK</th>
                        <th rowspan="2" style="text-align: center;">NAMA KARYAWAN</th>
                        <th colspan="2" style="text-align: center;">NPWP</th>
                        <th rowspan="2" style="text-align: center;">ALAMAT 1</th>
                        <th rowspan="2" style="text-align: center;">ALAMAT 2</th>
                        <th rowspan="2" style="text-align: center;">NO.KTP/Paspor</th>
                        <th rowspan="2" style="text-align: center;">KODE NEGARA</th>
                        <th rowspan="2" style="text-align: center;">STATUS PINDAH</th>
                        <th rowspan="2" style="text-align: center;">NO.REKENING</th>
                        <th rowspan="2" style="text-align: center;">BAGIAN</th>
                        <th rowspan="2" style="text-align: center;">JABATAN</th>
                        <th rowspan="2" style="text-align: center;">STATUS K;TK;HB</th>
                        <th rowspan="2" style="text-align: center;">TANGGUNGAN (MAX:3)</th>
                        <th rowspan="2" style="text-align: center;">L/P</th>
                        <th rowspan="2" style="text-align: center;">KA</th>
                        <th rowspan="2" style="text-align: center;">KODE OBJEK PAJAK</th>
                        <th rowspan="2" style="text-align: center;">MULAI KERJA</th>
                        <th rowspan="2" style="text-align: center;">AKHIR KERJA</th>
                        <th colspan="6" style="text-align: center;">TUNJANGAN</th>
                        <th style="text-align: center;">GAJI</th>
                        <th colspan="4" style="text-align: center;">DISETAHUNKAN-IN</th>
                        <th colspan="2" style="text-align: center;">DISETAHUNKAN-OUT</th>
                        <th rowspan="2" style="text-align: center;">TANGGAL LAHIR</th>
                    </tr>
                    <tr class="table-head">
                        <th style="text-align: center;">NOMOR</th>
                        <th style="text-align: center;">SEJAK</th>
                        <th style="text-align: center;">KEND.</th>
                        <th style="text-align: center;">RUMAH</th>
                        <th style="text-align: center;">OBAT</th>
                        <th style="text-align: center;">UANG</th>
                        <th style="text-align: center;">LAIN 2X</th>
                        <th style="text-align: center;">PL.OBAT</th>
                        <th style="text-align: center;">G/N/S</th>
                        <th style="text-align: center;">TANGGAL</th>
                        <th style="text-align: center;">JML.BLN</th>
                        <th style="text-align: center;">PENGH.</th>
                        <th style="text-align: center;">PPH.</th>
                        <th style="text-align: center;">TANGGAL</th>
                        <th style="text-align: center;">BULAN</th>
                        
                    </tr>
                    <?php
                    $conn=mysqli_connect("localhost","root","","newexcel");
                    if($conn->connect_error){
                        die("Connection failed:". $conn-> connect_error);
                    }
                    $sql = "SELECT no_id,nama,no_npwp,npwp_sejak,alamat_1,alamat_2,no_ktp,kode_negara,status_pindah,no_rekening,bagian,jabatan,status_k_tk_hb,tanggungan,jenis_kelamin,ka,kode_objek_pajak,mulai_kerja,akhir_kerja,kend,rumah,obat,uang,lain,pl_obat,gaji,tanggal_in,jml_bulan_in,pengh_in,pph_in,tanggal_out,bulan_out,tanggal_lahir FROM karyawan";
                    $result = $conn-> query($sql);
                    

                    if ($result-> num_rows > 0) {
                        while ($row = $result-> fetch_assoc()) {
                            $gaji="Rp ".number_format($row["gaji"],2,',','.');
                            $kend="Rp ".number_format($row["kend"],2,',','.');
                            $rumah="Rp ".number_format($row["rumah"],2,',','.');
                            $obat="Rp ".number_format($row["obat"],2,',','.');
                            $uang="Rp ".number_format($row["uang"],2,',','.');
                            $lain2x="Rp ".number_format($row["lain"],2,',','.');
                            $pl_obat="Rp ".number_format($row["pl_obat"],2,',','.');

                            echo 
                            "<tr>
                                <td>".$row["no_id"]."</td>
                                <td>".$row["nama"]."</td>
                                <td>".$row["no_npwp"]."</td>
                                <td>".$row["npwp_sejak"]."</td>
                                <td>".$row["alamat_1"]."</td>
                                <td>".$row["alamat_2"]."</td>
                                <td>".$row["no_ktp"]."</td>
                                <td>".$row["kode_negara"]."</td>
                                <td>".$row["status_pindah"]."</td>
                                <td>".$row["no_rekening"]."</td>
                                <td>".$row["bagian"]."</td>
                                <td>".$row["jabatan"]."</td>
                                <td>".$row["status_k_tk_hb"]."</td>
                                <td>".$row["tanggungan"]."</td>
                                <td>".$row["jenis_kelamin"]."</td>
                                <td>".$row["ka"]."</td>
                                <td>".$row["kode_objek_pajak"]."</td>
                                <td>".$row["mulai_kerja"]."</td>
                                <td>".$row["akhir_kerja"]."</td>
                                <td>".$kend."</td>
                                <td>".$rumah."</td>
                                <td>".$obat."</td>
                                <td>".$uang."</td>
                                <td>".$lain2x."</td>
                                <td>".$pl_obat."</td>
                                <td>".$gaji."</td>
                                <td>".$row["tanggal_in"]."</td>
                                <td>".$row["jml_bulan_in"]."</td>
                                <td>".$row["pengh_in"]."</td>
                                <td>".$row["pph_in"]."</td>
                                <td>".$row["tanggal_out"]."</td>
                                <td>".$row["bulan_out"]."</td>
                                <td>".$row["tanggal_lahir"]."</td>
                            </tr>";

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
