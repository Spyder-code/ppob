@extends('layouts.frontend')
@section('title', 'History Transaksi')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center border-0 mt-2">
                    <h5 class="text-dark font-weight-bold display-4">Transaksi Saya</h5>
                    <div class="alert alrt-info">
                        <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                        <span class="alert-inner--text"><strong>Semua</strong> transaksi yang telah saya lakukan.</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
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
                                                <th scope="col">No.Hp/ID Pelanggan</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $price = 0;
                                            @endphp
                                            @foreach ($all as $key => $tipe)
                                                @foreach ($tipe as $item)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>{{ $key==0?'PLN PRABAYAR':($key==1?'Pulsa':'Paket Data') }}</td>
                                                    <td>{{ $key==0? $item->customer->id_pelanggan:$item->nomor_hp }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('Y/m/d', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                    $price = $price + $item->price;
                                                @endphp
                                                @endforeach
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
                                                <th scope="col">No.Hp/ID Pelanggan</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $price_month = 0;
                                            @endphp
                                            @foreach ($month as $key => $tipe)
                                                @foreach ($tipe as $item)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>{{ $key==0?'PLN PRABAYAR':($key==1?'Pulsa':'Paket Data') }}</td>
                                                    <td>{{ $key==0? $item->customer->id_pelanggan:$item->nomor_hp }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('Y/m/d', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                    $price_month = $price_month + $item->price;
                                                @endphp
                                                @endforeach
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
                                                <th scope="col">No.Hp/ID Pelanggan</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $price_week = 0;
                                            @endphp
                                            @foreach ($week as $key => $tipe)
                                                @foreach ($tipe as $item)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>{{ $key==0?'PLN PRABAYAR':($key==1?'Pulsa':'Paket Data') }}</td>
                                                    <td>{{ $key==0? $item->customer->id_pelanggan:$item->nomor_hp }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ date('Y/m/d', strtotime($item->created_at)) }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                    $price_week = $price_week + $item->price;
                                                @endphp
                                                @endforeach
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
                var date = new Date( data[4] );

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
@endsection
