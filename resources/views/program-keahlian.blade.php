@extends('master')

@section('title', 'Program Keahlian')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-12 col-md-6">
                <b>Selamat Datang di Halaman Program Keahlian SMK Nurul Jadid!</b>
                <p>
                    Kami senang menyambut Anda di halaman program keahlian SMK Nurul Jadid, di mana kami berkomitmen untuk memberikan pendidikan yang berkualitas dan relevan dengan kebutuhan industri saat ini. Di SMK Nurul Jadid, kami memahami bahwa setiap siswa memiliki minat dan bakat yang unik, dan oleh karena itu, kami menawarkan berbagai jurusan yang dirancang untuk mengembangkan potensi mereka secara maksimal.
                </p>
                <p>Berikut adalah beberapa program keahlian unggulan yang kami tawarkan:</p>
                @foreach ($keahlian as $b)
                    <ul>
                        <li>{{ $b->nama }}</li>
                        <p>{{ $b->deskripsi }}</p>
                    </ul>
                @endforeach
                <p class="my-2">
                    Kami di SMK Nurul Jadid berkomitmen untuk menciptakan lingkungan belajar yang mendukung dan memotivasi siswa untuk mencapai potensi penuh mereka. Melalui kurikulum yang dirancang dengan baik dan fasilitas yang memadai, kami berharap dapat menghasilkan lulusan yang siap menghadapi tantangan di dunia kerja dan memberikan kontribusi positif bagi masyarakat.
                </p>
                <p>Mari jelajahi lebih lanjut setiap program keahlian kami dan temukan jurusan yang paling sesuai dengan minat dan bakat Anda. Kami siap membantu Anda mencapai impian dan tujuan karir Anda!</p>
            </div>
        </div>
    </div>
</div>
@endsection