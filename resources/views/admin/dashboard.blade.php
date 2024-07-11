@extends('admin.master')
@section('konten')
<?php
setlocale(LC_TIME, 'ID');
?>
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row align-items-center">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dashboard as $item)
                                            <tr>
                                                <td>{{strftime('%A, %d-%m-%y',strtotime($item->tgl_pinjaman))}}</td>
                                                <td>{{$item->member->nama ?? '-'}}</td>
                                                <td>{{$item->buku->judul_buku ?? '-'}}</td>
                                                <td>{{$item->lama_pinjaman}} Hari</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                    Dipinjam
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection