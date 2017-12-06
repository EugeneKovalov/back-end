<?php

namespace App\DB;

interface IConnection
{
    public function query($query);
    public function get();
}