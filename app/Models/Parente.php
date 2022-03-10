<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPasswordNotification;



class Parente extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable;
    protected $table='parentes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nomPere', 'prenomPere', 'telPere',
        'professionPere','nomMere','prenomMere','telMere',
        'professionMere','nbEnfants','email','password','adresse',
        'is_active','created_at','deleted_at','updated_at',
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
 //each parent might have multiple students
    public function student(){
        return $this->hasMany(Student::class, 'parent_id', 'id');
    }

        /**
 * Send the email verification notification.
 *
 * @return void
 */
public function sendEmailVerificationNotification()
{
    $this->notify(new VerifyEmail); // my notification
}

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }



}
