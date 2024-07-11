@extends('admin.master')
@section('konten')
<?php
setlocale(LC_TIME, 'ID');
?>
<div class="container-fluid">
    <h3 class="fw-semibold">Riwayat Pinjaman</h3>
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
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat_pinjaman as $item)
                            <tr>
                                <td>{{strftime('%A, %d-%m-%y',strtotime($item->tgl_pinjaman))}}</td>
                                <td>{{$item->member->nama ?? '-'}}</td>
                                <td>{{$item->buku->judul_buku}}</td>
                                <td>{{$item->lama_pinjaman}}</td>
                                <td>{{strftime('%A, %d-%m-%y',strtotime($item->tgl_kembali)) ?? '-'}}</td>
                                <td>
                                    @if ($item->status == 2)
                                    Selesai
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
@endsection