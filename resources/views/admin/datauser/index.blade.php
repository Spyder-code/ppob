@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data User</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Saldo</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key)
                                        <tr>
                                            <th>{{ $loop->iteration + $users->firstItem() - 1 . '.' }}</th>
                                            <td>{{ $key->id }}</td>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->email }}</td>
                                            <td>{{ $key->phone }}</td>
                                            <td>{{ __('Rp.').number_format($key->saldo,2,',','.') }}</td>
                                            <td><span class="badge badge-danger">DILINDUNGI</span></td>
                                            <td>
                                                <form action="{{ route('admin.user.destroy', $key->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    @if ($key->phone != null)
                                                    <a href="https://wa.me/{{ $key->phone }}" target="_blank" class="btn btn-sm btn-success mb-1 mr-1" onclick="return confirm('Apakah Anda Yakin Ingin Menelpon?')">Hubungi</a>
                                                    @endif
                                                    <a href="{{ url('/admin/data-outlet/'.$key->id) }}" class="btn btn-sm btn-warning mb-1 mr-1" onclick="return confirm('Apakah Anda Yakin Ingin Melihat Data Ini?')">Lihat</a>
                                                    <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"
                                                        class="btn btn-sm btn-danger">Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="6" class="text-danger text-center">Data Kosong!</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection