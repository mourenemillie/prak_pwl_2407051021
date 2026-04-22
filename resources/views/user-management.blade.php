@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0 fw-bold text-dark">User Management</h2>
        <p class="text-muted mb-0">Ini adalah halaman user management untuk mengelola data pengguna.</p>
    </div>
    <a class="btn btn-primary shadow-sm px-4" href="{{ route('user-management.create') }}">
        <i class="bi bi-person-plus me-1"></i> Tambah User
    </a>
</div>

<div class="card shadow">
    <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary">Daftar User</h6>
        <form action="{{ route('user-management.index') }}" method="GET" class="d-flex">
            <div class="input-group input-group-sm" style="width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama / NPM / Kelas..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
                @if(!empty($search))
                    <a href="{{ route('user-management.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-circle"></i></a>
                @endif
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="32%">ID (UUID)</th>
                        <th>Nama Lengkap</th>
                        <th>NPM</th>
                        <th>Kelas</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-muted small ps-3"><code class="text-secondary">{{ $user->id }}</code></td>
                            <td class="fw-semibold text-dark">{{ $user->name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $user->npm }}</span></td>
                            <td class="text-center"><span class="badge bg-info text-dark shadow-sm">{{ $user->nama_kelas }}</span></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-warning mb-1 me-1 px-3 shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $user->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <form action="{{ route('user-management.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mb-1 btn-delete shadow-sm" type="button">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <div class="mb-2"><i class="bi bi-inbox fs-1 text-secondary"></i></div>
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        <div class="d-flex justify-content-end m-0">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@foreach ($users as $user)
<!-- Modal -->
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning">
                <h5 class="modal-title fw-bold text-dark" id="editModalLabel{{ $user->id }}">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user-management.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="npm" class="form-label fw-semibold">NPM</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-credit-card-2-front"></i></span>
                            <input type="text" class="form-control" id="npm" name="npm" value="{{ $user->npm }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label fw-semibold">Kelas</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                            <select class="form-select" id="kelas_id" name="kelas_id" required>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $user->kelas_id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal px-4">Batal</button>
                    <button type="submit" class="btn btn-warning text-dark fw-bold px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus Data!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    });
</script>
@endsection
