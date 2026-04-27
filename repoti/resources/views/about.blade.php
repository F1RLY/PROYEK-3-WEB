@extends('layouts.app')

@section('title', 'Tentang RepoTI')

@section('content')
<section class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tentang <span class="text-primary">RepoTI</span></h1>
        <p class="text-muted">Platform repository tugas akhir Politeknik Negeri Indramayu</p>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <h4 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i> Apa itu RepoTI?</h4>
                <p class="text-muted">RepoTI adalah platform digital yang digunakan untuk mendokumentasikan, menyimpan, dan mempublikasikan karya ilmiah serta proyek tugas akhir mahasiswa Program Studi Teknik Informatika Politeknik Negeri Indramayu.</p>
                
                <h4 class="fw-bold mt-4 mb-3"><i class="bi bi-flag text-primary me-2"></i> Misi Kami</h4>
                <ul class="text-muted">
                    <li>Membangun database karya ilmiah yang terstruktur</li>
                    <li>Memudahkan akses informasi proyek mahasiswa</li>
                    <li>Mendorong kolaborasi dan inovasi</li>
                    <li>Mempreservasi karya terbaik civitas akademika</li>
                </ul>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <h4 class="fw-bold mb-3"><i class="bi bi-question-circle text-primary me-2"></i> Pertanyaan Populer</h4>
                
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Bagaimana cara mengunggah proyek?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                Login ke akun Anda, lalu pilih menu "Upload Proyek" dan isi formulir yang tersedia.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Siapa yang bisa mengakses RepoTI?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                Seluruh civitas akademika Polindra dan masyarakat umum dapat mengakses repository ini.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah proyek perlu diverifikasi?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                Ya, setiap proyek akan diverifikasi oleh admin sebelum dipublikasikan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="bg-primary text-white rounded-4 p-4 text-center">
                <h4 class="fw-bold mb-3">Punya Pertanyaan Lain?</h4>
                <p class="mb-3">Hubungi tim RepoTI untuk informasi lebih lanjut</p>
                <a href="mailto:repo@polindra.ac.id" class="btn btn-light text-primary rounded-pill px-4">
                    <i class="bi bi-envelope"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection