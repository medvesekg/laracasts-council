<?php
/**
 * Created by PhpStorm.
 * User: Grega
 * Date: 20. 01. 2019
 * Time: 20:00
 */

namespace App\Inspections;


class Spam
{

    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function detect($body)
    {
        foreach($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }
        return false;
    }

}