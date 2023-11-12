@extends('layouts.sidebarlayout')
@section('judulhead', 'Input SPP')
@section('deskripsiheader', 'Transaksi Pembayaran')
@section('isi')
<form>
	<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="idpetugas">ID Petugas:</label>
			<input class="form-control" type="text" name="idpetugas" disabled>
		</div>		
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="nama">Nama:</label>
			<input class="form-control" type="text" name="nama">
		</div>		
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="kelas">Kelas:</label>
			<select class="form-control" name="kelas" id="kelas" required>
                        <option value="" disabled selected>--Pilih Kelas--</option>
                        @foreach ($kelas as $data)
                            <option value="{{$data->id}}">{{ $data->nama_kelas }}</option>
                        @endforeach
            </select>
		</div>		
	</div>
	<div class="col-md-6">
        <div class="form-group">
            <label for "tanggal">Tanggal Bayar</label>
            <input class="form-control" type="date" name="tanggal" id="tanggal">
        </div>
    </div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="jumlah">Jumlah (Rp.)</label>
			<input class="form-control" type="number" name="jumlah">
		</div>		
	</div>
</div>
<button type="submit" class="btn btn-success">Bayar</button>
</form>
@endsection