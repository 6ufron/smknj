<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Alumni;

class AlumniController extends AdminController
{
    protected $title = 'Alumni';

    protected function grid()
    {
        $grid = new Grid(new Alumni());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('nama', __('Nama Lengkap'));
        $grid->column('nomor_induk', __('Nomor Induk Keluarga (NIK)'));
        $grid->column('nisn', __('NISN'));
        $grid->column('jurusan', __('Jurusan'));
        $grid->column('orang_tua', __('Orang Tua/Wali'));
        $grid->column('status', __('Status Kehadiran'));
        $grid->column('created_at', __('Dibuat pada'))->sortable();
        $grid->column('updated_at', __('Diperbarui pada'))->sortable();

        // --- Filter Data ---
        $grid->filter(function($filter) {
            $filter->disableIdFilter(); // Hapus filter default ID

            $filter->like('nama', 'Nama Lengkap'); // Pencarian nama
            $filter->like('nomor_induk', 'Nomor Induk Keluarga (NIK)'); // Pencarian NIK
            $filter->like('nisn', 'NISN'); // Pencarian NISN
            $filter->like('jurusan', 'Jurusan'); // Pencarian jurusan
            $filter->like('orang_tua', 'Orang Tua/Wali'); // Pencarian orang tua
            $filter->equal('status', 'Status Kehadiran')->select([
                'Hadir' => 'Hadir',
                'Tidak Hadir' => 'Tidak Hadir'
            ]); // Filter status hadir/tidak hadir
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Alumni::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('nama', __('Nama Lengkap'));
        $show->field('nomor_induk', __('Nomor Induk Keluarga (NIK)'));
        $show->field('nisn', __('NISN'));
        $show->field('jurusan', __('Jurusan'));
        $show->field('orang_tua', __('Orang Tua/Wali'));
        $show->field('status', __('Status Kehadiran'));
        $show->field('created_at', __('Dibuat pada'));
        $show->field('updated_at', __('Diperbarui pada'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Alumni());

        $form->text('nama', __('Nama Lengkap'))->required();
        $form->text('nomor_induk', __('Nomor Induk Keluarga (NIK)'))->placeholder('Masukkan NIK alumni');
        $form->text('nisn', __('NISN'))->placeholder('Masukkan NISN alumni');
        $form->text('jurusan', __('Jurusan'))->placeholder('Contoh: RPL, TKJ, AKL');
        $form->text('orang_tua', __('Orang Tua/Wali'))->required();
        $form->select('status', 'Status Kehadiran')
            ->options([
                'Hadir' => 'Hadir',
                'Tidak Hadir' => 'Tidak Hadir'
            ])
            ->required()
            ->attribute('data-placeholder', 'Pilih status kehadiran...');

        return $form;
    }
}
