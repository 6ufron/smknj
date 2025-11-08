<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Vimisi;

class VimisiController extends AdminController
{
    protected $title = 'Vimisi';

    /**
     * Grid visi/misi dengan kolom dan gambar.
     */
    protected function grid()
    {
        $grid = new Grid(new Vimisi());

        $grid->column('id', 'ID');
        $grid->column('kalimat', 'Kalimat');
        $grid->column('foto')->image();
        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');

        return $grid;
    }

    /**
     * Detail visi/misi.
     */
    protected function detail($id)
    {
        $show = new Show(Vimisi::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('kalimat', 'Kalimat');
        $show->field('foto')->image();
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');

        return $show;
    }

    /**
     * Form input/edit visi/misi dengan upload gambar.
     */
    protected function form()
    {
        $form = new Form(new Vimisi());

        $form->textarea('kalimat', 'Kalimat');
        $form->image('foto', 'Foto')
            ->move('images/visi_misi')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
