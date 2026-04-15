<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'user';
    protected $guarded = ['id'];
    protected $keyType = 'string';
    public $incrementing = false;
    public function kelas()
    {
        return $this -> belongsTo (kelas::class, 'kelas_id');
    }
}
