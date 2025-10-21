<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Alumni;

class AlumniController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Alumni';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Alumni());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('nomor_induk', __('Nomor induk'));
        $grid->column('nisn', __('Nisn'));
        $grid->column('jurusan', __('Jurusan'));
        $grid->column('orang_tua', __('Orang Tua'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Alumni::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('nomor_induk', __('Nomor induk'));
        $show->field('nisn', __('Nisn'));
        $show->field('jurusan', __('Jurusan'));
        $show->field('orang_tua', __('Orang Tua'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Alumni());

        $form->text('nama', __('Nama'));
        $form->text('nomor_induk', __('Nomor induk'));
        $form->text('nisn', __('Nisn'));
        $form->text('jurusan', __('Jurusan'));
        $form->text('orang_tua', __('Orang Tua'));
        $form->text('status', __('Status'));

        return $form;
    }
}
