@extends('admin.master')
@section('konten')
<div class="container-fluid">
    <h3 class="fw-semibold">Data Buku</h3>
    <div class="d-flex justify-content-end m-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
            Tambah Buku
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
                                <th>Judul Buku</th>
                                <th>Halaman</th>
                                <th>Jenis</th>
                                <th>Genre</th>
                                <th>Penulis</th>
                                <th>Publisher</th>
                                <th>Tahun</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_buku as $buku)
                            <tr>
                                <td>{{$buku->judul_buku}}</td>
                                <td>{{$buku->hal_buku}}</td>
                                <td>{{$buku->jenis_buku}}</td>
                                <td>{{$buku->genre_buku}}</td>
                                <td>{{$buku->penulis}}</td>
                                <td>{{$buku->publisher}}</td>
                                <td>{{$buku->tahun}}</td>
                                <td>{{$buku->deskripsi}}</td>
                                <td>
                                    @if ($buku->status == 0)
                                    Tersedia
                                    @elseif ($buku->status == 1)
                                    Dipinjam
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
                                                    <a class="dropdown-item d-flex align-items-center gap-3 editBuku" data-id="{{$buku->id_buku}}" href=" javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3 hapusBuku" data-id="{{$buku->id_buku}}" href="javascript:void(0)"><i class="fs-4 ti ti-trash"></i>Delete</a>
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
                            Tambah Buku
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/savebuku" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Judul Buku</label>
                                                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Buku" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Halaman Buku</label>
                                                    <input type="number" name="hal" id="Halaman Buku" class="form-control form-control-danger" placeholder="114" required />
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Jenis Buku</label>
                                                    <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Jenis Buku" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Genre Buku</label>
                                                    <input type="text" name="genre" id="Genre" class="form-control" placeholder="Genre Buku" required />
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Penulis</label>
                                                    <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Penulis" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Publisher</label>
                                                    <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Publisher" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Tahun</label>
                                                    <input type="number" name="tahun" id="tahun" class="form-control" placeholder="2024" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Deskripsi</label>
                                                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required></textarea>
                                                </div>
                                            </div>
                                            <!--/span-->
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
                    <form action="/updatebuku" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Judul Buku</label>
                                                    <input type="hidden" name="id" id="idEdit" class="form-control" />
                                                    <input type="text" name="judul" id="judulEdit" class="form-control" placeholder="Judul Buku" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Halaman Buku</label>
                                                    <input type="number" name="hal" id="halEdit" class="form-control form-control-danger" placeholder="114" required />
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Jenis Buku</label>
                                                    <input type="text" name="jenis" id="jenisEdit" class="form-control" placeholder="Jenis Buku" required />
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Genre Buku</label>
                                                    <input type="text" name="genre" id="genreEdit" class="form-control" placeholder="Genre Buku" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Penulis</label>
                                                    <input type="text" name="penulis" id="penulisEdit" class="form-control" placeholder="Penulis" required />
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Publisher</label>
                                                    <input type="text" name="publisher" id="publisherEdit" class="form-control" placeholder="Publisher" required/>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Tahun</label>
                                                    <input type="number" name="tahun" id="tahunEdit" class="form-control" placeholder="2024" required />
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Deskripsi</label>
                                                    <textarea name="deskripsi" id="deskripsiEdit" class="form-control" placeholder="Deskripsi" required></textarea>
                                                </div>
                                            </div>
                                            <!--/span-->
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
        $('body').on('click', '.editBuku', function() {
            var id = $(this).attr('data-id');

            // Memulai request Ajax untuk mengambil data buku berdasarkan ID
            $.ajax({
                url: "editbuku/" + id, // Endpoint URL untuk mengambil data buku
                type: "GET", // Metode HTTP yang digunakan
                dataType: "JSON", // Tipe data yang diharapkan dari respons server
                success: function(response) {
                    console.log(response[0]); // Debugging: mencetak respons ke console
                    var data = response[0]; // Mengambil data pertama dari respons array
                    // Mengisi nilai input fields dalam modal edit buku dengan data yang diterima
                    $('#idEdit').val(data.id_buku);
                    $('#judulEdit').val(data.judul_buku);
                    $('#halEdit').val(data.hal_buku);
                    $('#jenisEdit').val(data.jenis_buku);
                    $('#genreEdit').val(data.genre_buku);
                    $('#penulisEdit').val(data.penulis);
                    $('#publisherEdit').val(data.publisher);
                    $('#tahunEdit').val(data.tahun);
                    $('#deskripsiEdit').val(data.deskripsi);
                    $('#editBuku').modal('show'); // Menampilkan modal edit buku
                }
            });
        });

        // Hapus
        $('body').on("click", '.hapusBuku', function() {
            var idhapus = $(this).attr('data-id');
            console.log(idhapus); // Debugging: mencetak ID yang akan dihapus ke console
            // Konfirmasi penghapusan dengan dialog konfirmasi browser
            if (confirm("Apakah anda yakin? Data yang sudah di hapus tidak dapat dikembalikan!")) {
                // Redirect ke endpoint untuk menghapus buku berdasarkan ID
                location.href = 'hapusbuku/' + idhapus;
                alert("Data berhasil dihapus."); // Menampilkan alert sukses setelah berhasil menghapus
            } else {
                alert("Penghapusan dibatalkan. Data Anda aman."); // Menampilkan alert batal jika pengguna membatalkan penghapusan
            }
        });
    });
</script>
@endsection