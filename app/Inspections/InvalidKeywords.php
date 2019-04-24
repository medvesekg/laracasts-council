<?php
/**
 * Created by PhpStorm.
 * User: Grega
 * Date: 20. 01. 2019
 * Time: 20:17
 */

namespace App\Inspections;


class InvalidKeywords
{

    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        foreach($this->keywords as $keyword) {
            if(stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam');
            }
        }
    }
}