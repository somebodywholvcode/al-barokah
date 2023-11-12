@extends('layouts.sidebarlayout')
@section('judulhead', 'Data Siswa')
@section('deskripsiheader', 'Pilih Kelas')
@section('isi')

<div class="my-2">
    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modalTambahData">Tambah Data</button>
</div>
@if (Session::has('success'))
<script>
  Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Something went wrong!",
  footer: '<a href="#">Why do I have this issue?</a>'
});
</script>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="filterKelas">Filter Kelas</label>
            <select class="form-control" name="filterKelas" id="filterKelas" onchange="filterTableData(this)">
                <option value="" disabled selected>-->Pilih Kelas<--</option>
                <option value="" id="semuakelas">Semua Kelas</option>
                @foreach ($kelas as $data)
                    <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<table id="tabledta" class="table table-bordered table-hover" >
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Kelas</th>
            <th>Action</th>
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
        <td>{{ $list->gender }}</td>
        <td>{{ $list->list_kelas->nama_kelas }}</td>
        <td>
            <form action="{{ route('santri.destroy', ['santri' => $list->id]) }}" method="post">
                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#modalEditData{{ $list->id }}">Edit</button>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @php
    $no++;
    @endphp
@endforeach

    </tbody>
</table>

<!-- Add JavaScript to customize the feedback -->
<script>
    document.getElementById('formTambahData').addEventListener('submit', function (e) {
        var inputs = this.querySelectorAll('[required]');
        inputs.forEach(function (input) {
            if (!input.value) {
                input.classList.add('is-invalid');
                e.preventDefault(); // Prevent form submission
            }
        });

        inputs.forEach(function (input) {
            input.addEventListener('input', function () {
                input.classList.remove('is-invalid');
            });
        });
    });

    function filterTableData(select) {
    const selectedKelas = select.value;
    const rows = document.querySelectorAll('.santri-row');

    // Hide all rows
    rows.forEach((row) => {
        row.style.display = 'none';
    });

    // If a class is selected, show rows with the selected class
    if (selectedKelas !== '') {
        let counter = 1;
        rows.forEach((row) => {
            const rowKelas = row.getAttribute('data-kelas');
            if (rowKelas === selectedKelas) {
                row.style.display = 'table-row';

                // Update the number for the displayed rows
                const numberCell = row.querySelector('td:first-child');
                if (numberCell) {
                    numberCell.innerText = counter;
                    counter++;
                }
            }
        });
    } else {
        // If "Pilih Kelas" is selected, show no rows
        const semuaKelasOption = document.getElementById('semuakelas');
        if (!semuaKelasOption.selected) {
            rows.forEach((row) => {
                row.style.display = 'none';
            });
        } else {
            // If "Semua Kelas" is selected, show all rows
            let counter = 1;
            rows.forEach((row) => {
                row.style.display = 'table-row';

                // Update the number for the displayed rows
                const numberCell = row.querySelector('td:first-child');
                if (numberCell) {
                    numberCell.innerText = counter;
                    counter++;
                }
            });
        }
    }
}


</script>

<!--MODAL TAMBAH DATA-->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORM TAMBAH DATA -->
                <form action="{{ route('santri.store') }}" method="POST" id="formTambahData">
                @csrf
                <div class="form-group">
                    <label for="addNamaSantri">Nama Santri</label>
                    <input type="text" class="form-control" id="nama_santri" name="nama_santri" aria-describedby="text" required>
                    <div class="invalid-feedback">
                        Nama Santri harus diisi.
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="" disabled selected>----PILIH----</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        Gender harus dipilih.
                    </div>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select class="form-control" name="kelas" id="kelas" required>
                        <option value="" disabled selected>----PILIH----</option>
                        @foreach ($kelas as $data)
                            <option value="{{$data->id}}">{{ $data->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Kelas harus dipilih.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
                <!-- END FORM TAMBAH DATA -->
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT DATA -->
@foreach ($santri as $list)
<div class="modal fade" id="modalEditData{{ $list->id }}" tabindex="-1" aria-labelledby="modalEditData{{ $list->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORM EDIT DATA -->
                <form action="{{ route('santri.update', ['santri' => $list->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_santri">Nama Santri</label>
                        <input type="text" class="form-control" id="nama_santri" name="nama_santri" value="{{ $list->nama_santri }}" aria-describedby="text">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="L" {{ $list->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ $list->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas">
                            @foreach ($kelas as $data)
                            <option value="{{ $data->id }}" {{ $list->kelas == $data->id ? 'selected' : '' }}>{{ $data->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
                <!-- END FORM EDIT DATA -->
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection