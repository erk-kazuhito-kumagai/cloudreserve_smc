<?php

class PlanMatrix extends Phalcon\Mvc\User\Component
{

    public static function isCheckup($mode)
    {
        switch($mode) {
            case Consts::FreeMode:
                return true;
            case Consts::LiteMode:
                return false;
            case Consts::BasicMode:
                return false;
            case Consts::PlatinumMode:
                return true;
            default:
                return false;
        }
    }
    
    public static function isMailmaga($mode)
    {
        switch($mode) {
            case Consts::FreeMode:
                return true;
            case Consts::LiteMode:
                return false;
            case Consts::BasicMode:
                return false;
            case Consts::PlatinumMode:
                return true;
            default:
                return false;
        }
    }
    
    public static function isAddCategory($mode)
    {
        switch($mode) {
            case Consts::FreeMode:
                return true;
            case Consts::LiteMode:
                return false;
            case Consts::BasicMode:
                return true;
            case Consts::PlatinumMode:
                return true;
            default:
                return false;
        }
    }
    
    public static function isAttribute($mode)
    {
        switch($mode) {
            case Consts::FreeMode:
                return true;
            case Consts::LiteMode:
                return false;
            case Consts::BasicMode:
                return true;
            case Consts::PlatinumMode:
                return true;
            default:
                return false;
        }
    }
    
    public static function isAddUser($mode)
    {
        switch($mode) {
            case Consts::FreeMode:
                return true;
            case Consts::LiteMode:
                return false;
            case Consts::BasicMode:
                return false;
            case Consts::PlatinumMode:
                return true;
            default:
                return false;
        }
    }
}
