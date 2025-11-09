<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Alumni;

class AlumniController extends AdminController
{
    protected $title = 'Data Alumni';

    /**
     * GRID - Daftar Alumni
     */
    protected function grid()
    {
        $grid = new Grid(new Alumni());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('nama', __('Nama Lengkap'))->sortable();
        $grid->column('nik', __('Nomor Induk Keluarga (NIK)'))->sortable();
        $grid->column('nisn', __('NISN'))->sortable();
        $grid->column('orang_tua', __('Orang Tua/Wali'));
        $grid->column('tahun_masuk', __('Tahun Masuk'));
        $grid->column('tahun_lulus', __('Tahun Lulus'));
        $grid->column('jurusan', __('Jurusan'));
        $grid->column('email', __('Email'));
        $grid->column('whatsapp', __('No. WhatsApp'));
        $grid->column('status', __('Status Saat Ini'));
        $grid->column('instansi', __('Instansi / Tempat Kerja'));
        $grid->column('hadir', __('Kehadiran'));
        $grid->column('created_at', __('Dibuat pada'))->sortable();
        $grid->column('updated_at', __('Diperbarui pada'))->sortable();

        // Filter pencarian
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('nama', 'Nama Lengkap');
            $filter->like('nik', 'NIK');
            $filter->like('nisn', 'NISN');
            $filter->like('jurusan', 'Jurusan');
            $filter->like('orang_tua', 'Orang Tua/Wali');
            $filter->like('email', 'Email');
            $filter->like('whatsapp', 'WhatsApp');
            $filter->equal('hadir', 'Kehadiran')->select([
                'Ya' => 'Ya',
                'Tidak' => 'Tidak',
            ]);
        });

        $grid->paginate(20);

        return $grid;
    }

    /**
     * DETAIL - Tampilkan data lengkap alumni
     */
    protected function detail($id)
    {
        $show = new Show(Alumni::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('nik', __('NIK'));
        $show->field('nama', __('Nama Lengkap'));
        $show->field('orang_tua', __('Orang Tua/Wali'));
        $show->field('nisn', __('NISN'));
        $show->field('tahun_masuk', __('Tahun Masuk'));
        $show->field('tahun_lulus', __('Tahun Lulus'));
        $show->field('jurusan', __('Jurusan'));
        $show->field('email', __('Email'));
        $show->field('whatsapp', __('WhatsApp'));
        $show->field('status', __('Status Saat Ini'));
        $show->field('instansi', __('Instansi / Tempat Kerja'));
        $show->field('hadir', __('Kehadiran'));
        $show->field('foto', __('Foto'))->image('', 100, 100);
        $show->field('instagram', __('Instagram'));
        $show->field('linkedin', __('LinkedIn'));
        $show->field('kesan_pesan', __('Kesan & Pesan'));
        $show->field('created_at', __('Dibuat pada'));
        $show->field('updated_at', __('Diperbarui pada'));

        return $show;
    }

    /**
     * FORM - Tambah & Edit Data Alumni
     */
    protected function form()
    {
        $form = new Form(new Alumni());

        $form->text('nama', __('Nama Lengkap'))->required();
        $form->text('nik', __('Nomor Induk Keluarga (NIK)'))->placeholder('Masukkan NIK');
        $form->text('orang_tua', __('Orang Tua/Wali'))->placeholder('Masukkan nama orang tua');
        $form->text('nisn', __('NISN'))->placeholder('Masukkan NISN');
        $form->number('tahun_masuk', __('Tahun Masuk'))->min(2000)->max(date('Y'));
        $form->number('tahun_lulus', __('Tahun Lulus'))->min(2000)->max(date('Y') + 1);
        $form->text('jurusan', __('Jurusan'))->placeholder('Contoh: RPL, TKJ, AKL');
        $form->email('email', __('Email'))->placeholder('Masukkan email aktif');
        $form->text('whatsapp', __('No. WhatsApp'))->options(['mask' => '9999-9999-9999']);
        $form->text('status', __('Status Saat Ini'))->placeholder('Contoh: Bekerja / Kuliah / Wirausaha');
        $form->text('instansi', __('Instansi / Tempat Kerja'))->placeholder('Masukkan nama instansi');
        $form->select('hadir', __('Kehadiran'))->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])->required();
        $form->image('foto', __('Foto'))->removable();
        $form->text('instagram', __('Instagram'))->placeholder('@username');
        $form->text('linkedin', __('LinkedIn'))->placeholder('Profil LinkedIn');
        $form->textarea('kesan_pesan', __('Kesan & Pesan'))->rows(3);

        $form->saving(function (Form $form) {
            // Pastikan tidak ada field kosong wajib
            if (empty($form->nama) || empty($form->jurusan)) {
                admin_error('Gagal', 'Nama dan Jurusan wajib diisi.');
                return back();
            }
        });

        return $form;
    }
}
