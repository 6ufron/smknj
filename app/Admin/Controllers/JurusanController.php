<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Jurusan;

class JurusanController extends AdminController
{
    protected $title = 'Jurusan';

    /**
     * Grid data jurusan.
     */
    protected function grid()
    {
        $grid = new Grid(new Jurusan());

        $grid->column('id', 'ID');
        $grid->column('nama', 'Nama');
        $grid->column('singkatan', 'Singkatan');
        $grid->column('deskripsi', 'Deskripsi');
        $grid->column('foto', 'Foto')->image('', 60, 60);
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail jurusan.
     */
    protected function detail($id)
    {
        $show = new Show(Jurusan::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('nama', 'Nama');
        $show->field('singkatan', 'Singkatan');
        $show->field('deskripsi', 'Deskripsi');
        $show->field('foto', 'Foto')->image();
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input jurusan.
     */
    protected function form()
    {
        $form = new Form(new Jurusan());

        $form->text('nama', 'Nama')->required();
        $form->text('singkatan', 'Singkatan')->required();
        $form->textarea('deskripsi', 'Deskripsi')->rows(5);
        $form->image('foto', 'Foto')
             ->move('images/jurusan')
             ->uniqueName()
             ->removable()
             ->rules('nullable|mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
