<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Parente;
use App\Http\Requests\ParentRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;






class MultiStepForm extends Component
{
    use RegistersUsers;

    

    //use WithFileUploads;

    public $nomPere;
    public $prenomPere;
    public $professionPere;
    public $telPere;
    public $nomMere;
    public $prenomMere;
    public $professionMere;
    public $telMere;
    public $nbEnfants;
    public $adresse;
    public $email;
    public $password;
    public $nomEleve;
    public $prenomEleve;
    public $niveau;
    public $terms;
    public $gender;
    //public $frameworks = [];

    public $totalSteps = 5;
    public $currentStep = 1;


    public function mount(){
       
        $this->currentStep = 1;
    }


    public function render()
    {
      
        return view('livewire.multi-step-form');
        
    }

    public function gotonext(){
        $this->resetErrorBag();
        $this->validateData();
         $this->currentStep++;
         if($this->currentStep > $this->totalSteps){
             $this->currentStep = $this->totalSteps;
         }
    }

    public function back(){
        $this->resetErrorBag();
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function validateData(){

        if($this->currentStep == 1){
            $this->validate([
                'nomPere'=>array(
                    'required',
                    'string',
                    'regex:/^[A-Za-z]+$/'
                ),
                
                'prenomPere'=>array(
                    'required',
                    'string',
                    'regex:/^[A-Za-z]+$/'
                ),
                'telPere'=>array(
                    'required',
                    
                ),
                'professionPere'=>array(
                    'required',
                    'string',
                    'regex:/^[A-Za-z]+$/'
                ),
            ]);
        }
        elseif($this->currentStep == 2){
              $this->validate([
                 'nomMere'=>array(
                    'required',
                    'string',
                    'regex:/^[A-Za-z]+$/'
                ),
                 'prenomMere'=>array(
                    'required',
                    'string',
                    'regex:/^[A-Za-z]+$/'
                ),
                 'telMere'=>'required',
                 'professionMere'=>array(
                    'required',
                    'string',
                    'regex:/^[A-Za-z]+$/'
                ),
              ]);
        }
        elseif($this->currentStep == 3){
            $this->validate([
                'nbEnfants'=>array(
                    'required',
                    'numeric',
                    'regex:/^(0|[1-9][0-9]*)$/'

                ),
                'adresse'=>'required|string',
                'email'=>'required|regex:/(.+)@(.+)\.com/i',
                'password'=>'required',
             ]);
        }
        elseif($this->currentStep == 4){
            $this->validate([
                'nomEleve'=>'required',
                'prenomEleve'=>'required|string',
                'niveau'=>'required',
                'gender'=>'required|string',
             ]);
        }
        
    }
public function rania(){
    return ('rania');
}
    public function register(){
           
        $this->resetErrorBag();
          if($this->currentStep == 5){
            $this->rania();
        }

        $parent = Parente::create([
                "nomPere"=>$this->nomPere,
                "prenomPere"=>$this->prenomPere,
                "professionPere"=>$this->professionPere,
                "telPere"=>$this->telPere,
                "nomMere"=>$this->nomMere,
                "prenomMere"=>$this->prenomMere,
                "professionMere"=>$this->professionMere,
                "telMere"=>$this->telMere,
                "nbEnfants"=>$this->nbEnfants,
                "adresse"=>$this->adresse,
                "email"=>$this->email,
                'password' => Hash::make($this->password),

              ]);
              

              $student = Student::create([
                  "nomEleve"=>$this->nomEleve,
                  "prenomEleve"=>$this->prenomEleve,
                  "niveau"=>$this->niveau,
                  "gender"=>($this->gender =='garcon')? 1:0,
                  "parent_id"=>$parent->id,

              ]);
              //dd($student);
               //$this->reset();
               //$this->currentStep = 1;
            //$data = ['name'=>$this->first_name.' '.$this->last_name,'email'=>$this->email];
            //return redirect()->route('registration.success', $data);
            return redirect()->back();
          
    }
}


