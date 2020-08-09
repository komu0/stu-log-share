<?php

namespace App;

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
        'id', 'password', 'profile',
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
    
    public function studyTime()
    {
        $stulogs = $this->stulogs;
        $studyTimeH = 0;
        $studyTimeM = 0;
        foreach ($stulogs as $stulog){
            $studyTimeH += $stulog->study_time_H();
            $studyTimeM += $stulog->study_time_M();
        }
        //繰り上がり処理
        $studyTimeH += intdiv($studyTimeM, 60);
        $studyTimeM %= 60;
        $studyTime = $studyTimeH . '時間' . $studyTimeM . '分';
        return $studyTime;
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
        return $this->hasMany(Tag::class);
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}