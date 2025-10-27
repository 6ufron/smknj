<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Jurusan;

class JurusanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Jurusan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Jurusan());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('singkatan', __('Singkatan'));
        $grid->column('deskripsi', __('Deskripsi'));
        $grid->column('foto', 'Foto')
            ->display(function ($foto) {
                if (!$foto) return 'Tidak ada foto';
                return "<img src='/storage/{$foto}' width='60' />";
            });

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
        $show = new Show(Jurusan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('deskripsi', __('Deskripsi'));
        $show->field('singkatan', __('Singkatan'));
        $show->field('foto', __('Foto'))->image('/storage/', 200);
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
        $form = new Form(new Jurusan());

        $form->text('nama', __('Nama'));
        $form->text('singkatan', __('Singkatan'));
        $form->textarea('deskripsi', __('Deskripsi'));
        $form->image('foto', __('Foto'))
            ->uniqueName()
            ->dir('jurusan')
            ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
