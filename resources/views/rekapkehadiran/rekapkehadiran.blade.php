@extends('layouts.sidebarlayout2')
@section('judulhead', 'Input Absensi')
@section('deskripsiheader', 'Pilih Tanggal dan Kelas')
@section('deskripsiheader2', 'Input Absensi')
@section('isi')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for "tanggal">Tanggal</label>
            <input class="form-control" type="date" name="tanggal" id="tanggal" oninput="updateDate(this)">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select class="form-control" name="kelas" id="kelas" required onchange="filterData(this)">
                <option value="" disabled selected>----PILIH----</option>
                @foreach ($kelas as $data)
                    <option value="{{$data->id}}">{{ $data->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endsection

@section('isi2')
<div class="row">
    <div class="col-sm-6">
        <h5>Nama Kelas:</h5>
        <p id="selectedKelas"></p>
        <div class="invalid-feedback">
        Kelas Harus Dipilih
        </div>
    </div>
    <div class="col-sm-6">
        <h5>Tanggal:</h5>
        <p id="selectedTanggal"></p>
        <div class="invalid-feedback">
        Tanggal Harus Dipilih
        </div>
    </div>
</div>

<table id="tabledta" class="table table-bordered table-hover" style="display: none;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Absensi</th>
            <th>Keterangan Lain</th>
        </tr>
    </thead>
    <tbody>
    @php
$currentKelas = null;
$no = 0;
@endphp

@foreach ($santri as $list)
    @if ($list->kelas !== $currentKelas)
        @php
        $currentKelas = $list->kelas;
        $no = 1;
        @endphp
    @endif

    <tr class="santri-row" data-kelas="{{ $list->kelas }}">
        <td>{{ $no }}</td>
        <td>{{ $list->nama_santri }}</td>
        <td>
            <select class="form-control" name="kelas" id="kelas" required>
                <option value="" disabled selected>----PILIH----</option>
                <option value="S">Sakit</option>
                <option value="I">Ijin</option>
                <option value="TK">Tanpa Keterangan</option>
            </select>
        </td>
        <td>
            <input class="form-control" type="text" name="" id="">
        </td>
    </tr>
    @php
    $no++;
    @endphp
@endforeach

    </tbody>
</table>
<div class="row">
    <div class="col-sm-6">
    <button type="button" class="btn btn-success mb-1">Simpan</button>
    </div>
</div>
<script>
    function updateDate(input) {
        const date = new Date(input.value);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = date.toLocaleDateString('en-US', options);
        document.getElementById('selectedTanggal').innerText = formattedDate;
    }

    function filterData(select) {
        const selectedKelas = select.value;
        const selectedKelasText = select.options[select.selectedIndex].text;
        document.getElementById('selectedKelas').innerText = selectedKelasText;

        // Hide all rows
        const rows = document.querySelectorAll('.santri-row');
        rows.forEach((row) => {
            row.style.display = 'none';
        });

        // Show rows with matching class
        const filteredRows = document.querySelectorAll(`.santri-row[data-kelas="${selectedKelas}"]`);
        filteredRows.forEach((row) => {
            row.style.display = 'table-row';
        });

        // Show or hide the table based on class selection
        const table = document.getElementById('tabledta');
        if (selectedKelas === '') {
            table.style.display = 'none';
        } else {
            table.style.display = 'table';
        }
    }
</script>
@endsection
