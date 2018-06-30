<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    	'components/quantity/add/',
    	'commission/add/',
        '/return',
	'/mapping/edit/save',
	'/mapping/remove/save',
	'/components/create-save',
	'/products/create-save',
	'/mapping/add/save',
	'/delete/*',
	'components/quantity'
    ];
}
