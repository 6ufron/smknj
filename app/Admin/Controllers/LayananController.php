<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Layanan;

class LayananController extends AdminController
{
    protected $title = 'Layanan';

    /**
     * Grid data layanan.
     */
    protected function grid()
    {
        $grid = new Grid(new Layanan());

        $grid->column('id', 'ID');
        $grid->column('icon', 'Icon');
        $grid->column('nama', 'Nama');
        $grid->column('deskripsi', 'Deskripsi');
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail data layanan.
     */
    protected function detail($id)
    {
        $show = new Show(Layanan::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('icon', 'Icon');
        $show->field('nama', 'Nama');
        $show->field('deskripsi', 'Deskripsi');
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input layanan.
     */
    protected function form()
    {
        $form = new Form(new Layanan());

        $form->text('icon', 'Icon');
        $form->text('nama', 'Nama');
        $form->text('deskripsi', 'Deskripsi');

        return $form;
    }
}
