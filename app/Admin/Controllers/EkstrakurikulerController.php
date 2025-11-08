<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Ekstrakurikuler;
use App\Models\EkstraKategori;
use Hashids\Hashids;

class EkstrakurikulerController extends AdminController
{
    protected $title = 'Ekstrakurikuler';

    // Helper untuk Hashids
    private function getHashids()
    {
        return new Hashids(config('app.key'), 10);
    }

    // Tabel data ekstrakurikuler
    protected function grid()
    {
        $grid = new Grid(new Ekstrakurikuler());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('kategori.nama_bidang', __('Kategori Bidang'))->sortable();
        $grid->column('nama', __('Nama Ekstra'));
        $grid->column('foto', __('Foto'))->image('', 60, 60);
        $grid->column('deskripsi', __('Deskripsi'))->limit(50);
        $grid->column('created_at', __('Created at'))->sortable();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('nama', 'Nama Ekstra');
            $filter->equal('ekstra_kategori_id', 'Kategori Bidang')->select(
                EkstraKategori::pluck('nama_bidang', 'id')
            );
        });

        return $grid;
    }

    // Detail data ekstrakurikuler
    protected function detail($id)
    {
        $decodedId = $this->getHashids()->decode($id)[0] ?? null;
        if ($decodedId === null) abort(404);

        $show = new Show(Ekstrakurikuler::findOrFail($decodedId));

        $show->field('id', __('Id'));
        $show->field('kategori.nama_bidang', __('Kategori Bidang'));
        $show->field('nama', __('Nama Ekstra'));
        $show->field('foto', __('Foto'))->image();
        $show->field('deskripsi', __('Deskripsi'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    // Form tambah/edit ekstrakurikuler
    protected function form()
    {
        $hashId = request()->route('id');
        $model = null;

        if ($hashId) {
            $decodedId = $this->getHashids()->decode($hashId)[0] ?? null;
            if ($decodedId === null) abort(404, 'Invalid ID format.');
            $model = Ekstrakurikuler::findOrFail($decodedId);
        }

        $form = new Form($model ?? new Ekstrakurikuler());

        $form->select('ekstra_kategori_id', __('Kategori Bidang'))
            ->options(EkstraKategori::pluck('nama_bidang', 'id'))
            ->rules('required')
            ->placeholder('Pilih Kategori/Bidang');

        $form->text('nama', __('Nama Ekstra'))->rules('required');

        $form->image('foto', 'Foto')
            ->move('images/ekstra_sekolah')
            ->uniqueName()
            ->rules('nullable|mimes:jpeg,jpg,png|max:2048');

        $form->textarea('deskripsi', __('Deskripsi'))->rows(10);

        return $form;
    }
}
