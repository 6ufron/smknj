<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    // Kustomisasi tampilan halaman login
    public function getLogin()
    {
        if (auth('admin')->check()) {
            return redirect(admin_url('/'));
        }

        return parent::getLogin();
    }

    // Validasi tambahan saat login (opsional)
    public function postLogin(Request $request)
    {
        return parent::postLogin($request);
    }

    // Kustomisasi proses logout
    public function getLogout(Request $request)
    {
        auth('admin')->logout();
        return redirect(admin_url('auth/login'));
    }
}
