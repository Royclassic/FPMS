<?php

namespace App\Http\Controllers\Student;

use App\Notification;
use App\ProjectActivity;
use App\Setting;
use App\StickyNote;
use App\UserActivity;
use App\UserChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ThemeSetting;
use Illuminate\Support\Facades\App;

class StudentBaseController extends Controller
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    /**
     * UserBaseController constructor.
     */
    public function __construct()
    {
        // Inject currently logged in user object into every view of user dashboard

        $this->global = Setting::first();
        $this->companyName = $this->global->company_name;
        $this->clientTheme = ThemeSetting::where('panel', 'client')->first();


        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->notifications = $this->user->notifications;
            $this->unreadProjectCount = Notification::where('notifiable_id', $this->user->id)
                                        ->where(function($query){
                                            $query->where('type', 'App\Notifications\TimerStarted');
                                            $query->orWhere('type', 'App\Notifications\NewProjectMember');
                                        })
                                        ->whereNull('read_at')
                                        ->count();
            $this->unreadMessageCount = UserChat::where('to', $this->user->id)->where('message_seen', 'no')->count();

              $this->stickyNotes = StickyNote::where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->get();

            App::setLocale($this->user->locale);
            return $next($request);
        });

    }


}
