<?php
class Consts
{
    const YOYAKU_STOP  = 0;
    const YOYAKU_START = 1;
    const NO           = 0;
    const YES          = 1;
    const MAILUNSEND   = 0;
    const MAILSEND     = 1;
    const MAILERROR    = 9;
    const ACTIVE       = 1;
    const NOACTIVE     = 0;
    const NOLOCK          = 0;
    const LOCKED          = 1;
    const LOCKED_COUNT    = 5;
    const NOTACCEPT    = 0;
    const REGISTED     = 1;
    const NOTREGISTED  = 0;
    const ACCEPT       = 2;
    const CANCEL       = 9;
    const INACTIVE     = 0;
    const OFFSET       = 0;
    const PAGING       = 10;
    const ATTRIBUTE_MAX_COUNT = 10;
    const NODATA       = 0;
    const BIGINT_VALUE = 18446744073709551615;
    const RESERVE_BEFORE_OPEN = 0;
    const RESERVE_BEFORE_CLOSE = 1;
    
    const DEFAULT_NUMBER = 9999999;
    
    const TYPE_SUPER_USER = 0;
    const TYPE_ADMIN      = 1;
    const TYPE_STAFF      = 2;
    
     //DB 削除フラグ
    const DELETED      = 1;
    const UNDELETED    = 0;
    const MAXLOOP      = 100;
    const ALL          = 9999999;
    const AMPM         = 1;
    const AMTIME       = '0900';
    const PMTIME       = '1300';
    const AMTYPE       = 'A';
    const PMTYPE       = 'P';
    const MAILSENDTIME = 30;
    const MARGIN       = 5;
    const BANNERMODULE = '+7AgxP';
    const NOLOGINED_USER_ID = 'nologin_user';
    const JSON_SUCCESS = 0;
    
    const INFOTITLE    = 'まもなく診療時間です';
    const INFOMESSAGE  = "現在の受付番号は%Y%です。\nあなたの番号は%N%です。\n気を付けてお越しください。";
    const ADMINUSER    = 'kumagai@love.email.ne.jp';
    
    static public $genders     = array(1 => '男性', 2 => '女性');
    static public $genders2    = array(0 => '男女', 1 => '男性', 2 => '女性');
    static public $week        = array(0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土');
    static public $month       = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12);
    static public $mode        = array(0 => 'フリープラン', 1 => 'ライトプラン', 2 => 'ベーシックプラン', 3 => 'プラチナプラン');
    
    static public $billing      = array("1" => '個人', "2" => '会社');
    
    //予約ステータス
    static public $reservationStatus    = array(0 => '未受付', 1 => '保留', 2 => '受付', 9 => 'キャンセル');
    //
    static public $interviewStatus = array("0" => '未記載', "1" => '回答済');
    static public $yoyakuStart = array(
            5   => '5分',
            10  => '10分',
            15  => '15分',
            20  => '20分',
            25  => '25分',
            30  => '30分',
            35  => '35分',
            40  => '40分',
            45  => '45分',
            50  => '50分',
            55  => '55分',
            60  => '1時間',
            120 => '2時間',
            180 => '3時間',
            360 => '6時間',
            540 => '9時間'
        );
    
    static public $yoyakuEnd = array(
            5   => '5分',
            10  => '10分',
            15  => '15分',
            20  => '20分',
            25  => '25分',
            30  => '30分',
            35  => '35分',
            40  => '40分',
            45  => '45分',
            50  => '50分',
            55  => '55分',
            60  => '1時間',
            120 => '2時間',
            180 => '3時間'
        );
    
    static public $unit     = array(1 => '午前/午後', 15 => '15分単位', 20 => '20分単位', 30 => '30分単位', 60 => '60分単位');
    static public $endType = array(0 => '時間帯開始', 1 => '時間帯終了');
    static public $yoyaku   = array(1 => '予約受付', 0 => '予約停止');
    static public $inquiryType   = array(1 => '単選', 2 => '複選');

    public static function checkAmtime($i) {
        $times = Consts::getAmtimes();
        if(is_numeric($i) && in_array(i, $times)) {
            return floor($i);
        } else {
            return 0;
        }
    }
    
    public static function getAmtimes() {
        return array(6, 7, 8, 9, 10, 11, 12, 13, 14);
    }
    
    public static function checkPmtime($i) {
        $times = Consts::getPmtimes();
        if(is_numeric($i) && in_array(i, $times)) {
            return floor($i);
        } else {
            return 0;
        }
    }
    
    public static function getPmtimes() {
        return array(12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23);
    }
    
    public static function checkYoyakuTime($i) {
        $times = Consts::getYoyakuTimes();
        if(is_numeric($i) && in_array(i, $times)) {
            return floor($i);
        } else {
            return 0;
        }
    }
    
    public static function getYoyakuTimes() {
        return array(0, 10, 15, 20, 30, 40, 45, 50);
    }
    
    

}
