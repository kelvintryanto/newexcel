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
	                    $selectStmt = $con->prepare('SELECT * FROM payroll as pk,karyawan as kk,users as u where pk.no_id = kk.no_id and u.name = pk.nama');
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
	                        '<td>'.$user['nama'].'</td>'. //0
	                        '<td hidden>'.$user['no_id'].'</td>'. //1
	                        '<td hidden>'.$user['kode_status'].'</td>'.//2
	                        '<td hidden>PT. MANDIRI KONSULTAMA PERKASA</td>'. //3
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
	                        '<td style="text-align:center">'.$user['bulan'].'</td>'. //33
	                        '<td style="text-align:center">'.$user['tahun'].'</td>'. //34
	                        '<td>'.$user['email'].'</td>'. //35
	                        '<td name="btn_send" id="btn_send" style="text-align:center"><button>Send</button></td';                               
	                    }
	        
	        
	                    if(isset($_POST['search']))
                        {
        
                            $start = $_POST['start'];
                            $second = $_POST['second'];
                            $tableContent = '';
                            // SELECT INI DIGUNAKAN UNTUK SELECT DENGAN FILTER
                            $selectStmt = $con->prepare('SELECT * FROM payroll as p,karyawan as kk,users as u where bulan like :start AND tahun like :second and p.no_id = kk.no_id and u.name = p.nama');
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
	                            '<td>'.$user['nama'].'</td>'. //0
	                            '<td hidden>'.$user['no_id'].'</td>'. //1
	                            '<td hidden>'.$user['kode_status'].'</td>'.//2
	                            '<td hidden>PT. MANDIRI KONSULTAMA PERKASA</td>'. //3
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
	                            '<td style="text-align:center">'.$user['bulan'].'</td>'. //33
	                            '<td style="text-align:center">'.$user['tahun'].'</td>'. //34
	                            '<td>'.$user['email'].'</td>'. //35
	                            '<td name="btn_send" id="btn_send" style="text-align:center"><button>Send</button></td';
	                        }
                    	}
                    ?> 	

                    <!-- INPUT UNTUK KEBUTUHAN SEND EMAIL -->
                    <input hidden name="nama" type="text" id="nama">
                    <input hidden name="gaji" type="text" id="gaji">
                    <input hidden name="email" type="text" id="email">

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