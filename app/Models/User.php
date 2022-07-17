<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

// use facades here
use Carbon\Carbon;


class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'username', 
        'email', 
        'date_of_birth', 
        'gender', 
        'placement', 
        'country', 
        'city', 
        'state', 
        'zip_code', 
        'address', 
        'phone_number', 
        'cnic', 
        'payment_process', 
        'sponser_id', 
        'mother_name', 
        'favourite_pet', 
        'password',  
        'account_type',  
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

    // protected $appends = ['saved', 'shortListed', 'applied'];

    // public function getSavedAttribute(){
    //     return $this->isSavedListed()
    // }

    public function get_name(){
        if(!empty($this->first_name) && !empty($this->last_name)){
            return $this->first_name.' '.$this->last_name;
        }else{
            return "Guest User";
        }
    }

   

    public function saved_jobs()
    {
        return $this->belongsToMany(Job::class, 'saved_jobs', 'user_id', 'job_id');
    }

    public function applied_jobs()
    {
        return $this->belongsToMany(Job::class, 'employee_applied_jobs', 'user_id', 'job_id');
    }

    public function get_jobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'id');
    }

    public function get_experiences()
    {
        return $this->hasMany(EmployeeExperience::class, 'user_id', 'id');
    }

    public function account_bal()
    {
        return $this->hasOne(AccountType::class, 'id', 'account_type');
    }



    public function get_notification()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id')->where('read_at', null)->orderBy('created_at', 'desc');
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'state_id', 'id');
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_name', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'id');
    }
    
    public function jobAppliedEmployee()
    {
        // return $this->jobs->pluck('id');
        return EmployeeAppliedJob::whereIn('job_id', $this->jobs->pluck('id'))->count();
    }

    public function getLastMessage(){
        $conversation = Conversation::where([
            ['moderator_id', $user->id],
            ['participant_id', $participantId],
        ])->orWhere([
            ['moderator_id', $participantId],
            ['participant_id', $user->id],
        ])->first();

        $lastMessage = $this->messages->last() ? Str::limit($this->messages->last()->text, 12).'...' : '....';
        return [
            'text' => $lastMessage,
        ];
    }

    public function photos(){
        return $this->hasMany(Photo::class, 'parent_id', 'id')->where('parent_type', User::class);

    }

    public function get_image()
    {
        $image = !empty($this->photos->sortByDesc('created_at')->first());
        $image = $image ? $this->photos->sortByDesc('created_at')->first()->path : '';
        if(!empty($image) && file_exists(public_path().'/storage/'.$image)){
            return asset('public/storage/'.$image);
        }else{
            return asset('public/app-assets/images/portrait/small/avatar-s-19.png');
        }
    }
    

    public function getLastLogin(){
        return $this->last_login != null ? Carbon::parse($this->last_login)->diffForHumans() : 'N/A';
    }

    
    public function sponser()
    {
        return $this->hasMany(UserSponser::class, 'sponser_id', 'id');
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'sender_id', 'id');
    }
    
}