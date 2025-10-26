<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Pengumuman; // Pastikan model dipanggil

class PengumumanController extends AdminController
{
    protected $title = 'Pengumuman';

    protected function grid()
    {
        $grid = new Grid(new Pengumuman());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Judul'))->editable(); // Judul bisa diedit langsung di tabel
        $grid->column('excerpt', __('Ringkasan')); // Tampilkan ringkasan
        $grid->column('published_at', __('Tgl Terbit'))->date('d M Y')->sortable(); // Format tanggal
        $grid->column('is_published', __('Status'))->switch(); // Tombol switch publish/unpublish
        $grid->column('created_at', __('Dibuat'))->date('d M Y H:i');

        // Filter
        $grid->filter(function($filter){
            $filter->like('title', 'Judul');
            $filter->between('published_at', 'Tanggal Terbit')->date();
            $filter->equal('is_published', 'Status')->select([1 => 'Published', 0 => 'Draft']);
        });

        // Urutkan berdasarkan tanggal terbit terbaru
        $grid->model()->orderBy('published_at', 'desc');

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Pengumuman::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Judul'));
        $show->field('content', __('Isi Pengumuman'))->unescape(); // Tampilkan HTML
        $show->field('published_at', __('Tgl Terbit'))->as(function ($date) {
            return $date ? $date->format('d F Y') : '-';
        });
        $show->field('link_url', __('Link Kustom'));
        $show->field('is_published', __('Status'))->using([1 => 'Published', 0 => 'Draft']);
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Pengumuman());

        $form->text('title', __('Judul'))->required();
        // Gunakan editor Trix atau CKEditor untuk 'content' agar bisa format HTML
        $form->trix('content', __('Isi Pengumuman'))->required(); 
        // Atau jika pakai CKEditor: $form->ckeditor('content', __('Isi Pengumuman'))->required();
        $form->date('published_at', __('Tgl Terbit'))->default(date('Y-m-d'));
        $form->url('link_url', __('Link Kustom'))->placeholder('Kosongkan jika tidak ada link khusus (contoh: /cek-kelulusan)');
        $form->switch('is_published', __('Terbitkan'))->default(1);

        return $form;
    }
}