<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;

class UserManagementController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        
        $query = UserModel::with('kelas');
        if (!empty($search)) {
            $query->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('npm', 'ILIKE', "%{$search}%");
        }
        
        $users = $query->paginate(10);
        return view('user-management.index', compact('users', 'search'));
    }

    public function create() {
        $kelases = Kelas::all();
        return view('user-management.create', compact('kelases'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:15',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        UserModel::create([
            'name' => $request->name,
            'npm' => $request->npm,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect('/user-management')->with('success', 'Data user berhasil ditambahkan!');
    }

    public function edit($id) {
        $user = UserModel::findOrFail($id);
        $kelases = Kelas::all();
        return view('user-management.edit', compact('user', 'kelases'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:15',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'npm' => $request->npm,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect('/user-management')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id) {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect('/user-management')->with('success', 'Data user dengan nama ' . $user->name . ' berhasil terhapus!');
    }
}
