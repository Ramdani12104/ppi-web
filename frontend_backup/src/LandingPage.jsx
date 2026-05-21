import React, { useState, useEffect } from 'react';

// 1. IMPORT FOTO (PASTIKAN NAMA FILE DI WINDOWS SUDAH TANPA SPASI: hero1, hero2, hero3)
import hero1 from "./assets/hero1.jfif";
import hero2 from "./assets/hero2.jfif";
import hero3 from "./assets/hero3.jfif";

export default function LandingPage() {
  const [slide, setSlide] = useState(0);
  
  // Masukkan hasil import ke dalam array slides
  const slides = [hero1, hero2, hero3];

  // 2. LOGIKA SLIDE (Cukup SATU saja supaya tidak tabrakan)
  useEffect(() => {
    const timer = setInterval(() => {
      setSlide((prev) => (prev === slides.length - 1 ? 0 : prev + 1));
    }, 5000); // Pindah setiap 5 detik
    return () => clearInterval(timer);
  }, [slides.length]);

  return (
    <div className="font-sans antialiased bg-[#FDFDFD] text-slate-700 flex flex-col min-h-screen w-full overflow-x-hidden">

      {/* --- NAVBAR STYLE PERSIS  --- */}
      <nav className="fixed w-full top-0 bg-white shadow-xl z-1000 border-b-[6px] border-emerald-700">
        <div className="max-w-7xl mx-auto px-4 md:px-6 h-28 flex justify-between items-center">
          
          {/* SISI KIRI: LOGO KOMPLIT */}
          <div className="flex items-center gap-4 shrink-0">
            <div className="bg-emerald-800 text-white w-16 h-16 flex items-center justify-center rounded-2xl font-black text-3xl shadow-lg border-2 border-emerald-500">
              104
            </div>
            <div className="flex flex-col text-left border-l-2 border-slate-200 pl-4">
              <span className="text-[11px] font-black tracking-[0.2em] text-emerald-800 leading-tight uppercase">Pesantren Persatuan Islam 104</span>
              <span className="text-2xl font-black text-slate-800 leading-none uppercase tracking-tighter">Al-Ittihad Cikajang</span>
              <span className="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest italic">Melayani Masyarakat Menuju Ridho Allah</span>
            </div>
          </div>

          {/* SISI KANAN: MENU */}
          <div className="hidden lg:flex items-center gap-1">
            {[
              { n: 'Beranda', i: '🏠', d: 'Selamat Datang' },
              { n: 'Profil', i: '🏢', d: 'Pesantren', drop: ['Sejarah', 'Tokoh Pendiri', 'Visi & Misi', 'Struktur', 'Sarana'] },
              { n: 'Program', i: '📚', d: 'Pendidikan', drop: ['KOBER', 'RA', 'SDIT', 'MDT', 'MTS', 'MA'] },
              { n: 'Berita', i: '📰', d: 'Informasi' },
              { n: 'Kontak', i: '📞', d: 'Hubungi Kami' }
            ].map((item) => (
              <div key={item.n} className="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                <div className="flex flex-col items-center">
                  <span className="text-xl mb-1">{item.i}</span>
                  <span className="text-[12px] font-black uppercase text-slate-800 leading-none">{item.n}</span>
                  <span className="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">{item.d}</span>
                </div>
                
                {item.drop && (
                  <div className="absolute top-[90%] left-1/2 -translate-x-1/2 pt-6 hidden group-hover:block w-56 z-1001">
                    <div className="bg-white shadow-[0_20px_50px_rgba(0,0,0,0.2)] rounded-2xl border-t-4 border-emerald-700 overflow-hidden flex flex-col p-2">
                      {item.drop.map((sub) => (
                        <a key={sub} href="#" className="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left">
                          {sub}
                        </a>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            ))}

            {/* PSB & WA */}
            <div className="ml-4 flex items-center gap-4 border-l-2 border-slate-100 pl-6">
              <div className="flex flex-col items-center group bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-100 transition-all hover:bg-emerald-100">
                <span className="text-xl">📝</span>
                <span className="text-[12px] font-black text-emerald-800 uppercase">PSB</span>
                <span className="text-[9px] font-bold text-emerald-600/60 leading-none uppercase">26/27</span>
              </div>
              
              <div className="bg-[#25D366] text-white p-4 rounded-2xl shadow-xl">
                <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
              </div>
            </div>
          </div>
        </div>
      </nav>
      
      <div className="h-28"></div>

      {/* --- HERO SECTION --- */}
      <section className="relative h-screen min-h-700px w-full flex items-center justify-center overflow-hidden">
        
        <div className="absolute inset-0 z-0">
          {slides.map((img, index) => (
            <div
              key={index}
              className={`absolute inset-0 transition-opacity duration-1000 ease-in-out ${
                slide === index ? "opacity-100" : "opacity-0"
              }`}
            >
              <img 
                src={img} 
                className="w-full h-full object-cover" 
                alt={`Slide ${index}`} 
                onError={(e) => { e.target.src = "https://picsum.photos/1920/1080"; }}
              />
              <div className="absolute inset-0 bg-black/50 backdrop-blur-[1px]"></div>
            </div>
          ))}
        </div>

        <div className="relative z-10 max-w-5xl px-6 text-center text-white">
          <div className="space-y-1 mb-6">
            <h2 className="text-lg md:text-2xl font-medium tracking-[0.3em] uppercase opacity-90">
              Pesantren Persatuan Islam 104
            </h2>
            <h1 className="text-5xl md:text-8xl font-black tracking-tighter uppercase leading-tight">
              Al - Ittihaad <span className="text-emerald-400">Cikajang</span>
            </h1>
          </div>

          <div className="mb-12">
            <p className="text-sm md:text-xl text-emerald-50/80 max-w-3xl mx-auto font-medium leading-relaxed italic border-t border-b border-white/20 py-4">
              "Membentuk generasi islami, beradab, dan berprestasi melalui pendidikan pesantren yang terpadu"
            </p>
          </div>
          
          <div className="flex justify-center">
            <button className="bg-emerald-600 hover:bg-emerald-500 text-white px-12 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-emerald-800">
              Daftar Sekarang
            </button>
          </div>
        </div>

        <div className="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
          {slides.map((_, i) => (
            <div 
              key={i} 
              className={`h-2 transition-all duration-500 rounded-full ${slide === i ? "w-10 bg-emerald-500" : "w-2 bg-white/40"}`}
            />
          ))}
        </div>
      </section>

     

      {/* SAMBUTAN */}
      {/* --- SECTION VIDEO PROFIL --- */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full grid md:grid-cols-2 gap-12 items-center">
          
          {/* KIRI: VIDEO */}
          <div className="rounded-3xl overflow-hidden shadow-xl aspect-video bg-slate-100">
            <iframe 
              className="w-full h-full" 
              src="https://www.youtube.com/embed/6fRorJATZbk?si=s_ea4XFLs-BtbFMK" 
              title="Profil PPI 104 Al-Ittihad" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
              allowFullScreen
              frameBorder="0"
            ></iframe>
          </div>

          {/* KANAN: TEKS */}
          <div className="flex flex-col items-start text-left space-y-6">
            <div className="flex items-center gap-3">
              <div className="bg-emerald-600 w-2 h-8 rounded-full"></div>
              <h2 className="text-3xl font-black text-slate-800 uppercase tracking-tight">Mengenal Kami</h2>
            </div>
            <p className="text-slate-600 leading-relaxed font-medium max-w-xl">
              Simak video profil singkat perjalanan Pesantren Persatuan Islam 104 Al-Ittihad Cikajang dalam membentuk generasi yang beraqidah lurus dan berwawasan luas sesuai dengan tuntunan Al-Qur'an dan As-Sunnah.
            </p>
            <button className="bg-emerald-600 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-all">
              Selengkapnya Tentang Kami
            </button>
          </div>

        </div>
      </section>

      {/* SECTION: PROGRAM PENDIDIKAN (REVISI CENTERED & TANPA TAHFIDZ) */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6">
          
          {/* Header & Deskripsi - SEMUANYA CENTER */}
          <div className="mb-20 text-center flex flex-col items-center">
            <div className="flex items-center gap-3 mb-4 justify-center">
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
              <h2 className="text-3xl md:text-4xl font-black text-slate-800 uppercase tracking-tight">Jenjang Pendidikan</h2>
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
            </div>
            <p className="text-slate-600 max-w-3xl leading-relaxed font-medium text-base md:text-lg mt-4">
              Di Pesantren Persatuan Islam 104 Al-Ittihad Cikajang, kami menyelenggarakan sistem pendidikan berjenjang yang memadukan kurikulum nasional dengan kurikulum kepesantrenan yang khas. Fokus kami adalah mencetak generasi yang tidak hanya cerdas secara intelektual, tetapi juga memiliki kedalaman adab dan keteguhan iman sesuai Al-Qur'an dan As-Sunnah.
            </p>
          </div>

          {/* Grid Foto Jenjang - SEKARANG 6 ITEM (TANPA TAHFIDZ) */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            {[
              { n: 'KOBER', d: 'Kelompok Bermain untuk anak usia dini dengan pendekatan bermain sambil belajar nilai-nilai dasar Islam.', img: hero1 },
              { n: 'RA (Raudhatul Athfal)', d: 'Tingkat taman kanak-kanak yang menitikberatkan pada pembiasaan ibadah harian dan pengenalan huruf hijaiyah.', img: hero2 },
              { n: 'SDIT', d: 'Sekolah Dasar Islam Terpadu dengan integrasi ilmu umum dan penguatan hafalan Al-Qur\'an sejak dini.', img: hero3 },
              { n: 'Madrasah Diniyah', d: 'Program Takmiliyah untuk pendalaman ilmu alat, fiqih, dan aqidah yang dilaksanakan pada siang/sore hari.', img: hero1 },
              { n: 'Madrasah Tsanawiyah', d: 'Jenjang menengah pertama dengan lingkungan asrama yang mendukung kemandirian dan penguasaan bahasa Arab.', img: hero2 },
              { n: 'Madrasah Aliyah', d: 'Pendidikan menengah atas sebagai persiapan studi lanjut dan kaderisasi kepemimpinan umat.', img: hero3 },
            ].map((item, i) => (
              <div key={i} className="group relative h-320px rounded-2rem overflow-hidden shadow-2xl cursor-pointer">
                {/* Gambar Background */}
                <img 
                  src={item.img} 
                  className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                  alt={item.n} 
                />
                
                {/* Overlay Hijau Khas Persis */}
                <div className="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-900/40 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>

                {/* Konten Teks */}
                <div className="absolute inset-0 p-10 flex flex-col justify-end items-center text-center">
                  <h3 className="text-white font-black text-2xl mb-2 transform transition-transform duration-500 group-hover:-translate-y-2 uppercase tracking-tight">
                    {item.n}
                  </h3>
                  <div className="w-16 h-1 bg-emerald-400 mb-4 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                  <p className="text-white/0 group-hover:text-white/90 text-[11px] leading-relaxed transition-all duration-500 opacity-0 group-hover:opacity-100 line-clamp-3 font-medium">
                    {item.d}
                  </p>
                  
                  <div className="mt-6 overflow-hidden h-0 group-hover:h-10 transition-all duration-500">
                    <button className="bg-white text-emerald-900 text-[10px] font-black px-6 py-2.5 rounded-xl uppercase tracking-widest shadow-xl">
                      Selengkapnya
                    </button>
                  </div>
                </div>
              </div>
            ))}
          </div>

        </div>
      </section>

      {/* SECTION: PROGRAM PESANTREN (KHUSUS UNIT & KEGIATAN) */}
      <section className="py-24 bg-slate-50">
        <div className="max-w-7xl mx-auto px-6">
          
          {/* Header & Deskripsi - Center Style */}
          <div className="mb-16 text-center flex flex-col items-center">
            <div className="flex items-center gap-3 mb-4 justify-center">
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
              <h2 className="text-3xl md:text-4xl font-black text-slate-800 uppercase tracking-tight">Program Pesantren</h2>
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
            </div>
            <p className="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
              Selain pendidikan formal, kami membekali santri dengan berbagai program unggulan untuk mengasah spiritual, kemandirian, dan kreativitas guna mencetak kader umat yang mutafaqqih fidding.
            </p>
          </div>

          {/* Grid Program Pesantren */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {[
              { 
                n: 'Raudhatul Hufadz (RH)', 
                d: 'Unit khusus pencetak penghafal Al-Qur\'an dengan pendampingan intensif dan metode mutqin.', 
                i: '🕌', 
                color: 'from-emerald-500 to-emerald-700' 
              },
              { 
                n: 'Revitalisasi Al-Qur\'an', 
                d: 'Program peningkatan kualitas bacaan dan pemahaman Al-Qur\'an bagi seluruh santri secara sistematis.', 
                i: '📖', 
                color: 'from-blue-500 to-blue-700' 
              },
              { 
                n: 'Brigade Santri', 
                d: 'Wadah kedisiplinan dan kepanduan untuk membentuk mental yang kuat, tangkas, dan berjiwa kepemimpinan.', 
                i: '🛡️', 
                color: 'from-slate-700 to-slate-900' 
              },
              { 
                n: 'Poskestren', 
                d: 'Pos Kesehatan Pesantren yang melayani kesehatan santri sekaligus edukasi pola hidup bersih dan sehat.', 
                i: '🏥', 
                color: 'from-red-500 to-red-700' 
              },
              { 
                n: 'Jurnalistik', 
                d: 'Pelatihan literasi, kepenulisan, dan media untuk mengasah kemampuan dakwah santri di era digital.', 
                i: '✍️', 
                color: 'from-orange-500 to-orange-700' 
              },
              { 
                n: 'Program Lainnya', 
                d: 'Berbagai kegiatan ekstrakurikuler dan pengembangan bakat yang akan terus bertambah sesuai kebutuhan santri.', 
                i: '✨', 
                color: 'from-purple-500 to-purple-700' 
              },
            ].map((prog, i) => (
              <div key={i} className="bg-white rounded-2rem p-8 shadow-xl shadow-slate-200 border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group">
                {/* Dekorasi Pojok */}
                <div className={`absolute top-0 right-0 w-24 h-24 bg-gradient-to-br ${prog.color} opacity-10 rounded-bl-[5rem] transition-all group-hover:scale-150`}></div>
                
                <div className="relative z-10">
                  <div className={`w-14 h-14 bg-gradient-to-br ${prog.color} rounded-2xl flex items-center justify-center text-3xl shadow-lg mb-6`}>
                    {prog.i}
                  </div>
                  <h3 className="text-xl font-black text-slate-800 mb-3 uppercase tracking-tight leading-tight">
                    {prog.n}
                  </h3>
                  <p className="text-sm text-slate-500 leading-relaxed font-medium">
                    {prog.d}
                  </p>
                </div>

                <div className="mt-8 pt-6 border-t border-slate-50 flex justify-between items-center">
                  <span className="text-[10px] font-black text-slate-300 uppercase tracking-widest">PPI 104 Unit</span>
                  <div className={`w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors`}>
                    →
                  </div>
                </div>
              </div>
            ))}
          </div>

        </div>
      </section>

      {/* EKSTRAKURIKULER (Desain yang kamu suka) */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full text-center">
          <div className="mb-16 space-y-4">
            <span className="text-emerald-600 font-bold tracking-[0.2em] text-xs uppercase">Aktivitas Santri</span>
            <h2 className="text-4xl font-bold text-slate-900">Ekstrakurikuler Terpadu</h2>
            <div className="flex justify-center w-full">
              <p className="text-slate-500 max-w-2xl text-center">
                Kegiatan pengembangan bakat dan minat yang tersedia di seluruh jenjang pendidikan mulai dari tingkat dasar hingga menengah.
              </p>
            </div>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {[
              { nama: "Pramuka", jenjang: "SDIT, MTS, MA", icon: "🏕️", color: "bg-orange-50 text-orange-700 border-orange-100" },
              { nama: "Olahraga", jenjang: "Semua Jenjang", icon: "⚽", color: "bg-blue-50 text-blue-700 border-blue-100" },
              { nama: "Seni & Kaligrafi", jenjang: "MDT, MTS, MA", icon: "🎨", color: "bg-purple-50 text-purple-700 border-purple-100" },
              { nama: "Hadroh", jenjang: "MTS, MA", icon: "🥁", color: "bg-emerald-50 text-emerald-700 border-emerald-100" },
              { nama: "Pencak Silat", jenjang: "SDIT, MTS, MA", icon: "🥋", color: "bg-red-50 text-red-700 border-red-100" },
              { nama: "Marching Band", jenjang: "MTS, MA", icon: "🎺", color: "bg-indigo-50 text-indigo-700 border-indigo-100" },
              { nama: "PMI / UKS", jenjang: "MTS, MA", icon: "🏥", color: "bg-rose-50 text-rose-700 border-rose-100" },
              { nama: "Tahfidz Camp", jenjang: "Semua Jenjang", icon: "📖", color: "bg-teal-50 text-teal-700 border-teal-100" }
            ].map((eskul, i) => (
              <div key={i} className={`p-8 rounded-3xl border ${eskul.color} transition-all hover:shadow-xl hover:-translate-y-2 group flex flex-col items-center text-center`}>
                <div className="text-5xl mb-5 group-hover:scale-110 transition-transform">{eskul.icon}</div>
                <h4 className="text-xl font-bold mb-1">{eskul.nama}</h4>
                <p className="text-[10px] font-bold uppercase tracking-widest opacity-60">{eskul.jenjang}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* FASILITAS (Desain yang kamu suka) */}
      <section className="py-24 px-6 bg-[#F8FAFC] flex justify-center w-full">
        <div className="max-w-7xl w-full text-center">
          <div className="mb-16 space-y-4">
            <span className="text-emerald-600 font-bold tracking-[0.2em] text-xs uppercase">Kenyamanan Santri</span>
            <h2 className="text-4xl font-bold text-slate-900">Fasilitas Pesantren</h2>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {[
              { nama: "Masjid Putra & Putri", icon: "🕌", desc: "Sarana ibadah luas dan terpisah." },
              { nama: "Asrama Nyaman", icon: "🏠", desc: "Hunian bersih dengan pengawasan asatidz." },
              { nama: "Ruang Kelas", icon: "🏫", desc: "Ruang belajar representatif & modern." },
              { nama: "Kantin Sehat", icon: "🍱", desc: "Makanan bergizi untuk harian santri." },
              { nama: "Kopontren", icon: "🛒", desc: "Koperasi penyedia kebutuhan santri." },
              { nama: "Lapangan Olahraga", icon: "🏀", desc: "Fasilitas olahraga terbuka luas." }
            ].map((fasil, i) => (
              <div key={i} className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group flex flex-col items-center">
                <div className="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                  {fasil.icon}
                </div>
                <h4 className="text-xl font-bold text-slate-800 mb-2">{fasil.nama}</h4>
                <p className="text-slate-500 text-sm">{fasil.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* BERITA (Layout Besar Kiri, Kecil Kanan) */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full">
          <h2 className="text-3xl font-bold text-slate-800 mb-12 text-left">Berita Terbaru</h2>
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {/* Berita Utama */}
            <div className="lg:col-span-2 text-left space-y-6 group cursor-pointer">
              <div className="rounded-2rem overflow-hidden aspect-video bg-slate-300">
                <img src="https://picsum.photos/1000/600?nature" className="w-full h-full object-cover group-hover:scale-105 transition-all" alt="Utama" />
              </div>
              <h3 className="text-3xl font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">Update Kegiatan Ramadan Camp PPI 104 Al-Ittihad 2026</h3>
              <p className="text-slate-500 text-lg leading-relaxed">Membentuk karakter santri yang beradab dan berprestasi di bulan suci...</p>
            </div>
            {/* Berita Kecil */}
            <div className="flex flex-col gap-8">
              {[1, 2, 3].map(b => (
                <div key={b} className="flex gap-4 items-start group cursor-pointer text-left">
                  <div className="w-24 h-24 bg-slate-200 rounded-2xl overflow-hidden shrink-0">
                    <img src={`https://picsum.photos/200/200?random=${b}`} className="w-full h-full object-cover group-hover:scale-110 transition-all" alt="Thumb" />
                  </div>
                  <div className="space-y-1">
                    <p className="text-xs text-emerald-600 font-bold uppercase">{b+19} April 2026</p>
                    <h4 className="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors leading-snug">Kunjungan Edukasi Santri ke Perpustakaan Nasional</h4>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

     {/* SECTION: TESTIMONI & ALUMNI */}
      <section className="py-24 bg-[#365555] relative overflow-hidden">
        {/* Dekorasi Cahaya Halus */}
        <div className="absolute top-0 right-0 w-500px h-500px bg-emerald-500/10 blur-[100px] rounded-full -mr-64 -mt-64"></div>
        <div className="absolute bottom-0 left-0 w-500px h-500px bg-emerald-500/5 blur-[100px] rounded-full -ml-64 -mb-64"></div>

        <div className="max-w-7xl mx-auto px-6 relative z-10">
           <div className="flex flex-col items-center text-center mb-16">
  <span className="text-emerald-400 font-black tracking-[0.3em] uppercase text-[10px] mb-4">
    Bukti Nyata
  </span>
            
            {/* Judul Sudah Putih & Satu Warna */}
            <h2 className="text-3xl md:text-5xl font-black !text-white uppercase tracking-tight">
    Apa Kata Mereka?
  </h2>
  <div className="w-20 h-1.5 bg-emerald-500 mt-6 rounded-full">
</div>

            {/* Paragraf Sudah Rata Tengah & Kontras */}
            <p className="text-white/90 mt-6 max-w-2xl mx-auto font-medium leading-relaxed text-center">
              Dari orang tua yang mempercayakan amanahnya, hingga alumni yang kini berkiprah di tengah umat.
            </p>
          </div>

          <div className="grid lg:grid-cols-2 gap-12">
            {/* LANJUTAN ISI TESTIMONI KAMU DI SINI (Jangan Dihapus) */}
            
            {/* KOLOM 1: KATA ORANG TUA */}
            <div className="space-y-6">
              <h3 className="text-emerald-400 font-black flex items-center gap-3 mb-8">
                <span className="bg-emerald-400/20 p-2 rounded-lg text-lg">👨‍👩‍👧‍👦</span> KESAN ORANG TUA
              </h3>
              {[
                { 
                  nama: "H. Ahmad Fauzi", 
                  status: "Wali Santri MA",
                  kata: "Perubahan adab anak saya sangat terasa. Sekarang jauh lebih mandiri dan ibadahnya lebih terjaga. Terima kasih PPI 104.",
                },
                { 
                  nama: "Ibu Siti Rohmah", 
                  status: "Wali Santri MTs",
                  kata: "Sangat bersyukur menyekolahkan anak di sini. Lingkungannya sangat kekeluargaan dan gurunya sangat peduli pada tiap santri.",
                }
              ].map((t, i) => (
                <div key={i} className="bg-white/5 backdrop-blur-sm p-8 rounded-2rem border border-white/10 hover:border-emerald-500/50 transition-all">
                  {/* Teks Testi: Pakai warna Putih agar tajam */}
                  <p className="text-white italic text-sm leading-relaxed mb-6">"{t.kata}"</p>
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-emerald-700 rounded-full flex items-center justify-center font-bold text-white shadow-lg">{t.nama[0]}</div>
                    <div>
                      <h4 className="text-white font-bold text-sm">{t.nama}</h4>
                      <p className="text-emerald-400 text-[10px] font-black uppercase tracking-wider">{t.status}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>

            {/* KOLOM 2: KATA ALUMNI */}
            <div className="space-y-6">
              <h3 className="text-emerald-400 font-black flex items-center gap-3 mb-8">
                <span className="bg-emerald-400/20 p-2 rounded-lg text-lg">🎓</span> JEJAK ALUMNI
              </h3>
              {[
                { 
                  nama: "Ustadz Lukman Hakim", 
                  status: "Alumni 2018 - Mahasiswa Al-Azhar Mesir",
                  kata: "Bekal bahasa Arab dan hafalan Qur'an dari PPI 104 menjadi kunci utama saya bisa melanjutkan studi ke Timur Tengah dengan lancar.",
                },
                { 
                  nama: "Dr. Wildan Fauzi", 
                  status: "Alumni 2012 - Praktisi Kesehatan",
                  kata: "Pelajaran tentang kedisiplinan dan amanah di pesantren sangat membantu saya dalam menjalani profesi saya sekarang sebagai dokter.",
                }
              ].map((a, i) => (
                <div key={i} className="bg-emerald-900/40 backdrop-blur-sm p-8 rounded-2rem border border-emerald-500/20 hover:bg-emerald-900/60 transition-all shadow-xl">
                  {/* Teks Alumni: Pakai warna Putih agar tajam */}
                  <p className="text-white italic text-sm leading-relaxed mb-6">"{a.kata}"</p>
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center font-bold text-emerald-950 shadow-lg">{a.nama[0]}</div>
                    <div>
                      <h4 className="text-white font-bold text-sm">{a.nama}</h4>
                      <p className="text-emerald-300 text-[10px] font-black uppercase tracking-tighter">{a.status}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>

          </div>

          <div className="mt-20 text-center">
            <button className="border border-emerald-500/30 text-emerald-400 px-10 py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-emerald-500 hover:text-white transition-all shadow-lg hover:shadow-emerald-500/20">
              Lihat Semua Cerita Sukses
            </button>
          </div>
        </div>
      </section>

{/* SECTION LOKASI: INFO KIRI & MAPS TITIK MERAH KANAN */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6">
          
          <div className="grid lg:grid-cols-2 gap-12 items-center bg-slate-50 p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm">
            
            {/* --- KOLOM KIRI: INFO ALAMAT & KONTAK --- */}
            <div className="space-y-8 text-left">
              <div>
                <span className="text-emerald-600 font-black tracking-[0.3em] uppercase text-[10px] mb-3 block">Informasi Lokasi</span>
                <h2 className="text-3xl md:text-5xl font-black text-slate-800 uppercase tracking-tighter mb-6">PPI 104 Cikajang</h2>
                <div className="w-20 h-1.5 bg-emerald-600 rounded-full mb-8"></div>
                
                <h3 className="text-xl font-bold text-slate-800 mb-2">Alamat Lengkap</h3>
                <p className="text-slate-600 leading-relaxed font-medium">
                  Pesantren Persatuan Islam 104 Cikajang<br />
                  Kp. Rancapandan, Ds. Mekarjaya, Kec. Cikajang,<br />
                  Kabupaten Garut, Jawa Barat 44171.
                </p>
              </div>

              {/* Detail Kontak */}
              <div className="space-y-4">
                <div className="flex items-center gap-4 text-slate-700">
                  <div className="bg-white p-3 rounded-2xl shadow-sm text-emerald-600">📞</div>
                  <span className="font-bold">+62 262 2579254</span>
                </div>
                <div className="flex items-center gap-4 text-slate-700">
                  <div className="bg-white p-3 rounded-2xl shadow-sm text-emerald-600">📧</div>
                  <span className="font-bold">info@alittihad104.sch.id</span>
                </div>
              </div>

              {/* Tombol ke Google Maps App */}
              <a 
                href="https://www.google.com/maps/dir//Pesantren+Persatuan+Islam+104+Cikajang,+Kp.+Rancapandan,+Mekarjaya,+Cikajang,+Garut+Regency,+West+Java+44171/@-7.447544,107.789125,17z" 
                target="_blank" 
                rel="noopener noreferrer"
                className="inline-flex items-center justify-center bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20"
              >
                Petunjuk Arah (Maps)
              </a>
            </div>

            {/* --- KOLOM KANAN: PETA DENGAN TITIK MERAH PAS --- */}
            <div className="w-full h-[500px] rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white bg-white">
             <iframe 
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.128711311545!2d107.75626247395026!3d-7.45097457342898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e669da7cfc90421%3A0x68c60abeabbaca8c!2sPesantren%20Persatuan%20Islam%20104%20Cikajang!5e0!3m2!1sid!2sid!4v1713686000000!5m2!1sid!2sid"
  width="100%" 
  height="100%" 
  style={{ border: 0 }} 
  allowFullScreen={true} 
  loading="lazy" 
  referrerPolicy="no-referrer-when-downgrade"
  title="Lokasi PPI 104 Cikajang"
></iframe>
            </div>

          </div>
        </div>
      </section>

      {/* FOOTER */}
      <footer className="bg-[#0f172a] text-slate-400 py-20 px-6">
        <div className="max-w-7xl mx-auto">
          <div className="grid md:grid-cols-3 gap-16 text-left">
            {/* Kolom 1: Branding */}
            <div>
              <div className="flex items-center gap-2 mb-6">
                <span className="bg-emerald-600 text-white font-bold p-2 rounded-lg text-[10px]">104</span>
                <h3 className="text-white text-lg font-black uppercase tracking-tighter">Al-Ittihad Cikajang</h3>
              </div>
              <p className="text-sm leading-relaxed font-medium">
                Membangun generasi Tafaqquh Fiddin yang unggul, beradab, dan berwawasan luas sesuai Al-Qur'an dan Sunnah.
              </p>
            </div>
            
            {/* Kolom 2: Navigasi */}
            <div className="flex flex-col gap-4">
              <h4 className="text-white font-bold text-sm uppercase tracking-widest mb-2">Navigasi</h4>
              {['Beranda', 'Program Pendidikan', 'Pendaftaran (PSB)', 'Profil Pesantren'].map((item) => (
                <a key={item} href="#" className="hover:text-emerald-400 transition-colors text-sm font-medium w-fit">{item}</a>
              ))}
            </div>

            {/* Kolom 3: Kontak */}
            <div>
              <h4 className="text-white font-bold text-sm uppercase tracking-widest mb-6">Kontak Kami</h4>
              <div className="space-y-4">
                <p className="text-sm flex flex-col">
                  <span className="text-xs text-slate-500 uppercase font-bold tracking-tighter mb-1">Alamat:</span>
                  Jl. Raya Cikajang No. 104, Garut
                </p>
                <p className="text-emerald-400 font-black text-xl">0838-2209-9034</p>
              </div>
            </div>
          </div>

          {/* Copyright Bottom */}
          <div className="mt-20 pt-8 border-t border-slate-800 text-center text-[10px] font-bold uppercase tracking-[0.3em] text-slate-600">
            © {new Date().getFullYear()} PPI 104 Al-Ittihad Cikajang. All Rights Reserved.
          </div>
        </div>
      </footer>

    </div> // PENUTUP DIV UTAMA
  );
};

//export default LandingPage;