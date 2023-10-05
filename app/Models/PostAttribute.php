<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'type',
        'possible_values',
        'mandatory'
    ];

    protected $casts = [
        'possible_values' => 'array'
    ];

    public static $_UNIT_MM = 1;
    public static $_UNIT_CM = 2;
    public static $_UNIT_M = 3;
    public static $_UNIT_M2 = 4;
    public static $_UNIT_M3 = 5;
    public static $_UNIT_KG = 6;

    public static $_TYPE_TEXT = 1;
    public static $_TYPE_CHECKBOX = 2;
    public static $_TYPE_RADIO = 3;
    public static $_TYPE_SELECT = 4;

    public static function getUnits(){
        return [
            self::$_UNIT_MM => 'mm',
            self::$_UNIT_CM => 'cm',
            self::$_UNIT_M => 'm',
            self::$_UNIT_M2 => 'm2',
            self::$_UNIT_M3 => 'm3',
            self::$_UNIT_KG => 'kg',
        ];
    }

    public static function getTypes(){
        return [
            self::$_TYPE_TEXT => 'text',
            self::$_TYPE_CHECKBOX => 'checkbox',
            self::$_TYPE_RADIO => 'radio',
            self::$_TYPE_SELECT => 'select',
        ];
    }

    public function getUnit(){
        return self::getUnits()[$this->unit];
    }

    public function getType(){
        return self::getTypes()[$this->type];
    }
}
