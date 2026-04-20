<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    private $code = array(23, 25, 27, 29, 31, 33, 35);

    public static function getHashId(int $id): int{
        return ( ($id*$id) + 49 );
    }

    public static function getRevHashId( $id): int{
        return sqrt($id - 49);
    }

}
