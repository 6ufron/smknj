<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Prestasi;

class GaprestasiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Gaprestasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Prestasi());

        $grid->column('id', __('ID'));
        $grid->column('foto_prestasi', __('Foto Prestasi'))->image();
        $grid->column('judul', __('Judul'));
        $grid->column('tanggal', __('Tanggal'))->date('d-m-Y');
        $grid->column('created_at', __('Dibuat pada'));
        $grid->column('updated_at', __('Diperbarui pada'));

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
        $show = new Show(Prestasi::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('foto_prestasi', __('Foto Prestasi'))->image();
        $show->field('judul', __('Judul'));
        $show->field('tanggal', __('Tanggal'));
        $show->field('created_at', __('Dibuat pada'));
        $show->field('updated_at', __('Diperbarui pada'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Prestasi());

        $form->image('foto_prestasi', __('Foto Prestasi'))
            ->move('images/foto_prestasi')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        $form->text('judul', __('Judul'))->rules('required|max:255');

        $form->date('tanggal', __('Tanggal'))->rules('required|date');

        return $form;
    }
}