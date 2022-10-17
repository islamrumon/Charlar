<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;


class Menus extends Model
{


    /**
     * @var string
     */
    protected $logChannel = 'jit-logger';

    protected $table = 'menus';

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = 'menus';
    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany(MenuItems::class, 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }
}
