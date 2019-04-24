<?php
/**
 * Created by PhpStorm.
 * User: Grega
 * Date: 20. 01. 2019
 * Time: 20:20
 */

namespace App\Inspections;


class KeyHeldDown
{
    public function detect($body)
    {
        if(preg_match('/(.)\\1{4,}/', $body)) {
            throw new \Exception('Your reply contains spam');
        }
    }
}