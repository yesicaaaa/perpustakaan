<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;

class PetugasModel extends Model
{
    use HasFactory;
    protected $table = 'users';

    public static function getPetugas($cari = null) {
        return RoleUser::join('users', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.name', 'users.email', 'users.phone', 'users.id', 'users.alamat', 'roles.display_name', 'users.created_at', 'users.updated_at')
                ->where('role_user.role_id', '!=', 3)
                ->where('users.name', 'like', '%' . $cari . '%')
                ->paginate(10);
    }

    public static function getDetailPetugas($id)
    {
        return
        RoleUser::join('users', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->select('users.name', 'users.email', 'users.phone', 'users.is_active', 'users.image', 'users.id', 'users.alamat', 'roles.display_name', 'users.created_at', 'users.updated_at')
        ->where('role_user.role_id', '!=', 3)
        ->where('users.id', $id)
        ->first();
    }
}
