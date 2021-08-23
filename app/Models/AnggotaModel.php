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

    public static function getAnggota()
    {
        return RoleUser::join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'users.id', '=', 'role_user.user_id')
                ->select('users.*', 'roles.display_name')
                ->where('role_user.role_id', 3)
                ->paginate(10);
    }

    public static function getAnggotaPetugas($id)
    {
        return RoleUser::join('roles', 'roles.id', '=', 'role_user.role_id')
        ->join('users', 'users.id', '=', 'role_user.user_id')
        ->select('users.*', 'roles.display_name')
        ->where('role_user.role_id', 3)
        ->where('users.created_by', $id)
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

    public static function getJumlahAnggotaPetugas($id)
    {
        return RoleUser::select([
            DB::raw('count(users.id) as jml_anggota')
        ])
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->join('users', 'users.id', '=', 'role_user.user_id')
        ->where('role_user.role_id', 3)
        ->where('users.created_by', $id)
        ->first();
    }
}
