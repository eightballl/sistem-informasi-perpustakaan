@extends('admin.master')
@section('konten')
<div class="container-fluid">
    <h3 class="fw-semibold">Member</h3>
    <div class="d-flex justify-content-end m-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
            Tambah Member
        </button>
    </div>
    @if(Session::has('sukses'))
    <div class="alert alert-success alertku text-center">
        {{ Session::get('sukses') }}
    </div>
    @endif
    <div class="card w-100 position-relative overflow-hidden">
        <section class="datatables">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($member as $member)
                            <tr>
                                <td>{{$member->nama}}</td>
                                <td>{{$member->alamat}}</td>
                                <td>{{$member->no_telp}}</td>
                                <td>
                                    <center>
                                        <div class="dropdown dropstart">
                                            <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-6"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 editMember" data-id="{{$member->id_member}}" href=" javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 hapusMember" data-id="{{$member->id_member}}" href="javascript:void(0)"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- BEGIN MODAL -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">
                            Tambah Member
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/savemember" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Nama</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Nama" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">No. Telp</label>
                                                    <input type="number" name="no_telp" class="form-control" placeholder="08xxxxxxx" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="control-label">Alamat</label>
                                                    <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary btn-add-event">
                                <i class="ti ti-device-floppy me-1 fs-4"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL -->

        <!-- BEGIN MODAL -->
        <div class="modal fade" id="editBuku" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">
                            Edit Buku
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/updatemember" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="row pt-3">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="control-label">Nama</label>
                                                        <input type="hidden" name="id_member" id="idMember">
                                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="control-label">No. Telp</label>
                                                        <input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="08xxxxxxx" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="control-label">Alamat</label>
                                                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary btn-add-event">
                                <i class="ti ti-device-floppy me-1 fs-4"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Edit
        $('body').on('click', '.editMember', function() {
            var id = $(this).attr('data-id');

            // Mengirimkan permintaan Ajax untuk mengambil data member berdasarkan ID
            $.ajax({
                url: "editmember/" + id, // URL endpoint untuk mengambil data member
                type: "GET", // Metode HTTP yang digunakan
                dataType: "JSON", // Tipe data yang diharapkan dari respons server
                success: function(response) {
                    console.log(response[0]); // Debugging: mencetak respons ke console
                    var data = response[0]; // Mengambil data pertama dari respons array

                    // Mengisi nilai input fields dalam modal edit dengan data yang diterima
                    $('#idMember').val(data.id_member);
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#no_telp').val(data.no_telp);
                    $('#editBuku').modal('show'); // Menampilkan modal edit member
                }
            });
        });

        // Hapus
        $('body').on("click", '.hapusMember', function() {
            var idhapus = $(this).attr('data-id');
            console.log(idhapus);
            if (confirm("Apakah anda yakin? Data yang sudah di hapus tidak dapat dikembalikan!")) {
                // Mengarahkan ke URL untuk menghapus member berdasarkan ID
                location.href = 'hapusmember/' + idhapus;
                alert("Data berhasil dihapus.");
            } else {
                alert("Penghapusan dibatalkan. Data Anda aman.");
            }
        });

    });
</script>
@endsection