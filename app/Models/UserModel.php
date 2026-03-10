<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $gurded = ['id'];
    public function kelas()
    {
        return $this -> belongsTo (kelas::class, 'kelas_id');
    }
}
