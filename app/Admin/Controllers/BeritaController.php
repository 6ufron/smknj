<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Berita;

class BeritaController extends AdminController
{
    protected $title = 'Berita';

    // Tabel data Berita
    protected function grid()
    {
        $grid = new Grid(new Berita());

        $grid->column('id', __('Id'));
        $grid->column('judul', __('Judul'));
        $grid->column('foto')->image();
        $grid->column('kalimat', __('Kalimat'));
        $grid->column('kategori', __('Kategori'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // Filter data
        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->like('judul', 'Judul');
            $filter->equal('kategori', 'Kategori')->select([
                'sekolah' => 'Sekolah',
                'pendidikan' => 'Pendidikan',
                'prestasi' => 'Prestasi',
            ]);
            $filter->between('created_at', 'Tanggal Dibuat')->date();
            $filter->between('updated_at', 'Tanggal Diperbarui')->date();
        });

        return $grid;
    }

    // Detail data Berita
    protected function detail($id)
    {
        $show = new Show(Berita::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('judul', __('Judul'));
        $show->field('foto')->image();
        $show->field('kalimat', __('Kalimat'));
        $show->field('kategori', __('Kategori'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    // Form input data Berita
    protected function form()
    {
        $form = new Form(new Berita());

        $form->column(1/2, function ($form) {
            $form->text('judul', __('Judul'));
            $form->image('foto', 'Foto')
                ->move('images/berita_sekolah')
                ->uniqueName()
                ->rules('mimes:jpeg,jpg,png|max:2048');
            $form->select('kategori','Kategori')->options([
                'sekolah' => 'Sekolah',
                'pendidikan' => 'Pendidikan',
                'prestasi' => 'Prestasi',
            ]);
        });

        $form->column(1/2, function ($form) {
            $form->textarea('kalimat', __('Kalimat'));
            $form->text('akses', __('Diakses'));
        });

        return $form;
    }
}
