<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- CSS Bootstrap untuk UI kece dan rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-top: 50px;
        }
        .table th {
            background-color: #11919d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-box">
            <h2 class="mb-4 text-center" style="color: #11919d;">User Management</h2>
            
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('user-management.create') }}" class="btn btn-primary">+ Tambah Data</a>
                
                <form action="{{ route('user-management.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari Nama atau NPM..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('user-management.index') }}" class="btn btn-outline-danger ms-2">Reset</a>
                    @endif
                </form>
            </div>

            <table class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Kelas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                        <tr>
                            <td class="text-center">{{ $users->firstItem() + $key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->npm }}</td>
                            <td>{{ $user->kelas->nama_kelas ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-info btn-sm text-white">Edit</a>
                                <form action="{{ route('user-management.destroy', $user->id) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dihapus tidak dapat direstore!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
