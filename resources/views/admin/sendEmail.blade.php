@extends('admin.layout.auth')

@section('content')
<?php $page = 'admin/sendEmail'?>
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

        <!-- Pemilihan Bulan dan Tahun Sending Email Karyawan Tetap -->
        <div style="float: right; padding: 10px;">
            <form action="{{route('payroll')}}" method="POST">
                {{ csrf_field() }}
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
                <input type="submit" name="search" value="Filter">
            </form>
        </div>

        <!-- Table Sending Email Karyawan Tetap-->
        <div>
            <form action="{{ route('sendEmail') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table id="table" class="table table-hover" style="font-size: 12px;">
                    <!-- kalo ada tambahan edit di sini -->
                    <tr class="table-head">
                        <th style="text-align: center;">Nama</th>
                        <th hidden>Gaji</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Send Email</th>
                    </tr>

                   	<!-- Tampilkan Tabel -->
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
	                	// SELECT INI BERGUNA UNTUK SELECT ALL TANPA FILTER
	                    $selectStmt = $con->prepare('SELECT * FROM payroll as p,karyawan as k,users as u where p.nik = k.no_id and u.name = k.nama');
	                    $selectStmt->execute();
	                    $users = $selectStmt->fetchAll();
	        
	                    foreach ($users as $user) 
	                    {
	                        //mengubah angka bulan menjadi nama bulan
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
	        
	                        // .= fungsinya untuk append bulan dengan tahun
	                        $periode .= $user['tahun'];
	        
	                        $tableContent = $tableContent.'<tr>'.
	                        // '<td>'.$user['no'].'</td>'.
							//slip gaji column 1
							'<td>PT. MANDIRI KONSULTAMA PERKASA</td>'. //0
							'<td hidden>'.$periode.'</td>'. //1
							'<td>'.$user['nik'].'</td>'. //2
							'<td>'.$user['nama'].'</td>'. //3
							'<td hidden>'.$user['mulai_kerja'].'</td>'. //4
							//slip gaji column 2							
							'<td>MT. HARYONO</td>'. //5
							'<td>'.$user['bagian'].'</td>'. //6
							'<td>'.$user['jabatan'].'</td>'. //7
							'<td>'.$user['status_k_tk_hb'].'</td>'. //8
							//slip gaji column 3
							//tanggal stamp

							//penerimaan
							'<td>'.$user['gaji_pokok'].'</td>'. //9
							'<td>'.$user['insentif'].'</td>'. //10
							'<td>'.$user['uang_makan'].'</td>'. //11
							'<td>'.$user['transport'].'</td>'. //12
							'<td>'.$user['asuransi'].'</td>'. //13
							'<td>'.$user['lembur'].'</td>'. //14
							'<td>'.$user['pengobatan'].'</td>'. //15
							'<td>'.$user['lain'].'</td>'. //16
							'<td>'.$user['pajak_penerimaan'].'</td>'. //17
							'<td>'.$user['bpjs_non_tax'].'</td>'. //18
							'<td>'.$user['bpjs_tax'].'</td>'. //19
							'<td>'.$user['pot_gaji'].'</td>'. //20
							'<td>'.$user['natura_penerimaan'].'</td>'. //21
							'<td>'.$user['bantuan'].'</td>'. //22
							'<td>'.$user['thr'].'</td>'. //23
							'<td>'.$user['sub_total_penerimaan'].'</td>'. //24		
	                        
							//pemotongan
							'<td>'.$user['iuran'].'</td>'. //23
							'<td>'.$user['bpjs_karyawan_tax'].'</td>'. //24
							'<td>'.$user['uangmuka'].'</td>'. //25
							'<td>'.$user['pajak_pemotongan'].'</td>'. //26
							'<td>'.$user['bpjs_karyawan_tax'].'</td>'. //27
							'<td>'.$user['pajak_pemotongan'].'</td>'. //28
							'<td>'.$user['bpjs_tax'].'</td>'. //30
							'<td>'.$user['bpjs_non_tax'].'</td>'. //31
							'<td>'.$user['bpjs_karyawan_non_tax'].'</td>'. //32
							'<td>'.$user['iuran2'].'</td>'. //33
							'<td>'.$user['natura_pemotongan'].'</td>'. //34
							'<td>'.$user['pinjaman_kendaraan'].'</td>'. //35
							'<td>'.$user['pinjaman_rumah'].'</td>'. //36
							'<td>'.$user['pinjaman_obat'].'</td>'. //37
							'<td>'.$user['pinjaman_uang'].'</td>'. //38
							'<td>'.$user['pinjaman_lain2x'].'</td>'. //39
							'<td>'.$user['sub_total_pengeluaran'].'</td>'. //39

							//saldo
							'<td>-'.$user['pinjaman_kendaraan'].'</td>'. //35
							'<td>-'.$user['pinjaman_rumah'].'</td>'. //36
							'<td>-'.$user['pinjaman_obat'].'</td>'. //37
							'<td>-'.$user['pinjaman_uang'].'</td>'. //38
							'<td>-'.$user['pinjaman_lain2x'].'</td>'. //39
							'<td>-'.$user['sub_total_pengeluaran'].'</td>'. //40
							'<td>-'.$user['take_home_pay'].'</td>'. //41

	                        //tambahan bulan dan tahun untuk filter
	                        '<td style="text-align:center">'.$user['bulan'].'</td>'. //42
	                        '<td style="text-align:center">'.$user['tahun'].'</td>'. //43
	                        '<td>'.$user['email'].'</td>'. //44
	                        '<td name="btn_send" id="btn_send" style="text-align:center"><button>Send</button></td'; //45
	                    }	        
	        
	                    if(isset($_POST['search']))
                        {
        
                            $start = $_POST['start'];
                            $second = $_POST['second'];
                            $tableContent = '';
                            // SELECT INI DIGUNAKAN UNTUK SELECT DENGAN FILTER
                            $selectStmt = $con->prepare('SELECT * FROM payroll as p,karyawan as k,users as u where bulan like :start AND tahun like :second and p.nik = k.no_id and u.name = p.nama');
                            $selectStmt->execute(array(
                                ':start'=>$start,
                                ':second'=>$second
                            ));
                            $users = $selectStmt->fetchAll();
        
                            foreach ($users as $user) 
                            {
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
							'<td>PT. MANDIRI KONSULTAMA PERKASA</td>'. //0
							'<td hidden>'.$periode.'</td>'. //1
							'<td>'.$user['nik'].'</td>'. //2
							'<td>'.$user['nama'].'</td>'. //3
							'<td hidden>'.$user['mulai_kerja'].'</td>'. //4
							//slip gaji column 2							
							'<td>MT. HARYONO</td>'. //5
							'<td>'.$user['bagian'].'</td>'. //6
							'<td>'.$user['jabatan'].'</td>'. //7
							'<td>'.$user['status_k_tk_hb'].'</td>'. //8
							//slip gaji column 3
							//tanggal stamp

							//penerimaan
							'<td>'.$user['gaji_pokok'].'</td>'. //9
							'<td>'.$user['insentif'].'</td>'. //10
							'<td>'.$user['uang_makan'].'</td>'. //11
							'<td>'.$user['transport'].'</td>'. //12
							'<td>'.$user['asuransi'].'</td>'. //13
							'<td>'.$user['lembur'].'</td>'. //14
							'<td>'.$user['pengobatan'].'</td>'. //15
							'<td>'.$user['lain'].'</td>'. //16
							'<td>'.$user['pajak_penerimaan'].'</td>'. //17
							'<td>'.$user['bpjs_non_tax'].'</td>'. //18
							'<td>'.$user['bpjs_tax'].'</td>'. //19
							'<td>'.$user['pot_gaji'].'</td>'. //20
							'<td>'.$user['natura_penerimaan'].'</td>'. //21
							'<td>'.$user['bantuan'].'</td>'. //22
							'<td>'.$user['thr'].'</td>'. //23
							'<td>'.$user['sub_total_penerimaan'].'</td>'. //24		
	                        
							//pemotongan
							'<td>'.$user['iuran'].'</td>'. //23
							'<td>'.$user['bpjs_karyawan_tax'].'</td>'. //24
							'<td>'.$user['uangmuka'].'</td>'. //25
							'<td>'.$user['pajak_pemotongan'].'</td>'. //26
							'<td>'.$user['bpjs_karyawan_tax'].'</td>'. //27
							'<td>'.$user['pajak_pemotongan'].'</td>'. //28
							'<td>'.$user['bpjs_tax'].'</td>'. //30
							'<td>'.$user['bpjs_non_tax'].'</td>'. //31
							'<td>'.$user['bpjs_karyawan_non_tax'].'</td>'. //32
							'<td>'.$user['iuran2'].'</td>'. //33
							'<td>'.$user['natura_pemotongan'].'</td>'. //34
							'<td>'.$user['pinjaman_kendaraan'].'</td>'. //35
							'<td>'.$user['pinjaman_rumah'].'</td>'. //36
							'<td>'.$user['pinjaman_obat'].'</td>'. //37
							'<td>'.$user['pinjaman_uang'].'</td>'. //38
							'<td>'.$user['pinjaman_lain2x'].'</td>'. //39
							'<td>'.$user['sub_total_pengeluaran'].'</td>'. //39

							//saldo
							'<td>-'.$user['pinjaman_kendaraan'].'</td>'. //35
							'<td>-'.$user['pinjaman_rumah'].'</td>'. //36
							'<td>-'.$user['pinjaman_obat'].'</td>'. //37
							'<td>-'.$user['pinjaman_uang'].'</td>'. //38
							'<td>-'.$user['pinjaman_lain2x'].'</td>'. //39
							'<td>-'.$user['sub_total_pengeluaran'].'</td>'. //40
							'<td>-'.$user['take_home_pay'].'</td>'. //41

	                        //tambahan bulan dan tahun untuk filter
	                        '<td style="text-align:center">'.$user['bulan'].'</td>'. //42
	                        '<td style="text-align:center">'.$user['tahun'].'</td>'. //43
	                        '<td>'.$user['email'].'</td>'. //44
	                        '<td name="btn_send" id="btn_send" style="text-align:center"><button>Send</button></td'; //45
	                        }
                    	}
                    ?> 	

					<!-- INPUT UNTUK KEBUTUHAN SEND EMAIL -->
                    <input hidden name="nama" type="text" id="nama">
                    <input hidden name="gaji" type="text" id="gaji">
                    <input hidden name="email" type="text" id="email">
					
					<!-- tampilkan table content difilter maupun tidak difilter -->
					<?php
						echo $tableContent;
					?>

                    

                </table>
            </form>
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
            // ada tambahan baru edit di sini lagi
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