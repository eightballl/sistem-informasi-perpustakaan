@extends('admin.master')
@section('konten')
@if (Auth::user()->role == 1)
<!-- Periksa apakah peran pengguna yang sedang masuk adalah Superadmin -->
<!-- Jika peran adalah Superadmin, tampilkan konten berikut ini -->
<div class="container-fluid">
    <h3 class="fw-semibold">Accounts</h3>
    <div class="d-flex justify-content-end m-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
            Tambah Akun
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
                                <th>Email</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $akun)
                            <tr>
                                <td>{{$akun->email}}</td>
                                <td>{{$akun->username}}</td>
                                <td>{{$akun->nama}}</td>
                                <td>{{$akun->alamat}}</td>
                                <td>{{$akun->no_telp}}</td>
                                <td>
                                    @if ($akun->role == 1)
                                    Superadmin
                                    @elseif ($akun->role == 2)
                                    Admin
                                    @endif
                                </td>
                                <td>
                                    <center>
                                        <div class="dropdown dropstart">
                                            <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-6"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 editAkun" data-id="{{$akun->id}}" href=" javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 hapusAkun" data-id="{{$akun->id}}" href="javascript:void(0)"><i class="fs-4 ti ti-trash"></i>Delete</a>
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
                            Tambah Akun
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/register/action" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email@email.com" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="username" class="form-control" placeholder="Username" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Password</label>
                                                    <input type="text" name="password" class="form-control" placeholder="Password" required />
                                                </div>
                                            </div>
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
                                            <div class="col-md-6">
                                                <div class="mb-3 has-danger">
                                                    <label class="control-label">Role</label>
                                                    <select class="form-select" name="role" required>
                                                        <option value="">- Pilih Role -</option>
                                                        <option value="1">Superadmin</option>
                                                        <option value="2">Admin</option>
                                                    </select>
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
        <div class="modal fade" id="editAkun" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">
                            Edit Buku
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/updateakun" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Email</label>
                                                    <input type="hidden" name="id" id="id">
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email@email.com" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Password</label>
                                                    <input type="text" name="password" class="form-control" placeholder="Password" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Nama</label>
                                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">No. Telp</label>
                                                    <input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="08xxxxxxx" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 has-danger">
                                                    <label class="control-label">Role</label>
                                                    <select class="form-select" name="role" id="role" required>
                                                        <option value="">- Pilih Role -</option>
                                                        <option value="1">Superadmin</option>
                                                        <option value="2">Admin</option>
                                                    </select>
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
        $('body').on('click', '.editAkun', function() {
            var id = $(this).attr('data-id');

            // Memulai request Ajax untuk mengambil data akun berdasarkan ID
            $.ajax({
                url: "editakun/" + id, // Endpoint URL untuk mengambil data akun
                type: "GET", // Metode HTTP yang digunakan
                dataType: "JSON", // Tipe data yang diharapkan dari respons server
                success: function(response) {
                    console.log(response[0]); // Debugging: mencetak respons ke console
                    var data = response[0]; // Mengambil data pertama dari respons array
                    // Mengisi nilai input fields dalam modal edit dengan data yang diterima
                    $('#id').val(data.id);
                    $('#email').val(data.email);
                    $('#username').val(data.username);
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#no_telp').val(data.no_telp);
                    $('#role').val(data.role);
                    $('#editAkun').modal('show'); // Menampilkan modal edit akun
                }
            });
        });

        // Hapus
        $('body').on("click", '.hapusAkun', function() {
            var idhapus = $(this).attr('data-id');
            console.log(idhapus); // Debugging: mencetak ID yang akan dihapus ke console
            // Konfirmasi penghapusan dengan dialog konfirmasi browser
            if (confirm("Apakah anda yakin? Data yang sudah di hapus tidak dapat dikembalikan!")) {
                // Redirect ke endpoint untuk menghapus akun berdasarkan ID
                location.href = 'hapusakun/' + idhapus;
                alert("Data berhasil dihapus."); // Menampilkan alert sukses setelah berhasil menghapus
            } else {
                alert("Penghapusan dibatalkan. Data Anda aman."); // Menampilkan alert batal jika pengguna membatalkan penghapusan
            }
        });
    });
</script>
@endif
@endsection