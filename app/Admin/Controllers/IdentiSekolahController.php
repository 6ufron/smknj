<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\IdentiSekolah;

class IdentiSekolahController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'IdentiSekolah';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new IdentiSekolah());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('tahun_berdiri', __('Tahun berdiri'));
        $grid->column('tahun_beroperasi', __('Tahun beroperasi'));
        $grid->column('nsm', __('Nsm'));
        $grid->column('npsn', __('Npsn'));
        $grid->column('npwp', __('Npwp'));
        $grid->column('status_akreditasi', __('Status akreditasi'));
        $grid->column('yayasan_penyelenggara', __('Yayasan penyelenggara'));
        $grid->column('nomer_telepon', __('Nomer telepon'));
        $grid->column('email', __('Email'));
        $grid->column('website', __('Website'));
        $grid->column('alamat', __('Alamat'));
        $grid->column('desa', __('Desa'));
        $grid->column('kecamatan', __('Kecamatan'));
        $grid->column('kota', __('Kota'));
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
        $show = new Show(IdentiSekolah::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('tahun_berdiri', __('Tahun berdiri'));
        $show->field('tahun_beroperasi', __('Tahun beroperasi'));
        $show->field('nsm', __('Nsm'));
        $show->field('npsn', __('Npsn'));
        $show->field('npwp', __('Npwp'));
        $show->field('status_akreditasi', __('Status akreditasi'));
        $show->field('yayasan_penyelenggara', __('Yayasan penyelenggara'));
        $show->field('nomer_telepon', __('Nomer telepon'));
        $show->field('email', __('Email'));
        $show->field('website', __('Website'));
        $show->field('alamat', __('Alamat'));
        $show->field('desa', __('Desa'));
        $show->field('kecamatan', __('Kecamatan'));
        $show->field('kota', __('Kota'));
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
        $form = new Form(new IdentiSekolah());

        $form->text('nama', __('Nama'));
        $form->text('tahun_berdiri', __('Tahun berdiri'));
        $form->text('tahun_beroperasi', __('Tahun beroperasi'));
        $form->text('nsm', __('Nsm'));
        $form->text('npsn', __('Npsn'));
        $form->text('npwp', __('Npwp'));
        $form->text('status_akreditasi', __('Status akreditasi'));
        $form->text('yayasan_penyelenggara', __('Yayasan penyelenggara'));
        $form->text('nomer_telepon', __('Nomer telepon'));
        $form->email('email', __('Email'));
        $form->text('website', __('Website'));
        $form->text('alamat', __('Alamat'));
        $form->text('desa', __('Desa'));
        $form->text('kecamatan', __('Kecamatan'));
        $form->text('kota', __('Kota'));

        return $form;
    }
}
