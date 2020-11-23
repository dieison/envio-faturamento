<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type_user',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsuarios(){
        return User::select('users.name','users.id','users.email','user_type.tipo')
        ->join('user_type','user_type.id','=','users.type_user')
        ->get();
    }

    public static function getUsuarioById($id){
        return User::select('users.name','users.id','users.email','users.type_user')
        ->join('user_type','user_type.id','=','users.type_user')
        ->where('users.id',$id)
        ->first();
    }

    public static function updateUsuario($dados,$id){
        if ($dados['password'] == null) {
            unset($dados['password']);
        } else {
            $dados['password'] = Hash::make($dados['password']);
        }
        return User::where('id',$id)
        ->update($dados);
    }

    public static function deleteUsuario($id){
        return User::where('id',$id)
        ->delete();
    }
}
