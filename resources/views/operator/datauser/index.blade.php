@extends('layouts.app')
@section('title', 'Riwayat Transaksi Outlet '.($type==1?'Bulan ini': ($type==2?'Minggu ini':'')))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data Riwayat Outlet</div>

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
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Total Transaksi Pulsa</th>
                                        <th>Total Transaksi Paket Data</th>
                                        <th>Total Transaksi PLN</th>
                                        <th>Total Semua Transaksi</th>
                                        <th>Reward didapat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_transaksi_pulsa = 0;
                                        $total_transaksi_paket_data = 0;
                                        $total_transaksi_pln = 0;
                                        $total_semua_transaksi = 0;
                                        $total_reward = 0;
                                    @endphp
                                    @foreach ($data as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ __('Rp.').number_format($item->pulsa->sum('price'),2,',','.') }}</td>
                                        <td>{{ __('Rp.').number_format($item->paketData->sum('price'),2,',','.') }}</td>
                                        <td>{{ __('Rp.').number_format($item->pln->sum('price'),2,',','.') }}</td>
                                        <td>{{ __('Rp.').number_format(($item->pln->sum('price')+$item->pulsa->sum('price')+$item->paketData->sum('price')),2,',','.') }}</td>
                                        <td>Emas {{ $item->reward->sum('nominal') }} gram</td>
                                        <td>
                                            <form action="{{ route('operator.saldo.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('operator.transaction.history.outlet',$item->id) }}" class="btn btn-sm btn-warning mb-1 mr-1" onclick="return confirm('Apakah Anda Yakin Ingin Melihat Data Ini?')">Lihat</a>
                                                @if ($item->phone != NULL)
                                                <a href="https://wa.me/{{ $item->phone }}" target="_blank" class="btn btn-sm btn-success mb-1 mr-1" onclick="return confirm('Apakah Anda Yakin Ingin Menelpon?')">Hubungi</a>
                                                @endif
                                                {{-- <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"
                                                    class="btn btn-sm btn-danger">Hapus
                                                </button> --}}
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $total_transaksi_pulsa += $item->pulsa->sum('price');
                                        $total_transaksi_paket_data += $item->paketData->sum('price');
                                        $total_transaksi_pln += $item->pln->sum('price');
                                        $total_semua_transaksi += ($item->pln->sum('price')+$item->pulsa->sum('price')+$item->paketData->sum('price'));
                                        $total_reward += $item->reward->sum('nominal');
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" style="text-align:right">Total:</th>
                                        <th>{{ __('Rp.').number_format($total_transaksi_pulsa,2,',','.') }}</th>
                                        <th>{{ __('Rp.').number_format($total_transaksi_paket_data,2,',','.') }}</th>
                                        <th>{{ __('Rp.').number_format($total_transaksi_pln,2,',','.') }}</th>
                                        <th>{{ __('Rp.').number_format($total_semua_transaksi,2,',','.') }}</th>
                                        <th>Emas {{ $total_reward }} gram</th>
                                    </tr>
                                </tfoot>
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
<script>
    $('#filter').change(function (e) {
        e.preventDefault();
        var val = $(this).val();
        window.location.href = "{{ url('operator/riwayat-outlet/') }}" + "/" + val;
    });

    $(document).ready(function() {
            var table = $('.table').DataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 25,
                dom: 'Bfrtip',
                buttons:  [
                    {
                        extend: 'pdf', className: 'btn btn-success px-5', text: 'Print Data',exportOptions:
                    {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                    }
                ]
            });
        });
</script>
@endsection
