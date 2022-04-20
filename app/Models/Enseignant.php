<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class Enseignant extends Model
{
    use HasRoles;
    protected $guard_name = 'admin';

    protected $table='enseignants';


    protected $fillable = [
        'nom', 'prenom', 'telephone','adresse','gender','email',
        'password','date_naiss', 'date_embauche','ans_exp','annee_obt_diplome','specilaite',
        'role','etat_matrimonial','image','status','module_id'
    ];
    protected $hidden =[
        'password','created_at','deleted_at','updated_at',
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


    public static function sendPasswordEmail($enseignant)
    {

        // Send email
        Mail::send('dashboard.mails.password', ['user' => $enseignant], function ($m) use ($enseignant) {
            $m->to($enseignant->email, $enseignant->nom)->subject('Password');
        });
    }

    public function modules()
    {
        return $this->belongsToMany(\App\Models\Module::class);
    }
    public function sections()
    {
        return $this->hasMany(Enseignant_Module::class,'enseignant_id','id')->orderByDesc('Created_at');

    }


}
