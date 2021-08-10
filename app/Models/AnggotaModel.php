<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;

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

    public static function getListAnggota()
    {
        return RoleUser::select('users.*')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', 3)
                ->get();
    }

    public static function getJumlahAnggota()
    {
        return RoleUser::select([
                        DB::raw('count(users.id) as jml_anggota')])
                        ->join('roles', 'roles.id', '=', 'role_user.role_id')
                        ->join('users', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 3)
                        ->first();
    }
}
