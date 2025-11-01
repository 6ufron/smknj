<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Fasilitas;

class FasilitasController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fasilitas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fasilitas());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('deskripsi', __('Deskripsi'));
        $grid->column('foto_path', __('Foto path'));
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
        $show = new Show(Fasilitas::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('deskripsi', __('Deskripsi'));
        $show->field('foto_path', __('Foto path'));
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
        $form = new Form(new Fasilitas());

        $form->select('kategori', __('Kategori Fasilitas'))->options([
            'AKADEMIK' => 'Fasilitas Akademik',
            'NON_AKADEMIK' => 'Fasilitas Non-Akademik',
        ])->rules('required')
            ->placeholder('Pilih Kategori');

        // Field lainnya
        $form->text('nama', __('Nama Fasilitas'))->rules('required|max:255');
        $form->textarea('deskripsi', __('Deskripsi Singkat'));

        // Field Upload Foto
        $form->image('foto_path', __('Foto Fasilitas'))
            ->rules('required|image|max:2048')
            ->removable()
            ->disk('public');

        return $form;
    }
}