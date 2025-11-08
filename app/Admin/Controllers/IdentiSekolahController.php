<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\IdentiSekolah;

class IdentiSekolahController extends AdminController
{
    protected $title = 'Identitas Sekolah';

    /**
     * Tabel data identitas sekolah (Grid).
     */
    protected function grid()
    {
        $grid = new Grid(new IdentiSekolah());

        $grid->column('id', 'ID');
        $grid->column('nama', 'Nama');
        $grid->column('tahun_berdiri', 'Tahun Berdiri');
        $grid->column('tahun_beroperasi', 'Tahun Beroperasi');
        $grid->column('nsm', 'NSM');
        $grid->column('npsn', 'NPSN');
        $grid->column('npwp', 'NPWP');
        $grid->column('status_akreditasi', 'Status Akreditasi');
        $grid->column('yayasan_penyelenggara', 'Yayasan Penyelenggara');
        $grid->column('nomer_telepon', 'No. Telepon');
        $grid->column('email', 'Email');
        $grid->column('website', 'Website');
        $grid->column('alamat', 'Alamat');
        $grid->column('desa', 'Desa');
        $grid->column('kecamatan', 'Kecamatan');
        $grid->column('kota', 'Kota');
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail data identitas sekolah (Show).
     */
    protected function detail($id)
    {
        $show = new Show(IdentiSekolah::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('nama', 'Nama');
        $show->field('tahun_berdiri', 'Tahun Berdiri');
        $show->field('tahun_beroperasi', 'Tahun Beroperasi');
        $show->field('nsm', 'NSM');
        $show->field('npsn', 'NPSN');
        $show->field('npwp', 'NPWP');
        $show->field('status_akreditasi', 'Status Akreditasi');
        $show->field('yayasan_penyelenggara', 'Yayasan Penyelenggara');
        $show->field('nomer_telepon', 'No. Telepon');
        $show->field('email', 'Email');
        $show->field('website', 'Website');
        $show->field('alamat', 'Alamat');
        $show->field('desa', 'Desa');
        $show->field('kecamatan', 'Kecamatan');
        $show->field('kota', 'Kota');
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input identitas sekolah.
     */
    protected function form()
    {
        $form = new Form(new IdentiSekolah());

        $form->text('nama', 'Nama')->required();
        $form->number('tahun_berdiri', 'Tahun Berdiri')->min(1900)->max(date('Y'));
        $form->number('tahun_beroperasi', 'Tahun Beroperasi')->min(1900)->max(date('Y'));
        $form->text('nsm', 'NSM');
        $form->text('npsn', 'NPSN');
        $form->text('npwp', 'NPWP');
        $form->text('status_akreditasi', 'Status Akreditasi');
        $form->text('yayasan_penyelenggara', 'Yayasan Penyelenggara');
        $form->number('nomer_telepon', 'No. Telepon');
        $form->email('email', 'Email');
        $form->url('website', 'Website');
        $form->textarea('alamat', 'Alamat');
        $form->text('desa', 'Desa');
        $form->text('kecamatan', 'Kecamatan');
        $form->text('kota', 'Kota');

        return $form;
    }
}
