<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Pengumuman;

class PengumumanController extends AdminController
{
    protected $title = 'Pengumuman';

    /**
     * Grid data pengumuman.
     */
    protected function grid()
    {
        $grid = new Grid(new Pengumuman());

        $grid->column('id', 'ID');
        $grid->column('title', 'Judul');
        $grid->column('content', 'Konten');
        $grid->column('published_at', 'Tanggal Terbit');
        $grid->column('link_url', 'Link URL');
        $grid->column('is_published', 'Publikasi')->bool();
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail data pengumuman.
     */
    protected function detail($id)
    {
        $show = new Show(Pengumuman::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('title', 'Judul');
        $show->field('content', 'Konten');
        $show->field('published_at', 'Tanggal Terbit');
        $show->field('link_url', 'Link URL');
        $show->field('is_published', 'Publikasi')->bool();
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input pengumuman.
     */
    protected function form()
    {
        $form = new Form(new Pengumuman());

        $form->text('title', 'Judul');
        $form->textarea('content', 'Konten');
        $form->date('published_at', 'Tanggal Terbit')->default(date('Y-m-d'));
        $form->text('link_url', 'Link URL');
        $form->switch('is_published', 'Publikasi')->default(1);

        return $form;
    }
}
