<?php

namespace App;
use App\Library\BaseClass;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $keyType = 'string';
    public $incrementing = false; 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'password', 'profile', 'image_path',
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
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['stulogs', 'followings', 'followers']);
    }
    
    public function stulogs()
    {
        return $this->hasMany(Stulog::class);
    }
    
    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_stulogs()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $followingIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $followingIds[] = $this->id;
        // このユーザがミュート中のユーザのidを取得して配列にする
        $mutingIds = $this->mutings()->pluck('users.id')->toArray();
        // followingIdsから重複を削除
        $userIds = array_diff($followingIds, $mutingIds);
        // それらのユーザが所有する投稿に絞り込む
        return Stulog::whereIn('user_id', $userIds);
    }
    
    
    //ミュート処理
    
    public function mutings()
    {
        return $this->belongsToMany(User::class, 'user_mute', 'user_id', 'mute_id')->withTimestamps();
    }
    
    public function mute($userId)
    {
        $exist = $this->is_muting($userId);
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->mutings()->attach($userId);
            return true;
        }
    }
    
    public function unmute($userId)
    {
        $exist = $this->is_muting($userId);
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            $this->mutings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    public function is_muting($userId)
    {
        return $this->mutings()->where('mute_id', $userId)->exists();
    }
    
    public function tags()
    {
        return $this->hasManyThrough(Tag::class, Category::class)->orderBy('tags.order');
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class)->orderBy('categories.order');
    }
    
    public function starting_study_day()
    {
        return $this->stulogs()->orderBy('log_date')->first()->log_date;
    }
    
    public function stulog_contents()
    {
        return $this->hasManyThrough(StulogContent::class, Stulog::class);
    }
    
    public function study_time()
    {
        return $this->stulog_contents()->sum('study_time');
    }
    
    public function display_study_time()
    {
        return BaseClass::time_double_to_japanese($this->study_time());
    }
    
    //dropdownのclassを返す
    public function can_change_categories_order()
    {
        if(count($this->categories)<=1) {
            return "disabled text-muted";
        }
        return "";
    }
    
    public function time_trans_array()
    {
        $firstLogDate = strToTime(date($this->stulogs()->orderBy('log_date')->first()->log_date));
        $startDate = strToTime('-1 day', $firstLogDate);
        $today = strToTime(date('Y-m-d'));
        $time_trans_array = [];
        $time = 0;
        for($date =$startDate; $date <= $today; $date = strToTime('+1 day', $date)){
            $display_date = date('Y年m月d日', $date);
            if($this->stulogs()->where('log_date', date('Y-m-d', $date))->exists()){
                $time += $this->stulogs()->where('log_date', date('Y-m-d',$date))->first()->study_time();
            }
            $time_trans_array[$display_date] = $time;
        }
        return $time_trans_array;
    }
    
    public function study_time_percentage_array()
    {
        $study_time_percentage_array = [];
        foreach ($this->categories as $category) {
            $study_time_percentage_array[$category->name] = $category->study_time_percentage();
        }
        return $study_time_percentage_array;
    }
}