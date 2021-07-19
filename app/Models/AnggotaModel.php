<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;

class AnggotaModel extends Model
{
    use HasFactory;
    protected $table = 'users';

    public static function getAnggota($cari = null)
    {
        return RoleUser::join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->select('users.*', 'roles.display_name')
                ->where('role_user.role_id', 3)
                ->where('users.name', 'like', '%' . $cari . '%')
                ->paginate(10);
    }

    public static function getDetailAnggota($id)
    {
        return RoleUser::join('roles', 'roles.id', '=', 'role_user.role_id')
        ->join('users', 'users.id', '=', 'role_user.user_id')
        ->select('users.*', 'roles.display_name')
        ->where('role_user.role_id', 3)
        ->where('users.id', $id)
        ->first();
    }
}
