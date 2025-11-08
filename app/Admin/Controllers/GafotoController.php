<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Gafoto;

class GafotoController extends AdminController
{
    protected $title = 'Gafoto';

    protected function grid()
    {
        $grid = new Grid(new Gafoto());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('nama', __('Nama'));

        $grid->column('foto1', __('Foto 1'))->image('', 60, 60);
        $grid->column('foto2', __('Foto 2'))->image('', 60, 60);
        $grid->column('foto3', __('Foto 3'))->image('', 60, 60);
        $grid->column('foto4', __('Foto 4'))->image('', 60, 60);

        $grid->column('deskripsi', __('Deskripsi'))->limit(50);
        $grid->column('created_at', __('Created at'))->sortable();

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Gafoto::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));

        $show->field('foto1', __('Foto 1'))->image();
        $show->field('foto2', __('Foto 2'))->image();
        $show->field('foto3', __('Foto 3'))->image();
        $show->field('foto4', __('Foto 4'))->image();

        $show->field('deskripsi', __('Deskripsi'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Gafoto());

        $form->text('nama', __('Nama'))->rules('required|max:255');

        foreach (range(1, 4) as $i) {
            $form->image("foto{$i}", "Foto {$i}")
                ->move('images/foto_sekolah')
                ->uniqueName()
                ->rules('nullable|mimes:jpeg,jpg,png|max:2048');
        }

        $form->textarea('deskripsi', __('Deskripsi'));

        return $form;
    }
}
