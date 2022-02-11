@extends('layouts.app')

@push('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
@endpush

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Data Riwayat Saldo Outlet</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="flex justify-content-center">
                            <div class="col-4">
                                <label for="filter">Filer By:</label>
                            </div>
                            <div class="col">
                                <select name="filter" id="filter" class="form-control">
                                    <option {{ $type==0?'selected':'' }} value="0">Semua</option>
                                    <option {{ $type==1?'selected':'' }} value="1">Bulan ini</option>
                                    <option {{ $type==2?'selected':'' }} value="2">Minggu ini</option>
                                    <option {{ $type==3?'selected':'' }} value="3" disabled>Custom</option>
                                </select>
                            </div>
                            <form action="{{ route('operator.riwayat.filter') }}" method="POST" class="ml-3 d-flex mt-3">
                                @csrf
                                <div class="">
                                    <label for="from">From:</label>
                                    <input type="date" name="from" class="form-control" value="{{ !empty($from)?$from:'' }}">
                                </div>
                                <div class="">
                                    <label for="to">To:</label>
                                    <input type="date" name="to" class="form-control" value="{{ !empty($to)?$to:'' }}">
                                </div>
                                <div class="mt-1">
                                    <button type="submit" class="btn btn-primary mt-4">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-light table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Saldo Saat Ini</th>
                                        <th>Total Isi Ulang</th>
                                        <th>Total Top Up</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $item)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ __('Rp.').number_format($item->saldo,2,',','.') }}</td>
                                            @if ($type==3)
                                            <td>{{ $item->saldoR->count() }} x</td>
                                            <td>{{ __('Rp.').number_format($item->saldoR->sum('saldoPlus'),2,',','.') }}</td>
                                            @else
                                            <td>{{ $type==0?$item->saldoR->count():($type==1?$item->saldoByMonth->count():$item->saldoByWeek->count()) }} x</td>
                                            <td>{{ __('Rp.').number_format($type==0?$item->saldoR->sum('saldoPlus'):($type==1?$item->saldoByMonth->sum('saldoPlus'):$item->saldoByWeek->sum('saldoPlus')),2,',','.') }}</td>
                                            @endif
                                            <td>
                                                <form action="{{ route('operator.updateStatusUser',$item) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" onchange="submit()" id="status" class="form-control border {{ $item->status=='active'?'border-success':'border-danger' }}">
                                                        <option {{ $item->status=='active'?'selected':'' }} value="active">Aktif</option>
                                                        <option {{ $item->status=='non-active'?'selected':'' }} value="non-active">Non Aktif</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('operator.riwayat.edit',$item->id) }}" class="btn btn-sm btn-primary mb-1 mr-1" onclick="return confirm('Apakah Anda Yakin Ingin Melihat Data Ini?')">Lihat</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="6" class="text-danger text-center">Data Kosong!</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
        $('#filter').change(function (e) {
            e.preventDefault();
            var val = $(this).val();
            window.location.href = "{{ url('operator/data-riwayat-isi-saldo') }}" + "/" + val;
        });

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
