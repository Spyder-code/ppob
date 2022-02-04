@extends('layouts.frontend')
@section('title', 'Rewards')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center border-0 mt-2">
                    <h5 class="text-dark font-weight-bold display-4">Rewards</h5>
                    <div class="alert alrt-info">
                        <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                        <span class="alert-inner--text"><strong>Rewards</strong> are the points that you can redeem for
                            discounts and other benefits.
                        </span>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">1.	Logam Emas 0,5 gram pencapaian transaksi sebanyak 30juta/perbulan</li>
                            <li class="list-group-item">2.	Logam Emas 1 gram pencapaian transaksi sebanyak 65juta/perbulan </li>
                            <li class="list-group-item">3.	Logam Emas 3 gram pencapaian transaksi sebanyak 130jt/perbulan </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-7 mt-3">
            <div class="card">
                <div class="card-body row">
                    <div class="col-4 text-center">
                        <strong style="font-size: 1.4rem">Total Transaksi Saya Bulan ini:</strong>
                        <p style="font-size: 1.2rem">Rp.{{ number_format($transaction->total_transaksi,2,',','.') }}</p>
                    </div>
                    <div class="col-8">
                        <div class="alert">
                            @if ($type==0)
                                <strong class=" font-italic">Total transaksi anda masih belum mencapai jumlah minimal pencapaian</strong>
                            @elseif ($type==1)
                                <strong class="text-success">Selamat Total transaksi anda sudah mencapai jumlah minimal pencapaian pertama. Anda berhak mendapat Logam Emas 0.5 gram</strong><br>
                                <span>Anda dapat mengambil reward sekarang atau dapat menunggu sampai akhir bulan</span>
                            @elseif ($type==2)
                                <strong class="text-success">Selamat Total transaksi anda sudah mencapai jumlah minimal pencapaian kedua. Anda berhak mendapat Logam Emas 1 gram</strong><br>
                                <span>Anda dapat mengambil reward sekarang atau dapat menunggu sampai akhir bulan</span>
                            @elseif ($type==3)
                                <strong class="text-success">Selamat Total transaksi anda sudah mencapai jumlah minimal pencapaian ketiga. Anda berhak mendapat Logam Emas 3 gram</strong><br>
                                <span>Anda dapat mengambil reward sekarang atau dapat menunggu sampai akhir bulan</span>
                            @elseif ($type==4)
                                <strong class="text-success">Anda sudah mengambil reward</strong><br>
                                <span>Ayo tingkatkan lagi pencapaian transaksi dibulan berikutnya untuk mengambil reward lagi</span>
                            @endif
                        </div>
                        <form action="{{ route('reward.ambil') }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success w-100"  onclick="return confirm('are you sure?')" {{ $type==0 || $type==4?'disabled':'' }}>Ambil Reward</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-dark font-weight-bold">Riwayat Reward Saya</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reward</th>
                                    <th scope="col">Tanggal Menerima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->reward }}</td>
                                    <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

