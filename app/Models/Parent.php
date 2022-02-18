<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Parent extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table='pareents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nomPere', 'prenomPere', 'telPere',
        'professionPere','nomMere','prenomMere','telMere',
        'professionMere','nbEnfants','email','password',
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

    public function student(){
        return $this->hasMany(Student::class, 'student_id', 'id');
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

}
