@extends('layouts.frontend')
@section('asset')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/css/select2.min.css">
    <style>
        #badge{
            background-color: rgb(218, 243, 103)
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
@endsection
@section('title', 'Paket Data')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center border-0 mt-2">
                    <h5 class="text-dark font-weight-bold display-4">Isi Ulang Paket Data </h5>
                </div>
                <form class="form" id="form_purchase">@csrf
                    <div class="card-body">

                    <div class="form-group row m-0">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="number" minlength="10" min="0" max="999999999999999999" id="phone_number" class="form-control required" name="phone_number" pattern="[0-9]{20}-[0-9]{4}-[0-9]{4}-[0-9]{4}" placeholder="08..." required>
                                </div>
                            </div>

                        </div>
                        {{-- <h5 class="text-dark font-weight-bold display-5">Transaksi Terakhir</h5><br>
                        <div class="row">
                            @foreach ($last_transaction as $each)
                            <div class="col-lg-4">
                                <label class="option bg-secondary">
                                    <span class="option-label">
                                        <span class="option-head">
                                        <span class="option-title">
                                            {{ $each->nomor_hp }}
                                        </span>
                                        <span class="option-focus">
                                            {{$each->nama_provider}}
                                        </span>
                                        </span>
                                        <span class="option-body">
                                            Jenis Paket : {{$each->nama_paket }}
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @endforeach

                        </div> --}}
                        <hr>
                        <h5 class="text-dark font-weight-bold display-5">Pilih Pulsa</h5><br>
                        <div class="row">
                            @foreach ($paket_data as $each)
                            <div class="col-lg-4">
                                <label class="option " id="badge">
                                    <span class="option-control">
                                        <span class="radio radio-bold radio-brand"></span>
                                        <input type="radio" name="jenis_paket" value="{{ $each->id }}" required/>
                                        <span></span>
                                        </span>
                                    </span>
                                    <span class="option-label">
                                        <span class="option-head">
                                        <span class="option-title">
                                            {{ $each->nama_paket }}
                                        </span>
                                        <span class="option-focus">
                                            {{$each->nama_provider}}
                                            <input type="hidden" name="id_provider" value="{{ $each->id_provider }}" required/>
                                        </span>
                                    </span>
                                        <span class="option-body">
                                            Harga : Rp {{ number_format($each->fixed_price, 0) }}
                                            <input type="hidden" name="price" value="{{ $each->fixed_price }}" required/>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    </div>

                    <div class="card-footer">
                    <button type="submit" id="btn_purchase" class="btn btn-success mr-2 float-right">Beli!</button>
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
                                    <table border="0" cellspacing="5" cellpadding="5">
                                        <tbody><tr>
                                            <td>Minimum date:</td>
                                            <td><input type="text" id="min" name="min"></td>
                                        </tr>
                                        <tr>
                                            <td>Maximum date:</td>
                                            <td><input type="text" id="max" name="max"></td>
                                        </tr>
                                    </tbody></table>
                                    <div class="table-responsive">
                                        <table class="table" id="all">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kategori Transaksi</th>
                                                    <th scope="col">No.Hp</th>
                                                    <th scope="col">Paket</th>
                                                    <th scope="col">Provider</th>
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
                                                    <td>Paket Data</td>
                                                    <td>{{ $item->nomor_hp }}</td>
                                                    <td>{{ $item->paket->nama_paket }}</td>
                                                    <td>{{ $item->provider->nama_provider }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('Y/m/d', strtotime($item->created_at)) }}</td>
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
                                                    <th scope="col">No.Hp</th>
                                                    <th scope="col">Paket</th>
                                                    <th scope="col">Provider</th>
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
                                                    <td>Paket Data</td>
                                                    <td>{{ $item->nomor_hp }}</td>
                                                    <td>{{ $item->paket->nama_paket }}</td>
                                                    <td>{{ $item->provider->nama_provider }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('Y/m/d', strtotime($item->created_at)) }}</td>
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
                                                    <th scope="col">No.Hp</th>
                                                    <th scope="col">Paket</th>
                                                    <th scope="col">Provider</th>
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
                                                    <td>Paket Data</td>
                                                    <td>{{ $item->nomor_hp }}</td>
                                                    <td>{{ $item->paket->nama_paket }}</td>
                                                    <td>{{ $item->provider->nama_provider }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('Y/m/d', strtotime($item->created_at)) }}</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>

    <script>
        var minDate, maxDate;
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[6] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            var table = $('.table').DataTable({
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

            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
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
                    title: "Apakah Kamu yakin Untuk Membeli Paket Data?",
                    text: "",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Beli Sekarang!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({ //line 28
                            type: 'POST',
                            url: '{{ url("/paket-data-post") }}',
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
