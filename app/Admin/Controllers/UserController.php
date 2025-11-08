<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\User;

class UserController extends AdminController
{
    protected $title = 'User';

    /**
     * Grid pengguna dengan filter dan kolom sortable.
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Nama');
        $grid->column('email', 'Email');
        $grid->column('role', 'Role');
        $grid->column('created_at', 'Dibuat Pada')->sortable();
        $grid->column('updated_at', 'Diperbarui Pada')->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', 'Nama');
            $filter->like('email', 'Email');
            $filter->equal('role', 'Role')->select([
                'admin' => 'Admin',
                'user' => 'User'
            ]);
        });

        return $grid;
    }

    /**
     * Detail data pengguna.
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', 'Nama');
        $show->field('email', 'Email');
        $show->field('role', 'Role');
        $show->field('created_at', 'Dibuat Pada');
        $show->field('updated_at', 'Diperbarui Pada');

        return $show;
    }

    /**
     * Form input/edit pengguna dengan hash password.
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', 'Nama')->required();
        $form->email('email', 'Email')->required();
        $form->password('password', 'Password')
             ->required()
             ->default(fn($form) => $form->model()->password);
        $form->select('role', 'Role')->options([
            'admin' => 'Admin',
            'user' => 'User'
        ])->required();

        // Hash password sebelum menyimpan jika diubah
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password !== $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        return $form;
    }
}
