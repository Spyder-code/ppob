@extends('layouts.app')
@section('title', 'Riwayat Pengisian Saldo')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">{{ __('Detail '. $user->name) }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="row">
                                <h5 class="col-md-4 text-md-left">{{ __('Nama') }}</h5>

                                <div class="col-md-6">
                                    <p class="text-left">{{ $user->name }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="col-md-4 text-md-left">{{ __('Email') }}</h5>

                                <div class="col-md-6">
                                    <p class="text-left">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="col-md-4 text-md-left">{{ __('Jenis Kelamin') }}</h5>

                                <div class="col-md-6">
                                    @if ($user->gender != NULL)
                                    <p class="text-left">{{ $user->gender }}</p>
                                    @else
                                    <p class="text-left">Tidak Diketahui!</p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="col-md-4 text-md-left">{{ __('WhatsApp') }}</h5>

                                <div class="col-md-6">
                                    @if ($user->phone != NULL)
                                    <p class="text-left">{{ $user->phone }}</p>
                                    @else
                                    <p class="text-left">Tidak Diketahui!</p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="col-md-4 text-md-left">{{ __('Sisa Saldo') }}</h5>

                                <div class="col-md-6">
                                    <p class="text-left">{{ __('Rp.').number_format($user->saldo,2,',','.') }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="col-md-4 text-md-left">{{ __('Alamat') }}</h5>

                                <div class="col-md-6">
                                    @if ($user->address != NULL)
                                    <p class="text-left">{{ $user->address }}</p>
                                    @else
                                    <p class="text-left">Tidak Diketahui!</p>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Tabel Riwayat Pengisian Saldo '. $user->name) }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('operator.saldo.update', $user->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label for="saldo" class="col-md-4 col-form-label text-md-right">{{ __('Saldo') }}</label>

                                <div class="col-md-6">
                                    <input id="saldo" type="number" class="form-control" name="saldoPlus" min="0" value="{{ old('saldoPlus') }}" autocomplete="saldoPlus" autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Ingin Menambahkan Saldo?')">
                                        {{ __('Update') }}
                                    </button>
                                    <button type="reset" class="btn btn-default">
                                        {{ __('Reset') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
                                            <table class="table table-light table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Saldo Sebelum</th>
                                                        <th>Saldo Sesudah</th>
                                                        <th>Saldo Total</th>
                                                        <th>Tanggal</th>
                                                        {{-- <th>Aksi</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ __('Rp.').number_format($item->saldoAfter,2,',','.') }}</td>
                                                        <td>{{ __('Rp.').number_format($item->saldoPlus,2,',','.') }}</td>
                                                        <td>{{ __('Rp.').number_format($item->saldoNow,2,',','.') }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="1">{{ __('Total Transaksi :') }}</td>
                                                        <td colspan="1">{{ $all->count().__(' x') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="1">{{ __('Total Top Up :') }}</td>
                                                        <td colspan="1">{{ __('Rp.').number_format($all->sum('saldoPlush'),2,',','.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                                        <div class="table-responsive">
                                            <table class="table table-light table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Saldo Sebelum</th>
                                                        <th>Saldo Sesudah</th>
                                                        <th>Saldo Total</th>
                                                        <th>Tanggal</th>
                                                        {{-- <th>Aksi</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($month as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ __('Rp.').number_format($item->saldoAfter,2,',','.') }}</td>
                                                        <td>{{ __('Rp.').number_format($item->saldoPlus,2,',','.') }}</td>
                                                        <td>{{ __('Rp.').number_format($item->saldoNow,2,',','.') }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="1">{{ __('Total Transaksi :') }}</td>
                                                        <td colspan="1">{{ $month->count().__(' x') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="1">{{ __('Total Top Up :') }}</td>
                                                        <td colspan="1">{{ __('Rp.').number_format($month->sum('saldoPlush'),2,',','.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week-tab">
                                        <div class="table-responsive">
                                            <table class="table table-light table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Saldo Sebelum</th>
                                                        <th>Saldo Sesudah</th>
                                                        <th>Saldo Total</th>
                                                        <th>Tanggal</th>
                                                        {{-- <th>Aksi</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($week as $item)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ __('Rp.').number_format($item->saldoAfter,2,',','.') }}</td>
                                                        <td>{{ __('Rp.').number_format($item->saldoPlus,2,',','.') }}</td>
                                                        <td>{{ __('Rp.').number_format($item->saldoNow,2,',','.') }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="1">{{ __('Total Transaksi :') }}</td>
                                                        <td colspan="1">{{ $week->count() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="1">{{ __('Total Top Up :') }}</td>
                                                        <td colspan="1">{{ __('Rp.').number_format($week->sum('saldoPlush'),2,',','.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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
