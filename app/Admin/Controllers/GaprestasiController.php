<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Prestasi;

class GaprestasiController extends AdminController
{
    protected $title = 'Prestasi Siswa';

    protected function grid()
    {
        $grid = new Grid(new Prestasi());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('foto_prestasi', __('Foto'))->image('', 60, 60);
        $grid->column('judul', __('Judul'))->limit(40);
        $grid->column('tanggal', __('Tanggal'))->date('d-m-Y');
        $grid->column('created_at', __('Dibuat'))->sortable();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('judul', 'Judul');
            $filter->between('tanggal', 'Tanggal')->date();
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Prestasi::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('foto_prestasi', __('Foto'))->image();
        $show->field('judul', __('Judul'));
        $show->field('tanggal', __('Tanggal'))->as(fn($date) => date('d-m-Y', strtotime($date)));
        $show->field('created_at', __('Dibuat pada'));
        $show->field('updated_at', __('Diperbarui pada'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Prestasi());

        $form->image('foto_prestasi', __('Foto Prestasi'))
            ->move('images/foto_prestasi')
            ->uniqueName()
            ->rules('required|mimes:jpeg,jpg,png|max:2048');

        $form->text('judul', __('Judul'))
            ->rules('required|max:255')
            ->placeholder('Contoh: Juara 1 Lomba Sains Nasional');

        $form->date('tanggal', __('Tanggal Prestasi'))
            ->default(date('Y-m-d'))
            ->rules('required|date');

        return $form;
    }
}
