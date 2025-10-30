<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Download;

class DownloadController extends AdminController
{
    protected $title = 'Manajemen Dokumen Download';

    protected function grid()
    {
        $grid = new Grid(new Download());

        $grid->column('id', __('No'))->sortable();
        $grid->column('title', __('Nama Dokumen'));
        $grid->column('description', __('Keterangan Singkat'))->limit(50);

        // PENTING: Menampilkan tombol Download di grid
        $grid->column('file_path', __('Aksi'))->display(function ($filePath) {
            if ($filePath) {
                $downloadUrl = asset('storage/' . $filePath);
                return "<a href='{$downloadUrl}' target='_blank' class='btn btn-success btn-sm'>
                            <i class='fa fa-download'></i> Download
                        </a>";
            }
            return '—';
        });

        $grid->column('created_at', __('Diunggah Pada'));
        $grid->column('updated_at', __('Diperbarui Pada'))->hide();
        
        $grid->filter(function($filter) {
        // Hapus filter default ID agar tampilan lebih bersih
        $filter->disableIdFilter();

        // 1. Filter berdasarkan Nama Dokumen (Like Search)
        $filter->like('title', 'Nama Dokumen');

        // 2. Filter berdasarkan Keterangan Singkat (Like Search)
        $filter->like('description', 'Keterangan');

        // 3. Filter berdasarkan tanggal unggah (range date)
        $filter->between('created_at', 'Diunggah Pada')->date();

        // 4. Filter berdasarkan tanggal diperbarui (range date)
        $filter->between('updated_at', 'Diperbarui Pada')->date();

        // 5. Filter berdasarkan tipe file (misal PDF, DOC, ZIP)
        $filter->equal('file_type', 'Tipe Dokumen')->select([
            'pdf' => 'PDF',
            'doc' => 'DOC',
            'docx' => 'DOCX',
            'xls' => 'XLS',
            'xlsx' => 'XLSX',
            'zip' => 'ZIP',
        ]);

    // 6. Filter dropdown kategori dokumen (jika ada relasi kategori)
    // $filter->equal('category_id', 'Kategori')->select(\App\Models\Category::pluck('name', 'id'));
});


        // Tambahkan filter jika diperlukan di masa mendatang
        // $grid->filter(function($filter){ /* ... */ });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Download::findOrFail($id));

        $show->field('title', __('Nama Dokumen'));
        $show->field('description', __('Keterangan'));
        $show->field('file_path', __('Path File'));
        $show->field('created_at', __('Diunggah Pada'));
        $show->field('updated_at', __('Diperbarui Pada'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Download());

        $form->text('title', __('Nama Dokumen'))->rules('required');
        $form->textarea('description', __('Keterangan'));

        $form->file('file_path', __('Pilih Dokumen'))
            ->rules('required|mimes:pdf,doc,docx,xls,xlsx,zip')
            ->removable()
            ->downloadable()
            ->disk('public');

        return $form;
    }
}