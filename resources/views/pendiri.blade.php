@extends('layouts.main')

@section('title', 'Pendiri Pesantren - Profil')

@section('content')
<!-- Hero Section -->
<section class="relative bg-emerald-900 text-white overflow-hidden">
    <!-- Background Pattern/Overlay -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <!-- Pattern background islami (opsional) -->
        <div class="w-full h-full bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-20"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl text-white drop-shadow-lg">
            Jejak Perjuangan & Keteladanan
        </h1>
        <p class="mt-6 max-w-3xl mx-auto text-xl text-emerald-100 font-light">
            Mengenang sejarah keikhlasan, pengorbanan, dan dedikasi mulia tokoh masyarakat dan keluarga besar pendiri Pesantren.
        </p>
    </div>
</section>

<!-- Breadcrumb -->
<nav class="bg-gray-50 border-b border-gray-200" aria-label="Breadcrumb">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <ol class="flex items-center space-x-2 sm:space-x-4 text-sm font-medium text-gray-500">
            <li>
                <a href="/" class="hover:text-emerald-700 transition-colors">Beranda</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 sm:ml-4">Profil</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 sm:ml-4 text-emerald-800 font-semibold">Pendiri</span>
                </div>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content Article -->
<section class="bg-white py-16 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-4xl mx-auto">
        
        <!-- Quote Pembuka -->
        <div class="border-l-4 border-emerald-600 bg-emerald-50 text-emerald-900 p-6 sm:p-8 rounded-r-xl mb-12 shadow-sm flex flex-col justify-center transform transition duration-300 hover:shadow-md">
            <p class="text-xl sm:text-2xl italic font-serif leading-relaxed text-center">
                "Sebaik-baik manusia adalah yang paling bermanfaat bagi manusia lainnya."
            </p>
            <span class="mt-4 text-sm font-bold text-emerald-700 text-center uppercase tracking-widest">— HR. Ahmad</span>
        </div>

        <!-- Content Body -->
        <div class="text-lg text-gray-700 leading-loose space-y-8 text-justify">
            
            <p>
                <span class="font-bold text-emerald-800 text-xl">Bismillahirrohmanirrohim.</span> Segala puji hanya milik Allah Subhanahu wa Ta'ala, Tuhan semesta alam yang telah mengaruniakan nikmat iman, Islam, serta ilmu pengetahuan kepada umat manusia. Shalawat serta salam senantiasa tercurah kepada junjungan alam, baginda Nabi Muhammad Shallallahu 'Alaihi Wasallam, sang pendidik agung yang telah membawa umat manusia dari kegelapan kejahiliyah menuju cahaya petunjuk Ilahi.
            </p>

            <!-- Section: Benih Dakwah -->
            <div class="mt-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 pb-3 border-b-2 border-emerald-100 flex items-center">
                    <svg class="w-8 h-8 text-emerald-600 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Benih Dakwah di Tengah Umat
                </h2>
                <p>
                    Sejarah berdirinya sebuah institusi pendidikan Islam tradisional, atau pesantren, sejatinya bukanlah sekadar catatan tentang pendirian bangunan fisik semata, melainkan untaian narasi panjang tentang keikhlasan, pengorbanan, dan dedikasi yang mendalam terhadap kemaslahatan umat. Pesantren ini lahir dari rahim semangat dakwah yang murni, kepedulian yang tulus terhadap pendidikan Islam, dan rasa tanggung jawab sosial yang tinggi terhadap masyarakat sekitar.
                </p>
                <p class="mt-6">
                    Pada masa awal perintisannya, kondisi masyarakat sedang dihadapkan pada tantangan kehausan spiritual dan kebutuhan akan bimbingan keagamaan yang terarah. Di tengah realitas sosial tersebut, muncul secercah harapan dari para ulama, sesepuh, dan keluarga besar masyarakat setempat untuk membangun sebuah tatanan generasi baru—generasi yang tidak hanya cerdas secara intelektual, namun juga memiliki kedalaman ilmu agama (<em class="font-serif">tafaqquh fiddin</em>), keluhuran budi pekerti (<em class="font-serif">akhlakul karimah</em>), serta rasa cinta yang mendalam terhadap ajaran agama.
                </p>
            </div>

            <!-- Section: Awal Mula Perjalanan -->
            <div class="mt-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 pb-3 border-b-2 border-emerald-100 flex items-center">
                    <svg class="w-8 h-8 text-emerald-600 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Awal Mula Perjalanan Pesantren
                </h2>
                
                <!-- Highlight Box (Timeline Ringkas) -->
                <div class="md:float-right md:w-1/3 bg-gray-50 border border-gray-100 rounded-2xl p-6 md:ml-8 mb-6 shadow-sm">
                    <h4 class="font-bold text-emerald-900 mb-4 text-lg border-b border-emerald-100 pb-2">Jejak Transformasi</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500 mt-2.5 mr-3"></span>
                            <span class="text-sm text-gray-700 leading-relaxed">Kegiatan mengaji sederhana di surau masyarakat</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500 mt-2.5 mr-3"></span>
                            <span class="text-sm text-gray-700 leading-relaxed">Berdirinya Madrasah Diniyah Takmiliyah (MDT)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500 mt-2.5 mr-3"></span>
                            <span class="text-sm text-gray-700 leading-relaxed">Perkembangan menjadi Madrasah Tsanawiyah (MTs) Filial</span>
                        </li>
                    </ul>
                </div>

                <p>
                    Setiap perjalanan besar selalu bermula dari langkah pertama yang bersahaja. Demikian pula dengan institusi pendidikan yang mulia ini. Jauh sebelum berdiri megah dengan berbagai fasilitas yang memadai seperti saat ini, embrio pesantren ini bermula dari kegiatan mengaji alif-ba-ta yang sangat sederhana di lingkungan masyarakat sekitar. Di bilik-bilik surau yang bersahaja, lantunan ayat-ayat suci Al-Qur'an mulai bergema dari lisan-lisan tulus para santri.
                </p>
                <p class="mt-6">
                    Pada masa itu, jumlah santri yang datang untuk belajar masih sangat sedikit. Kegiatan belajar mengajar dilakukan dengan segala kesederhanaan, duduk bersila di atas tikar, tanpa fasilitas mewah maupun kurikulum formal. Namun, justru dari kesederhanaan itulah terpancar semangat keikhlasan dan perjuangan yang luar biasa. Hubungan antara sang guru dan santri terjalin sangat erat karena ikatan kasih sayang.
                </p>
                <p class="mt-6">
                    Seiring berjalannya waktu, majelis pengajian kecil tersebut perlahan bertransformasi. Berawal dari hadirnya <strong>Madrasah Diniyah Takmiliyah (MDT)</strong>, lembaga ini mulai menata sistem pendidikan agama yang lebih terstruktur bagi masyarakat. Kehadiran MDT menjadi tonggak sejarah penting berdirinya pendidikan formal di kemudian hari.
                </p>
                <p class="mt-6">
                    Langkah besar berikutnya adalah mendirikan <strong>Madrasah Tsanawiyah (MTs)</strong>. Masa-masa awal berdirinya MTs adalah saksi bisu dari beratnya perjuangan. Pada saat itu, madrasah ini masih berstatus <em>filial</em> atau menumpang pada lembaga lain karena keterbatasan sarana dan ruang kelas. Suasana belajar sangat sederhana dengan fasilitas yang serba terbatas. Namun, semangat perjuangan para guru dan masyarakat sekitar tak pernah padam untuk mewujudkan lembaga pendidikan Islam yang mandiri.
                </p>
            </div>

            <!-- Section: Pilar Perjuangan -->
            <div class="mt-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 pb-3 border-b-2 border-emerald-100 flex items-center">
                    <svg class="w-8 h-8 text-emerald-600 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Pilar-Pilar Perjuangan: Musyawarah dan Syuro
                </h2>
                
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-6 rounded-r-lg mb-8">
                    <p class="text-emerald-900 font-medium text-lg leading-relaxed">
                        Pesantren ini tidak didirikan oleh satu orang saja, melainkan hasil perjuangan tulus beberapa sesepuh, keluarga besar, alim ulama, dan tokoh masyarakat melalui jalan musyawarah.
                    </p>
                </div>
                
                <p>
                    Institusi ini bukanlah menara gading yang dibangun oleh satu tangan, melainkan sebuah benteng umat yang ditegakkan melalui semangat musyawarah, perjuangan kolektif, dan gotong royong (<em class="font-serif">ta'awun</em>).
                </p>
                <p class="mt-6">
                    Tercatat dengan penuh rasa hormat, nama-nama agung yang memotori pergerakan ini di antaranya adalah <strong>[Nama Sesepuh 1]</strong> dan <strong>[Nama Sesepuh 2]</strong>, yang dengan keluasan ilmu dan kewibawaannya menjadi kompas penunjuk arah bagi gerak langkah pesantren. Bersama dengan mereka, dukungan yang sangat luar biasa datang dari <strong>[Keluarga Besar Pendiri]</strong> yang telah dengan lapang dada membuka pintu pengorbanan demi tegaknya panji pendidikan Islam.
                </p>
                <p class="mt-6">
                    Setiap pihak memiliki kontribusi nyata—baik berupa pemikiran strategis, wakaf tanah dan harta, maupun pengorbanan waktu dan tenaga secara langsung untuk pembangunan fisik ruang kelas. Semangat kolektif ini membuktikan bahwa pesantren adalah milik umat, dibangun oleh umat, dan didedikasikan sepenuhnya untuk kemaslahatan umat.
                </p>
            </div>

            <!-- Section: Perjuangan Pendiri -->
            <div class="mt-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 pb-3 border-b-2 border-emerald-100 flex items-center">
                    <svg class="w-8 h-8 text-emerald-600 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Perjuangan Tanpa Kenal Lelah
                </h2>
                <p>
                    Mengenang sejarah pesantren berarti merenungi kembali lautan peluh, tetesan air mata, dan panjangnya untaian doa di keheningan sepertiga malam. Para pendiri merintis pesantren ini dari keadaan yang serba terbatas dan himpitan ekonomi masyarakat di masa itu.
                </p>
                <p class="mt-6">
                    Semangat keikhlasan tergambar jelas dalam dedikasi para guru dan pengurus. Mereka mengajar bukan untuk mencari kemewahan dunia, melainkan menjadikannya sebagai ladang ibadah. Dalam kondisi sarana fisik yang belum memadai, mereka tidak pernah menyerah. Mereka ikut bergotong-royong membangun ruang kelas dan asrama demi kenyamanan santri-santrinya.
                </p>
                <p class="mt-6">
                    Lebih dari sekadar perjuangan fisik, para pendiri juga berjuang keras mempertahankan tradisi keilmuan Islam agar tidak tergerus zaman. Di tengah segala keterbatasan, mereka gigih menanamkan nilai-nilai akhlakul karimah dan kemandirian. Perjuangan para guru menjaga keberlangsungan pendidikan di masa sulit adalah bukti nyata dari kokohnya niat karena Allah Ta'ala.
                </p>
            </div>

            <!-- Section: Nilai dan Warisan -->
            <div class="mt-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 pb-3 border-b-2 border-emerald-100 flex items-center">
                    <svg class="w-8 h-8 text-emerald-600 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Menjaga Amanah: Nilai dan Warisan
                </h2>
                <p>
                    Hari ini, pesantren telah tumbuh menjadi lembaga pendidikan Islam yang tertata dengan fasilitas memadai dan jumlah santri yang terus bertambah dari masa ke masa. Kita wajib menyadari bahwa semua ini adalah warisan dan amanah luhur. Pesantren terus berkembang melangkah maju, namun tetap memegang teguh identitas aslinya.
                </p>
                <p class="mt-6">
                    Nilai-nilai keilmuan pesantren salaf dipadukan dengan harmonis dengan kecakapan modern; pembinaan akhlak terus menjadi prioritas utama; serta kedisiplinan dan pengabdian kepada masyarakat terus menjadi denyut nadi program pesantren. Segala capaian hari ini merupakan manifestasi dari perjuangan panjang para pendiri, dukungan setia keluarga besar pesantren, serta doa masyarakat.
                </p>
            </div>

            <!-- Section: Penutup -->
            <div class="mt-16 bg-gradient-to-br from-emerald-900 to-emerald-700 rounded-3xl p-8 md:p-12 text-white shadow-xl text-center relative overflow-hidden">
                <!-- Aksen Dekoratif -->
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
                
                <svg class="w-12 h-12 mx-auto text-emerald-300 opacity-60 mb-6 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"></path>
                </svg>
                
                <h3 class="text-2xl md:text-3xl font-bold mb-6 relative z-10">Melanjutkan Estafet Perjuangan</h3>
                
                <p class="text-lg md:text-xl text-emerald-100 font-light leading-relaxed mb-8 max-w-2xl mx-auto relative z-10">
                    "Kisah keteladanan para pendiri adalah sebuah kompas yang mengarahkan pandangan kita, serta sebuah cambuk yang menyemangati jiwa kita untuk tidak pernah lelah dalam mendidik dan berdakwah di jalan Allah."
                </p>
                
                <p class="text-emerald-50 mb-8 max-w-3xl mx-auto leading-relaxed relative z-10">
                    Semoga Allah Subhanahu wa Ta'ala menerima segala amal bakti, pengorbanan harta, waktu, tenaga, dan pikiran dari <strong>[Nama Sesepuh 1]</strong>, <strong>[Nama Sesepuh 2]</strong>, <strong>[Keluarga Besar Pendiri]</strong>, serta seluruh pihak yang berjasa. Semoga setiap lantunan Al-Qur'an dan kaji kitab para santri menjadi amal jariyah yang menerangi alam kubur mereka tanpa henti.
                </p>
                
                <div class="inline-block border-t border-emerald-500/50 pt-6 mt-2 relative z-10">
                    <p class="font-bold text-white tracking-wide uppercase text-sm sm:text-base">
                        Mari kita jaga amanah ini, pertahankan keberkahan ilmu,<br class="hidden sm:block"> dan teruskan langkah dakwah ini hingga akhir zaman.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
