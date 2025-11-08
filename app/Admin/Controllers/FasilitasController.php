<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Fasilitas;
use Hashids\Hashids;

class FasilitasController extends AdminController
{
    protected $title = 'Fasilitas';

    private function getHashids()
    {
        return new Hashids(config('app.key'), 10);
    }

    protected function grid()
    {
        $grid = new Grid(new Fasilitas());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('nama', __('Nama'));
        $grid->column('kategori', __('Kategori'))
             ->using([
                'Utama' => 'Utama',
                'Pendukung' => 'Pendukung'
             ])
             ->label([
                'Utama' => 'success',
                'Pendukung' => 'info',
             ])
             ->sortable();
        $grid->column('deskripsi', __('Deskripsi'))->limit(50);
        $grid->column('foto_path', __('Foto'))->image('', 60, 60);
        $grid->column('created_at', __('Created at'))->sortable();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('nama', 'Nama');
            $filter->equal('kategori')->select([
                'Utama' => 'Utama',
                'Pendukung' => 'Pendukung'
            ]);
        });

        return $grid;
    }

    protected function detail($id)
    {
        $decodedId = $this->getHashids()->decode($id)[0] ?? null;
        if (!$decodedId) abort(404);

        $show = new Show(Fasilitas::findOrFail($decodedId));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('kategori', __('Kategori'))
             ->using([
                'Utama' => 'Utama',
                'Pendukung' => 'Pendukung'
             ]);
        $show->field('deskripsi', __('Deskripsi'));
        $show->field('foto_path', __('Foto'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $hashIdFromUrl = request()->route('id');
        $model = null;

        if ($hashIdFromUrl) {
            $decodedId = $this->getHashids()->decode($hashIdFromUrl)[0] ?? null;
            if (!$decodedId) abort(404, 'Invalid ID format.');
            $model = Fasilitas::findOrFail($decodedId);
        }

        $form = new Form($model ?? new Fasilitas());

        $form->select('kategori', __('Kategori Fasilitas'))
             ->options([
                'Utama' => 'Fasilitas Utama',
                'Pendukung' => 'Fasilitas Pendukung',
             ])
             ->rules('required')
             ->placeholder('Pilih Kategori');
        
        $form->text('nama', __('Nama Fasilitas'))->rules('required|max:255');
        $form->textarea('deskripsi', __('Deskripsi Singkat'));

        $form->image('foto_path', __('Foto Fasilitas'))
             ->rules('nullable|image|max:2048')
             ->removable()
             ->disk('public');

        return $form;
    }
}
