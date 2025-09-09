<?php

namespace App;

use App\Notifications\UserResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Entrust;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admission_staff_no', 'passrec', 'status', 'image',
        'mime', 'phone',  'gender', 'faculty_id', 'course_id', 'year'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $dates = ['created_at', 'updated_at'];



    public function client()
    {
        return $this->hasMany(ClientDetails::class, 'user_id');
    }

    public function employee()
    {
        return $this->hasMany(EmployeeDetails::class, 'user_id');
    }

    public static function allClients()
    {
        return User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->where('roles.name', 'student')
            ->get();
    }

    public static function allEmployees($exceptId = NULL)
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->where('roles.name', 'supervisor');

        if(!is_null($exceptId)){
            $users->where('users.id', '<>', $exceptId);
        }

        return $users->get();
    }
    public static function superVisorAndCoordinator($exceptId = NULL)
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->where('roles.name', 'supervisor');

        if(!is_null($exceptId)){
            $users->where('users.id', '<>', $exceptId);
        }

        return $users->get();
    }

    public static function allAdmins($exceptId = NULL)
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->where('roles.name', 'coordinator');

        if(!is_null($exceptId)){
            $users->where('users.id', '<>', $exceptId);
        }

        return $users->get();
    }

    public static function userListLatest($userID,$term)
    {

        if($term)
        {
                $termCnd = "and users.name like '%$term%'";
        }
        else {
                $termCnd = '';
        }
        
        $query =   DB::select("SELECT * FROM ( SELECT * FROM (
                    SELECT users.id,'0' AS groupId, users.name,  users.image,  users_chat.created_at as last_message, users_chat.message, users_chat.message_seen, users_chat.user_one
                    FROM users
                    INNER JOIN users_chat ON users_chat.from = users.id
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON roles.id = role_user.role_id
                    WHERE users_chat.to = $userID and roles.name = 'supervisor' or roles.name='student' $termCnd
                    UNION
                    SELECT users.id,'0' AS groupId, users.name,users.image, users_chat.created_at  as last_message, users_chat.message, users_chat.message_seen, users_chat.user_one
                    FROM users
                    INNER JOIN users_chat ON users_chat.to = users.id
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON roles.id = role_user.role_id
                    WHERE users_chat.from = $userID and roles.name = 'supervisor' or roles.name='student'$termCnd
                    ) AS allUsers
                    ORDER BY  last_message DESC
                    ) AS allUsersSorted
                    GROUP BY id
                    ORDER BY  last_message DESC");

        return $query;
    }
    public static function studentListLatest($userID,$term)
    {

        if($term)
        {
            $termCnd = "and users.name like '%$term%'";
        }
        else {
            $termCnd = '';
        }

        $query =   DB::select("SELECT * FROM ( SELECT * FROM (
                    SELECT users.id,'0' AS groupId, users.name,  users.image,  users_chat.created_at as last_message, users_chat.message, users_chat.message_seen, users_chat.user_one
                    FROM users
                    INNER JOIN users_chat ON users_chat.from = users.id
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON roles.id = role_user.role_id
                    WHERE users_chat.to = $userID and roles.name = 'supervisor' $termCnd
                    UNION
                    SELECT users.id,'0' AS groupId, users.name,users.image, users_chat.created_at  as last_message, users_chat.message, users_chat.message_seen, users_chat.user_one
                    FROM users
                    INNER JOIN users_chat ON users_chat.to = users.id
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON roles.id = role_user.role_id
                    WHERE users_chat.from = $userID and roles.name = 'supervisor'  $termCnd
                    ) AS allUsers
                    ORDER BY  last_message DESC
                    ) AS allUsersSorted
                    GROUP BY id
                    ORDER BY  last_message DESC");

        return $query;
    }
    public function course(){
        return $this->belongsTo('App\Course', 'course_id','id');
    }
    public function supervisor(){
        return $this->hasOne(Supervisor::class);
    }
    public function student(){
        return $this->hasOne(Student::class);
    }
    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }
    public function areas(){
        return $this->hasMany(Area::class);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

}