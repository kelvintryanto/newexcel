<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>clients</title>
</head>
<body>
	<h1>LIST</h1>
	<table>
		<tr>
			<th>No</th>
			<th>No.ID</th>
			<th>Nama Karyawan</th>
			<th>No.NPWP</th>
			<th>NPWP Sejak</th>
			<th>CD.Jenis Penghasilan</th>
			<th>Nama Jenis Penghasilan</th>
			<th>Kerja di 1 Tempat</th>
			<th>Alamat 1</th>
			<th>Alamat 2</th>
			<th>No.KTP/PASPOR</th>
			<th>KODE NEGARA</th>
			<th>STATUS</th>
			<th>TANGGUNGAN</th>
			<th>KODE STATUS</th>
			<th>Jenis Kelamin(L/P)</th>
			<th>MULAI KERJA</th>
			<th>AKHIR KERJA</th>
			<th>PTKP/BULAN</th>
		</tr>
		@foreach ($clients as $c)
		<tr>
			<td>{{$c->no}}</td>
			<td>{{$c->no_id}}</td>
			<td>{{$c->nama}}</td>
			<td>{{$c->no_npwp}}</td>
			<td>{{$c->npwp_sejak}}</td>
			<td>{{$c->cd_jenishasil}}</td>
			<td>{{$c->nama_jenishasil}}</td>
			<td>{{$c->kerja_di_1_tempat}}</td>
			<td>{{$c->alamat_1}}</td>
			<td>{{$c->alamat_2}}</td>
			<td>{{$c->no_ktp}}</td>
			<td>{{$c->kode_negara}}</td>
			<td>{{$c->status}}</td>
			<td>{{$c->tanggungan}}</td>
			<td>{{$c->kode_status}}</td>
			<td>{{$c->jenis_kelamin}}</td>
			<td>{{$c->mulai_kerja}}</td>
			<td>{{$c->akhir_kerja}}</td>
			<td>{{$c->ptkp}}</td>
		</tr>
		@endforeach
	</table>

</body>
</html>