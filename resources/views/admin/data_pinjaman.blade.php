@extends('admin.master')
@section('konten')
<?php
setlocale(LC_TIME, 'ID');
?>
<div class="container-fluid">
    <h3 class="fw-semibold">Data Pinjaman</h3>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
            Tambah Pinjaman
        </button>
    </div>
    <div class="card w-100 position-relative overflow-hidden">
        <section class="datatables">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>Tanggal Pinjam</th>
                                <th>Nama</th>
                                <th>Judul Buku</th>
                                <th>Lama Pinjam</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_pinjaman as $item)
                            <tr>
                                <td>{{strftime('%A, %d-%m-%y',strtotime($item->tgl_pinjaman))}}</td>
                                <td>{{$item->member->nama ?? '-'}}</td>
                                <td>{{$item->buku->judul_buku}}</td>
                                <td>{{$item->lama_pinjaman}}</td>
                                <td>
                                    @if ($item->status == 1)
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
                                                    <a class="dropdown-item d-flex align-items-center gap-3 updateKembali" data-id="{{$item->id_pinjaman}}" href=" javascript:void(0)"><i class="fs-4 ti ti-edit"></i>Selesai</a>
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
                            Tambah Pinjaman
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/savepinjaman" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="mb-3">
                                                <label class="control-label">Nama</label>
                                                <select class="form-select" name="nama" required>
                                                    <option value="">- Pilih Member -</option>
                                                    @foreach($member as $p)
                                                    <option value="{{$p->id_member}}">{{$p->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--/span-->
                                            <div class="mb-3 has-danger">
                                                <label class="control-label">Judul Buku</label>
                                                <select class="form-select" name="judul" required>
                                                    <option value="">- Pilih Buku -</option>
                                                    @foreach($buku as $p)
                                                    <option value="{{$p->id_buku}}">{{$p->judul_buku}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="control-label">Lama Pinjaman</label>
                                                <input type="number" name="lama" id="lama" class="form-control" placeholder="5 Hari" required/>
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
        <div class="modal fade" id="updateKembali" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">
                            Pinjaman Selesai
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/updatekembali" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="card-body">
                                        <center>
                                            <h3>Selesaikan Pinjaman ?</h3>
                                        </center>
                                        <input type="hidden" name="id_pinjaman" id="idPinjaman" class="form-control" placeholder="ID" />
                                        <input type="hidden" name="id_buku" id="idBuku" class="form-control" placeholder="ID" />
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
                                Selesai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Edit
            $('body').on('click', '.updateKembali', function() {
                var id = $(this).attr('data-id');
                console.log(id); // Debugging: mencetak ID yang akan diedit ke console

                // Memulai request Ajax untuk mengambil data pinjaman kembali berdasarkan ID
                $.ajax({
                    url: "editkembali/" + id, // Endpoint URL untuk mengambil data pinjaman kembali
                    type: "GET", // Metode HTTP yang digunakan
                    dataType: "JSON", // Tipe data yang diharapkan dari respons server
                    success: function(response) {
                        console.log(response[0]); // Debugging: mencetak respons ke console
                        var data = response[0]; // Mengambil data pertama dari respons array

                        // Mengisi nilai input fields dalam modal update kembali dengan data yang diterima
                        $('#idPinjaman').val(data.id_pinjaman);
                        $('#idBuku').val(data.id_buku);
                        $('#updateKembali').modal('show'); // Menampilkan modal update kembali
                    }
                });
            });
        });
    </script>
</div>
@endsection