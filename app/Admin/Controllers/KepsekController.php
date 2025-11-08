<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Kepsek;

class KepsekController extends AdminController
{
    protected $title = 'Kepsek';

    /**
     * Grid data kepala sekolah.
     */
    protected function grid()
    {
        $grid = new Grid(new Kepsek());

        $grid->column('id', 'ID');
        $grid->column('nama', 'Nama');
        $grid->column('masa_jabatan', 'Masa Jabatan');
        $grid->column('foto', 'Foto')->image('', 60, 60);
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail data kepala sekolah.
     */
    protected function detail($id)
    {
        $show = new Show(Kepsek::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('nama', 'Nama');
        $show->field('masa_jabatan', 'Masa Jabatan');
        $show->field('foto', 'Foto')->image();
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input kepala sekolah.
     */
    protected function form()
    {
        $form = new Form(new Kepsek());

        $form->text('nama', 'Nama')->required();
        $form->text('masa_jabatan', 'Masa Jabatan')->required();

        $form->image('foto', 'Foto')
             ->dir('kepsek')       // Storage path: storage/app/public/kepsek
             ->uniqueName()
             ->required()
             ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
