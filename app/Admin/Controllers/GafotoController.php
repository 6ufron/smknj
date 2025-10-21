<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Gafoto;

class GafotoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Gafoto';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Gafoto());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('foto1', __('Foto1'));
        $grid->column('foto2', __('Foto2'));
        $grid->column('foto3', __('Foto3'));
        $grid->column('foto4', __('Foto4'));
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
        $show = new Show(Gafoto::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('foto1', __('Foto1'));
        $show->field('foto2', __('Foto2'));
        $show->field('foto3', __('Foto3'));
        $show->field('foto4', __('Foto4'));
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
        $form = new Form(new Gafoto());

        $form->text('nama', __('Nama'));
        $form->image('foto1', 'Foto 1')
            ->move('images/foto_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');
        $form->image('foto2', 'Foto 2')
            ->move('images/foto_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');
        $form->image('foto3', 'Foto 3')
            ->move('images/foto_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');
        $form->image('foto4', 'Foto 4')
            ->move('images/foto_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');
        $form->textarea('deskripsi', __('Deskripsi'));

        return $form;
    }
}
