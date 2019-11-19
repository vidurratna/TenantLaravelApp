<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{

    protected $guarded = [];

    // is this the correct sub domain?
    public function route($name, $parameters = []) {
        return 'http://' . $this->subdomain . app('url')->route($name, $parameters, false);
    }
}
