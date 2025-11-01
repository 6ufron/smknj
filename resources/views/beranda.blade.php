@extends('master')

@section('title', 'Beranda')

{{-- 1. Push CSS (CSS Slider dimuat dari file aset utama) --}}
@push('styles')

@endpush


{{-- 2. Konten Halaman Beranda --}}
@section('content')
    @include('components/home-slider')
    @include('components/home-service')
    @include('components/home-greeting')
    @include('components/home-breaking-news')
    @include('components/akses-video')
    @include('components/home-kalimatu')
@endsection


{{-- 3. Push JavaScript KHUSUS untuk slider --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (typeof Swiper === 'undefined') {
                console.error('Swiper.js library not loaded.');
                return;
            }

            // --- Konfigurasi dan Elemen Slider ---
            const autoplayDelay = 5000;
            const cards = document.querySelectorAll('.card-stack-item');
            const totalSlides = cards.length;
            const slideCounter = document.querySelector('.current-slide');
            const mainSliderElement = document.querySelector('.main-slider');
            let mainSlider = null;

            // Jangan jalankan jika elemen slider atau kartu tidak ada
            if (!mainSliderElement || totalSlides === 0) {
                console.warn('Slider element or card stack not found. Skipping Swiper init.');
                return;
            }

            // --- Fungsi Helper untuk Slider ---

            /**
             * Memperbarui posisi tumpukan kartu berdasarkan slide yang aktif.
             */
            function updateCardStack(activeIndex) {
                cards.forEach((card, index) => {
                    let pos = (index - activeIndex + totalSlides) % totalSlides;
                    card.dataset.stackPos = pos;
                });
            }

            /**
             * Memperbarui teks nomor slide saat ini.
             */
            function updateCounter() {
                if (slideCounter && mainSlider) {
                    let currentSlideIndex = mainSlider.realIndex + 1;
                    slideCounter.textContent = currentSlideIndex < 10 ? '0' + currentSlideIndex : currentSlideIndex;
                }
            }

            // --- Inisialisasi Swiper ---
            try {
                mainSlider = new Swiper(mainSliderElement, {
                    loop: true,
                    speed: 800,
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    autoplay: {
                        delay: autoplayDelay,
                        disableOnInteraction: false
                    },

                    // Event Listeners
                    on: {
                        /**
                         * Panggil fungsi helper saat Swiper pertama kali diinisialisasi.
                         */
                        init: function() {
                            updateCardStack(this.realIndex);
                            updateCounter();
                        },

                        /**
                         * Jalankan animasi "promote" kartu sebelum slide berganti.
                         */
                        slideChangeTransitionStart: function() {
                            const currentRealIndex = this.realIndex;
                            const previousRealIndex = (currentRealIndex - 1 + totalSlides) % totalSlides;
                            
                            // Gunakan data-index dari HTML Anda
                            const promotingCard = document.querySelector(`.card-stack-item[data-index="${previousRealIndex}"]`);

                            if (promotingCard) {
                                promotingCard.classList.add('is-promoting');
                                setTimeout(() => {
                                    promotingCard.classList.remove('is-promoting');
                                }, 800); // Durasi harus cocok dengan transisi CSS
                            }
                        },

                        /**
                         * Perbarui tumpukan kartu dan penghitung setelah slide berganti.
                         */
                        slideChange: function() {
                            updateCardStack(this.realIndex);
                            updateCounter();
                        }
                    }
                });

            } catch (e) {
                console.error("Failed to initialize Swiper slider:", e);
            }
        });
    </script>
@endpush