<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\ProfilSekolah;

class ProfilSekolahController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProfilSekolah';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProfilSekolah());

        $grid->column('id', __('Id'));
        $grid->column('kalimat', __('Kalimat'));
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
        $show = new Show(ProfilSekolah::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('kalimat', __('Kalimat'));
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
        $form = new Form(new ProfilSekolah());

        $form->textarea('kalimat', __('Kalimat'));
        $form->image('foto', 'Foto')
            ->move('images/profil_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
