<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Vimisi;

class VimisiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Vimisi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vimisi());

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
        $show = new Show(Vimisi::findOrFail($id));

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
        $form = new Form(new Vimisi());

        $form->textarea('kalimat', __('Kalimat'));
        $form->image('foto', 'Foto')
            ->move('images/visi_misi')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
