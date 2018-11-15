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
		@foreach ($clientPayroll as $c)
		<tr>
			<td>{{$c->no}}</td>
			<td>{{$c->nik}}</td>
			<td>{{$c->nama}}</td>
			<td>{{$c->divisi}}</td>
			<td>{{$c->keterangan_divisi}}</td>
			<td>{{$c->kehadiran}}</td>
			<td>{{$c->gaji_pokok}}</td>
			<td>{{$c->insentif}}</td>
			<td>{{$c->uang_makan}}</td>
			<td>{{$c->transport}}</td>
			<td>{{$c->asuransi}}</td>
			<td>{{$c->lembur}}</td>
			<td>{{$c->pengobatan}}</td>
			<td>{{$c->lain}}</td>
			<td>{{$c->pajak}}</td>
			<td>{{$c->bpjs_non_tax}}</td>
			<td>{{$c->bpjs_tax}}</td>
			<td>{{$c->pot_gaji}}</td>
			<td>{{$c->natura}}</td>
			<td>{{$c->bantuan}}</td>
			<td>{{$c->thr}}</td>
			<td>{{$c->sub_total}}</td>
			<td>{{$c->bulan}}</td>
			<td>{{$c->tahun}}</td>
		</tr>
		@endforeach
	</table>

</body>
</html>