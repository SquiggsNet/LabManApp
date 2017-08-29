<?php

namespace App;

//use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class Mouse extends Model
{
    protected $fillable = array('colony_id', 'reserved_for', 'source', 'sex', 'geno_type_a', 'geno_type_b', 'father', 'mother_one',
                                'mother_two', 'mother_three', 'birth_date', 'wean_date', 'end_date', 'is_alive', 'sick_report');

    public function genoFormat($geno_a, $geno_b){

        if(is_null($geno_a) and is_null($geno_b)){
            return 'N/A';
        }
        if($geno_a == 1 and $geno_b == 1){
            return '(+/+)';
        }elseif($geno_a == 1 and $geno_b == 0){
            return '(+/-)';
        }elseif($geno_a == 0 and $geno_b == 0){
            return '(-/-)';
        }
    }

    public function getGeno($geno){
        if($geno == 'True' || $geno == '1'){
            return '+';
        }else{
            return '-';
        }
    }

    public function getGender($sex){
        if($sex == 'True' || $sex == '1'){
            return 'Male';
        }elseif($sex == 'False' || $sex == '0'){
            return 'Female';
        }else{
            return 'N/A';
        }
    }

    public function  tagPad($tag_num){
        $tagNum = str_pad($tag_num, 3, '00', STR_PAD_LEFT);
        return $tagNum;
    }

    public function getAge($birth_date){
        date_default_timezone_set('America/Edmonton');
        $DOB = new DateTime($birth_date);
        $today = new DateTime();
        $diff_in_wks = $DOB->diff($today)->days/7;
        $age_in_wks = round($diff_in_wks, 1 , PHP_ROUND_HALF_UP);
        if($age_in_wks == 1){
            $weeks = 'week';
        }else{
            $weeks = 'weeks';
        }

        $age_display = $age_in_wks . ' ' . $weeks;
        return $age_display;
    }

    public function showDate($date_in){

        if(! empty($date_in)) {
            date_default_timezone_set('America/Edmonton');
            $date = new DateTime($date_in);
            $long_date = date_format($date, 'M d, Y');
            return $long_date;
        }else{
            return $date_in;
        }
    }

    public function getUserName($user_id){
        $user = User::where('id', $user_id)->get()->first();
        $fullName = $user->first_name . " " . $user->last_name;
        return $fullName;
    }

    //one-to-many relationships
    //Blood pressure
    public function blood_pressures(){
        return $this->hasMany(BloodPressure::class);
    }

    //Treatment
    public function treatments(){
        return $this->belongsToMany(Treatment::class)->withPivot('dosage');
    }

    public function experiments(){
        return $this->belongsToMany(Experiment::class);
    }

    //Weight
    public function weights(){
        return $this->hasMany(Weight::class);
    }

    //Cage
    public function cages(){
        return $this->belongsTo(Cage::class);
    }

    public function maleCage(){
        return $this->belongsTo(Cage::class, 'male');
    }

    public function femaleOneCage(){
        return $this->belongsTo(Cage::class, 'female_one');
    }

    public function femaleTwoCage(){
        return $this->belongsTo(Cage::class, 'female_two');
    }

    public function femaleThreeCage(){
        return $this->belongsTo(Cage::class, 'female_three');
    }

    //Colony
    public function colony(){
        return $this->belongsTo(Colony::class);
    }

    //User
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //many-to-many relationships
    //Surgery
    public function surgeries(){
        return $this->belongsToMany(Surgery::class);
    }

    //Tag
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

//    //Storage
//    public function storages(){
//        return $this->belongsToMany(Storage::class);
//    }

    //Storage
    public function boxes(){
        return $this->belongsToMany(Box::class);
    }

    //recursive relationships
    public function father_record(){
        return $this->belongsTo(Mouse::class, 'father');
    }

    public function mother_one_record(){
        return $this->belongsTo(Mouse::class, 'mother_one');
    }

    public function mother_two_record(){
        return $this->belongsTo(Mouse::class, 'mother_two');
    }

    public function mother_three_record(){
        return $this->belongsTo(Mouse::class, 'mother_three');
    }

    public function offspring(){
        return $this->hasMany(Mouse::class);
    }
}
