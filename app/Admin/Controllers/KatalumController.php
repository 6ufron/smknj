<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\KataAlumni;

class KatalumController extends AdminController
{
    protected $title = 'Kata Alumni';

    /**
     * Grid data kata alumni.
     */
    protected function grid()
    {
        $grid = new Grid(new KataAlumni());

        $grid->column('id', 'ID');
        $grid->column('nama', 'Nama');
        $grid->column('pekerjaan', 'Pekerjaan');
        $grid->column('pesan', 'Pesan');
        $grid->column('foto', 'Foto')->image('', 60, 60);
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail kata alumni.
     */
    protected function detail($id)
    {
        $show = new Show(KataAlumni::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('nama', 'Nama');
        $show->field('pekerjaan', 'Pekerjaan');
        $show->field('pesan', 'Pesan');
        $show->field('foto', 'Foto')->image();
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input kata alumni.
     */
    protected function form()
    {
        $form = new Form(new KataAlumni());

        $form->text('nama', 'Nama')->required();
        $form->text('pekerjaan', 'Pekerjaan')->required();
        $form->textarea('pesan', 'Pesan')->rows(5);
        $form->image('foto', 'Foto')
             ->move('images/alumni')
             ->uniqueName()
             ->removable()
             ->rules('nullable|mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
