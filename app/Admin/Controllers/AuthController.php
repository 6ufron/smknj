<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    /**
     * Override method getLogin jika ingin kustomisasi halaman login.
     */
    public function getLogin()
    {
        // Contoh: Tambahkan logika khusus sebelum menampilkan form login
        // Misalnya redirect jika sudah login
        if (auth('admin')->check()) {
            return redirect(admin_url('/'));
        }

        return parent::getLogin();
    }

    /**
     * Override method postLogin jika ingin validasi tambahan saat login.
     */
    public function postLogin(\Illuminate\Http\Request $request)
    {
        // Tambahkan validasi custom di sini jika perlu
        return parent::postLogin($request);
    }

    /**
     * Override method getLogout jika ingin ubah perilaku logout.
     */
    public function getLogout(\Illuminate\Http\Request $request)
    {
        auth('admin')->logout();
        return redirect(admin_url('auth/login'));
    }
}
