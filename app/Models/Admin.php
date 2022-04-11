<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles_name','status','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getStatusAttribute($value){
      return  $value==0 ? 'Absent':'Active';
    }

    public function setStatusAttribute($value)
    {
       return  $this->attributes['status'] = $value;
    }

    public function setPasswordAttribute($password){
        if(!empty($password))
            //return  $this->attributes['password'] = bcrypt($password);

        return  $this->attributes['password'] = Crypt::encryptString($password);
    }

    public function getPasswordAttribute($password){
        try{
            return  Crypt::decryptString($password);
        }catch(\Exception $ex){
            return $password;
        }

    }


    public static function sendPasswordEmail($user)
    {

        // Send email
        Mail::send('dashboard.mails.password', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Password');
        });
    }

}
