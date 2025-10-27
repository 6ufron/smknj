<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Pengumuman;

class PengumumanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pengumuman';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pengumuman());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('published_at', __('Published at'));
        $grid->column('link_url', __('Link url'));
        $grid->column('is_published', __('Is published'));
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
        $show = new Show(Pengumuman::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('published_at', __('Published at'));
        $show->field('link_url', __('Link url'));
        $show->field('is_published', __('Is published'));
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
        $form = new Form(new Pengumuman());

        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->date('published_at', __('Published at'))->default(date('Y-m-d'));
        $form->text('link_url', __('Link url'));
        $form->switch('is_published', __('Is published'))->default(1);

        return $form;
    }
}
