<style>
.host-with {
    text-align: center;
    padding: 1rem 0;
    justify-content: center;
    align-items: center;
    background: #181d38; /* warna footer */
    font-size: 0.95rem;
    color: #ffffff; /* warna teks utama */
    flex-wrap: wrap;
}

/* === Watermark halus sejajar di samping === */
.host-with .copyright {
    color: #292b3c; /* putih transparan, nyatu dg footer gelap */
    margin-left: 12px;
    font-weight: 600;
    user-select: none;
    transition: opacity 0.3s ease;
}

/* Efek elegan saat hover (opsional) */
.host-with .copyright:hover {
    opacity: 0.5;
}

/* === Responsif untuk layar kecil === */
@media (max-width: 576px) {
    .host-with {
        flex-direction: column;
        gap: 4px;
        font-size: 0.9rem;
        padding: 0.8rem 0;
    }
    .host-with .copyright {
        font-size: 0.85rem;
        opacity: 0.25; /* sedikit lebih terlihat di layar kecil */
    }
}
</style>
<footer class="footer-custom">
    <div class="footer-top-section">
        
        <!-- Contact Info -->
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-school"></i>
                <span class="text-white">SMK Nurul Jadid</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span class="text-white">Paiton, Probolinggo, Jawa Timur</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone-alt"></i>
                <a href="tel:+62-822-6468-2385" class="text-white">+62 812-5907-5405</a>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <a href="mailto:smknurja.paiton@gmail.com" class="text-white">smknurja.paiton@gmail.com</a>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="footer-links">
            
            <div class="link-column">
                <h4 class="column-title text-teal">Program Keahlian</h4>
                <ul>
                    <li><span>Teknik Komputer & Jaringan (TKJ)</span></li>
                    <li><span>Rekayasa Perangkat Lunak (RPL)</span></li>
                    <li><span>Desain Komunikasi Visual (DKV)</span></li>
                    <li><span>Teknik Pembangkit Tenaga Listrik (TPTL)</span></li>
                    <li><span>Desain Produksi Busana (DBP)</span></li>
                    <li><span>Agribisnis Pengolahan Hasil Perikanan (APHPi)</span></li>
                </ul>
            </div>

            <div class="link-column">
                <h4 class="column-title text-teal">Tentang Sekolah</h4>
                <ul>
                    <li><a href="/profil-smknj">Profil Sekolah</a></li>
                    <li><a href="/visi-misi-smknj">Visi & Misi</a></li>
                    <li><a href="/identitas-smknj">Identitas Sekolah</a></li>
                    <li><a href="/program-keahlian">Program Keahlian</a></li>
                    <li><a href="/ekstrakurikuler">Ekstrakurikuler</a></li>
                    <li><a href="/galeri-prestasi">Prestasi</a></li>
                </ul>
            </div>

            <div class="link-column">
                <h4 class="column-title text-teal">Akses Cepat</h4>
                <ul>
                    <li><a href="/daftar-berita">Berita Terbaru</a></li>
                    <li><a href="/ppdb-smknj">Pendaftaran Siswa Baru</a></li>
                    <li><a href="/galeri-video">Galeri Video</a></li>
                    <li><a href="/galeri-foto">Galeri Foto</a></li>
                    <li><a href="/kontak">Kontak Kami</a></li>
                    <li><a href="/alumni-smknj">Portal Alumni</a></li>
                </ul>
            </div>

        </div>

        <!-- Social Media -->
        <div class="social-media">
            <a href="https://www.facebook.com/SmkNurulJadidPaitonProbolinggo/?locale=id_ID" class="btn btn-square btn-social">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/smknuruljadidpaiton/" class="btn btn-square btn-social">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="http://www.youtube.com/@SMKNurulJadidPaitonProbolinggo" class="btn btn-square btn-social">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="https://www.linkedin.com/company/smk-nurul-jadid-paiton-probolinggo/" class="btn btn-square btn-social">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom-section">
        <div class="powered-by">
            <i class="fas fa-copyright"></i>
            <span><span id="year"></span> - SMK Nurul Jadid. Hak Cipta Dilindungi.</span>
        </div>
        <div class="host-with">
            <span>Dikembangkan oleh Tim IT SMK Nurul Jadid</span>
            <span class="copyright">@m6ufron & @qudus_adnan</span>
        </div>
    </div>
</footer>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
