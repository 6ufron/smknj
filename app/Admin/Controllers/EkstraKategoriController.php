<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\EkstraKategori;

class EkstraKategoriController extends AdminController
{
    protected $title = 'Kategori Ekstrakurikuler';

    // Tabel data kategori
    protected function grid()
    {
        $grid = new Grid(new EkstraKategori());

        $grid->model()->withCount('programEkstra');

        $grid->column('id', __('Id'))->sortable();
        $grid->column('nama_bidang', __('Nama Bidang (Kategori)'))->sortable();
        $grid->column('deskripsi', __('Deskripsi Singkat'))->limit(100);
        $grid->column('program_ekstra_count', __('Jumlah Ekstra'))->sortable();
        $grid->column('created_at', __('Dibuat pada'))->sortable();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('nama_bidang', 'Nama Bidang');
        });

        return $grid;
    }

    // Detail kategori dan program terkait
    protected function detail($id)
    {
        $show = new Show(EkstraKategori::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama_bidang', __('Nama Bidang (Kategori)'));
        $show->field('deskripsi', __('Deskripsi'));
        $show->field('created_at', __('Dibuat pada'));
        $show->field('updated_at', __('Diperbarui pada'));

        // Relasi program ekstrakurikuler
        $show->relation('programEkstra', __('Program Ekstra Terkait'), function ($grid) {
            $grid->column('nama', __('Nama'));
            $grid->column('deskripsi', __('Deskripsi'))->limit(50);
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->disablePagination();
            $grid->disableFilter();
        });

        return $show;
    }

    // Form input data kategori
    protected function form()
    {
        $form = new Form(new EkstraKategori());

        $form->text('nama_bidang', __('Nama Bidang (Kategori)'))
            ->rules('required|min:3|max:255')
            ->placeholder('Contoh: Bidang Olahraga');

        $form->textarea('deskripsi', __('Deskripsi Singkat'))
            ->rows(5)
            ->placeholder('Deskripsi singkat mengenai bidang ini (opsional)');

        return $form;
    }
}
