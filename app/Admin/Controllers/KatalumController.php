<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\KataAlumni;

class KatalumController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KataAlumni';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KataAlumni());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('pekerjaan', __('Pekerjaan'));
        $grid->column('pesan', __('Pesan'));
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
        $show = new Show(KataAlumni::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('pekerjaan', __('Pekerjaan'));
        $show->field('pesan', __('Pesan'));
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
        $form = new Form(new KataAlumni());

        $form->text('nama', __('Nama'));
        $form->text('pekerjaan', __('Pekerjaan'));
        $form->textarea('pesan', __('Pesan'));
        $form->image('foto', 'Foto')
            ->move('images/alumni')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
