<?php

/**
 * Open-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * OpenAdmin\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * OpenAdmin\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

OpenAdmin\Admin\Form::forget(['editor']);

use OpenAdmin\Admin\Facades\Admin; // Pastikan ini ada
use OpenAdmin\Admin\Form;

Form::forget(['editor']);

// Contoh menu lain yang mungkin sudah ada
// Admin::menu()->add('Dashboard', '/admin')->icon('fa-dashboard');
// Admin::menu()->add('Users', 'auth/users')->icon('fa-users');

// TAMBAHKAN BARIS INI:
// Admin::menu()->add('Pengumuman', 'pengumumans.index')->icon('fa-bullhorn'); 

// Contoh menu lain setelahnya
// Admin::menu()->add('Galeri', 'galeris.index')->icon('fa-image');