@extends('layouts.frontend')
@section('asset')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/css/select2.min.css">
    <style>
        #badge{
            background-color: rgb(243, 215, 103)
        }
    </style>
@endsection
@section('title', 'PLN')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center border-0 mt-2">
                    <h5 class="text-dark font-weight-bold display-4">Beli PLN prabayar</h5>
                </div>
                <form class="form" id="form_purchase">@csrf
                    <div class="card-body">

                    <div class="form-group row m-0">
                    <div class="col-lg-10">
                        <div class="row">

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label" for="provider">No Meteran / Id Pelanggan</label>
                                    <select class="select2 form-control country" required  name="customer" id="customer">
                                        <option value="">Select ..</option>
                                        @foreach($customers as $v)
                                        <option value="{{$v->id}}">{{$v->nama}}&nbsp|&nbsp no: {{$v->no_meteran}}&nbsp|&nbsp id: {{$v->id_pelanggan}}&nbsp
                                            |&nbsp&nbsp&nbspbatas daya : {{$v->batas_daya}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-primary float-right"  href="{{ url('/customer') }}">Tambah Customer</a>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_telp">Masukkan Informasi!</label>
                                    <input type="text" id="informasi" class="form-control required" name="informasi" value="pembayaran masuk 1 jam setelah checkout!" required>
                                </div>
                            </div>
                        </div>
                        {{-- <h5 class="text-dark font-weight-bold display-5">Transaksi Terakhir</h5><br>
                        <div class="row">
                            @foreach ($last_transaction as $each)
                            <div class="col-sm-4">
                                <label class="option bg-secondary">
                                    <span class="option-label">
                                        <span class="option-head">
                                        <span class="option-title">
                                            {{ $each->nama }}
                                        </span>
                                        <span class="option-focus">
                                            {{$each->batas_daya}}

                                        </span>
                                        </span>
                                        <span class="option-body">
                                            Rp {{number_format($each->price, 0) }} &nbsp| id:  {{$each->id_pelanggan}}
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @endforeach

                        </div> --}}
                        <hr>
                        <h5 class="text-dark font-weight-bold display-5">Pilih Paket PLN</h5><br>
                        <div class="row">
                            @foreach ($paket_pln as $each)
                            <div class="col-lg-4">
                                <label class="option" id="badge">
                                    <span class="option-control">
                                        <span class="radio radio-bold radio-brand"></span>
                                        <input type="radio" name="paket" value="{{ $each->id }}" required/>
                                        <span></span>
                                        </span>
                                    </span>
                                    <span class="option-label">
                                        <span class="option-head">
                                        <span class="option-title">
                                            {{ $each->paket_pln }}
                                        </span>
                                        {{-- <span class="option-focus">
                                        Free
                                        </span> --}}
                                        </span>
                                        <span class="option-body">
                                            Harga : Rp {{ number_format($each->fixed_price, 0) }}
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    </div>

                    <div class="card-footer">
                        <div class="container">
                            <div class="d-none d-lg-flex align-items-center">
                                <div class="topbar-item">
                                    <button type="submit" id="btn_purchase" class="btn btn-success mr-2 float-right">Beli Sekarang!</button>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-dark font-weight-bold display-4">Transaksi Terakhir</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Semua</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Bulan ini</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="week-tab" data-toggle="tab" href="#week" role="tab" aria-controls="week" aria-selected="false">Minggu ini</a>
                            </li>
                        </ul>
                            <div class="tab-content mt-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    <div class="table-responsive">
                                        <table class="table" id="all">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kategori Transaksi</th>
                                                    <th scope="col">Atas Nama</th>
                                                    <th scope="col">Nominal</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                    $price = 0;
                                                @endphp
                                                @foreach ($all as $item)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>PLN PRABAYAR</td>
                                                    <td>{{ $item->customer->nama }}</td>
                                                    <td>{{ $item->paket->paket_pln }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                    $price = $price + $item->price;
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <strong class="display-4">Total Transaksi Rp. {{ number_format($price,2,',','.') }}</strong>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                                    <div class="table-responsive">
                                        <table class="table" id="month">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kategori Transaksi</th>
                                                    <th scope="col">Atas Nama</th>
                                                    <th scope="col">Nominal</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                    $price_month = 0;
                                                @endphp
                                                @foreach ($month as $item)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>PLN PRABAYAR</td>
                                                    <td>{{ $item->customer->nama }}</td>
                                                    <td>{{ $item->paket->paket_pln }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                    $price_month = $price_month + $item->price;
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <strong class="display-4">Total Transaksi Rp. {{ number_format($price_month,2,',','.') }}</strong>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week-tab">
                                    <div class="table-responsive">
                                        <table class="table" id="week">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kategori Transaksi</th>
                                                    <th scope="col">Atas Nama</th>
                                                    <th scope="col">Nominal</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                    $price_week = 0;
                                                @endphp
                                                @foreach ($week as $item)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>PLN PRABAYAR</td>
                                                    <td>{{ $item->customer->nama }}</td>
                                                    <td>{{ $item->paket->paket_pln }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                    $price_week = $price_week + $item->price;
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <strong class="display-4">Total Transaksi Rp. {{ number_format($price_week,2,',','.') }}</strong>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 25,
                dom: 'Bfrtip',
                buttons:  [
                    {
                        extend: 'pdf', className: 'btn btn-success px-5', text: 'Print Data'
                    }
                ]
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#form_purchase").submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    title: "Apakah Kamu yakin Untuk Meembeli Paket PLN?",
                    text: "",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Beli Sekarang!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({ //line 28
                            type: 'POST',
                            url: '{{ url("/pln-post") }}',
                            dataType: 'json',
                            data: new FormData($("#form_purchase")[0]),
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                document.getElementById("form_purchase").reset();
                                if (data.code == 200) {
                                    Swal.fire(
                                        "Berhasil!",
                                        `${data.message}`,
                                        "success"
                                    ).then(function(){
                                        window.location.reload();

                                    });
                                } else {
                                    Swal.fire(
                                        "Gagal!",
                                        `${data.message}`,
                                        "error"
                                    )
                                }
                            }
                        });

                    }
                });

            });
        });
    </script>
@endsection
