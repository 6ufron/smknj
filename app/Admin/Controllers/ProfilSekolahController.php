<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\ProfilSekolah;

class ProfilSekolahController extends AdminController
{
    protected $title = 'Profil Sekolah';

    /**
     * Grid data profil sekolah.
     */
    protected function grid()
    {
        $grid = new Grid(new ProfilSekolah());

        $grid->column('id', 'ID');
        $grid->column('kalimat', 'Kalimat');
        $grid->column('foto', 'Foto')->image();
        $grid->column('created_at', 'Dibuat');
        $grid->column('updated_at', 'Diperbarui');

        return $grid;
    }

    /**
     * Detail data profil sekolah.
     */
    protected function detail($id)
    {
        $show = new Show(ProfilSekolah::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('kalimat', 'Kalimat');
        $show->field('foto', 'Foto')->image();
        $show->field('created_at', 'Dibuat');
        $show->field('updated_at', 'Diperbarui');

        return $show;
    }

    /**
     * Form input profil sekolah.
     */
    protected function form()
    {
        $form = new Form(new ProfilSekolah());

        $form->textarea('kalimat', 'Kalimat');
        $form->image('foto', 'Foto')
            ->move('images/profil_sekolah')
            ->uniqueName()
            ->rules('mimes:jpeg,jpg,png|max:2048');

        return $form;
    }
}
