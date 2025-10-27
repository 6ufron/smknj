<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Kepsek;

class KepsekController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kepsek';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kepsek());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('masa_jabatan', __('Masa jabatan'));
        $grid->column('foto')->image();
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
        $show = new Show(Kepsek::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('masa_jabatan', __('Masa jabatan'));
        $show->field('foto')->image();
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
        $form = new Form(new Kepsek());

        $form->text('nama', __('Nama'))->required();

        $form->image('foto', __('Foto'))
            ->uniqueName()
            ->dir('kepsek') // Storage path: storage/app/public/kepsek
            ->required()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        $form->text('masa_jabatan', __('Masa Jabatan'))->required();

        return $form;
    }
}
