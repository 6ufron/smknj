<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Ekstrakurikuler';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ekstrakurikuler());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('foto', __('Foto'));
        $grid->column('deskripsi', __('Deskripsi'));
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
        $show = new Show(Ekstrakurikuler::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('foto', __('Foto'));
        $show->field('deskripsi', __('Deskripsi'));
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
        $form = new Form(new Ekstrakurikuler());

        $form->text('nama', __('Nama'));
        $form->image('foto', 'Foto')
            ->move('images/ekstra_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');
        $form->textarea('deskripsi', __('Deskripsi'));

        return $form;
    }
}
