<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(){
        $users = [
            ['nama'=> 'Prinayani',
            'npm'=> '2407051010',
            'jurusan'=> 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen Informatika'
            ],
            ['nama'=> 'Farida',
            'npm'=> '2407051016',
            'jurusan'=> 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen informatika'
            ],
              ['nama'=> 'Mike',
            'npm'=> '2407051021',
            'jurusan'=> 'Ilmu Komputer',
            'prodi' => 'Sitem Informasi'
            ],
              ['nama'=> 'Cahyani',
            'npm'=> '2407051014',
            'jurusan'=> 'Ilmu Komputer',
            'prodi' => 'Sistem Informasi'
            ],
        ];
        return view('user-management', compact ('users'));
    }

}
