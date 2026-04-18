<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;

class UserManagementController extends Controller
{
    protected $userModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = UserModel::join('kelas', 'kelas.id', '=', 'user.kelas_id')
                          ->select('user.*', 'kelas.nama_kelas as nama_kelas');

        if (!empty($search)) {
            $query->where('user.name', 'LIKE', "%{$search}%")
                  ->orWhere('user.npm', 'LIKE', "%{$search}%")
                  ->orWhere('kelas.nama_kelas', 'LIKE', "%{$search}%");
        }
        
        $users = $query->paginate(5);
        $users->appends(['search' => $search]); // To maintain search string during pagination
        
        $kelas = $this->kelasModel->getKelas();

        return view('user-management', compact('users', 'search', 'kelas'));
    }

    public function create()
    {
        $kelas = $this->kelasModel->getKelas();
        return view('create-user', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        $this->userModel->create([
            'name' => $request->input('name'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);

        return redirect()->route('user-management.index')->with('success', 'Data user berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);

        return redirect()->route('user-management.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect()->route('user-management.index')->with('success', 'Data user berhasil dihapus!');
    }
}
