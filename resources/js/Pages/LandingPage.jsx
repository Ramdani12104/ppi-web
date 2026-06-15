import React, { useState, useEffect, useRef } from 'react';
import { Link } from '@inertiajs/react';

// Import Assets
import hero1 from "./assets/hero1.jfif";
import hero2 from "./assets/hero2.jfif";
import hero3 from "./assets/hero3.jfif";

export default function LandingPage({ news, testimonials, programs, extracurriculars, settings, facilities, gallery }) {
  const [slide, setSlide] = useState(0);
  const [isScrolled, setIsScrolled] = useState(false);
  const [activeDropdown, setActiveDropdown] = useState(null);
  
  const fallbackTestimonials = [
    { id: 1, name: "H. Ahmad Fauzi", status: "Wali Santri MA", quote: "Perubahan adab anak saya sangat terasa. Sekarang jauh lebih mandiri dan ibadahnya lebih terjaga. Terima kasih PPI 104.", type: "Orang Tua", avatar: null },
    { id: 2, name: "Ibu Siti Rohmah", status: "Wali Santri MTs", quote: "Sangat bersyukur menyekolahkan anak di sini. Lingkungannya sangat kekeluargaan dan gurunya sangat peduli pada tiap santri.", type: "Orang Tua", avatar: null },
    { id: 3, name: "Ustadz Lukman Hakim", status: "Alumni 2018 - Mahasiswa Al-Azhar Mesir", quote: "Bekal bahasa Arab dan hafalan Qur'an dari PPI 104 menjadi kunci utama saya bisa melanjutkan studi ke Timur Tengah dengan lancar.", type: "Alumni", avatar: null },
    { id: 4, name: "Dr. Wildan Fauzi", status: "Alumni 2012 - Praktisi Kesehatan", quote: "Pelajaran tentang kedisiplinan dan amanah di pesantren sangat membantu saya dalam menjalani profesi saya sekarang sebagai dokter.", type: "Alumni", avatar: null }
  ];
  
  const listTestimonials = testimonials && testimonials.length > 0 ? testimonials : fallbackTestimonials;
  const [activeTestimonial, setActiveTestimonial] = useState(listTestimonials[0] || null);
  const sliderRef = useRef(null);

  useEffect(() => {
    if (listTestimonials.length > 0) {
      if (!activeTestimonial || !listTestimonials.some(t => t.id === activeTestimonial.id)) {
        setActiveTestimonial(listTestimonials[0]);
      }
    }
  }, [listTestimonials]);
  
  // Helper to resolve images (supports absolute paths, public storage paths, and imported assets)
  const resolveImage = (path, fallback) => {
    if (!path) return fallback;
    if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('data:') || path.startsWith('/') || path.startsWith('blob:')) {
      return path;
    }
    return (window.StorageUrl || '/storage/') + path;
  };

  // Helper to parse YouTube Video link to embed URL
  const getYoutubeEmbedUrl = (url) => {
    if (!url) return null;
    const regExp = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/;
    const match = url.match(regExp);
    return match ? `https://www.youtube.com/embed/${match[1]}` : url;
  };

  // Resolve individual slider background images with fallbacks
  const activeSliderImages = [];
  if (settings?.slider_image_1) activeSliderImages.push(settings.slider_image_1);
  if (settings?.slider_image_2) activeSliderImages.push(settings.slider_image_2);
  if (settings?.slider_image_3) activeSliderImages.push(settings.slider_image_3);

  // Fallback to legacy slider_images if no new individual images exist
  if (activeSliderImages.length === 0) {
    let legacyImages = [];
    try {
      legacyImages = settings?.slider_images ? JSON.parse(settings.slider_images) : [];
    } catch (e) {
      console.error("Failed to parse legacy slider_images", e);
    }
    if (legacyImages.length > 0) {
      activeSliderImages.push(...legacyImages);
    } else {
      activeSliderImages.push(hero1, hero2, hero3);
    }
  }

  let statsCards = [];
  try {
    statsCards = settings?.landing_stats_cards ? JSON.parse(settings.landing_stats_cards) : [];
  } catch (e) {
    console.error("Failed to parse landing_stats_cards", e);
  }

  let supportCards = [];
  try {
    supportCards = settings?.landing_support_cards ? JSON.parse(settings.landing_support_cards) : [];
  } catch (e) {
    console.error("Failed to parse landing_support_cards", e);
  }

  let levelCards = [];
  try {
    levelCards = settings?.landing_levels_cards ? JSON.parse(settings.landing_levels_cards) : [];
  } catch (e) {
    console.error("Failed to parse landing_levels_cards", e);
  }

  let programCards = [];
  try {
    programCards = settings?.landing_programs_cards ? JSON.parse(settings.landing_programs_cards) : [];
  } catch (e) {
    console.error("Failed to parse landing_programs_cards", e);
  }

  // Gallery items settings parsing removed - now loaded via model prop

  let historyTimeline = [];
  try {
    historyTimeline = settings?.landing_history_timeline ? JSON.parse(settings.landing_history_timeline) : [];
  } catch (e) {
    console.error("Failed to parse landing_history_timeline", e);
  }

  // Fallbacks for empty states
  const activeStatsCards = statsCards.length > 0 ? statsCards : [
    { icon: '👥', number: '1200', label: 'Total Santri Aktif' },
    { icon: '👨‍🏫', number: '65', label: 'Asatidz & Asatidzah' },
    { icon: '🏫', number: '6', label: 'Jenjang Pendidikan' },
    { icon: '🎓', number: '3500', label: 'Alumni Tersebar' }
  ];

  const activeSupportCards = supportCards.length > 0 ? supportCards : [
    {
      icon: '🏗️',
      title: 'Pembangunan Sarana',
      desc: 'Bantu hadirkan ruang kelas, asrama, dan fasilitas belajar yang lebih nyaman agar santri bisa beribadah dan menuntut ilmu dengan optimal.',
      link: '/dukungan/pembangunan'
    },
    {
      icon: '🎓',
      title: 'Beasiswa Santri',
      desc: 'Jadilah jalan kemudahan bagi santri berprestasi and dhuafa. Dukungan Anda menjaga semangat mereka untuk terus menghafal dan belajar.',
      link: '/dukungan/beasiswa'
    },
    {
      icon: '📖',
      title: 'Wakaf Pendidikan',
      desc: 'Salurkan wakaf tunai maupun aset untuk mendukung operasional dakwah pesantren. Amal yang pahalanya terus mengalir abadi.',
      link: '/dukungan'
    }
  ];

  const activeLevelCards = levelCards.length > 0 ? levelCards : [
    { title: 'KOBER', desc: 'Kelompok Bermain untuk anak usia dini dengan pendekatan bermain sambil belajar nilai-nilai dasar Islam.', image: '', link: '/program/kober' },
    { title: 'RA (Raudhatul Athfal)', desc: 'Tingkat taman kanak-kanak yang menitikberatkan pada pembiasaan ibadah harian dan pengenalan huruf hijaiyah.', image: '', link: '/program/ra' },
    { title: 'SDIT', desc: 'Sekolah Dasar Islam Terpadu dengan integrasi ilmu umum dan penguatan hafalan Al-Qur\'an sejak dini.', image: '', link: '/program/sdit' },
    { title: 'Madrasah Diniyah', desc: 'Program Takmiliyah untuk pendalaman ilmu alat, fiqih, dan aqidah yang dilaksanakan pada siang/sore hari.', image: '', link: '/program/mdt' },
    { title: 'Madrasah Tsanawiyah', desc: 'Jenjang menengah pertama dengan lingkungan asrama yang mendukung kemandirian dan penguasaan bahasa Arab.', image: '', link: '/program/mts' },
    { title: 'Madrasah Aliyah', desc: 'Pendidikan menengah atas sebagai persiapan studi lanjut dan kaderisasi kepemimpinan umat.', image: '', link: '/program/ma' }
  ];

  const activeProgramCards = programCards.length > 0 ? programCards : [
    { icon: '🕌', title: 'Raudhatul Hufadz (RH)', desc: 'Unit khusus pencetak penghafal Al-Qur\'an dengan pendampingan intensif dan metode mutqin.', color_gradient: 'from-emerald-500 to-emerald-700', link: '#' },
    { icon: '📖', title: 'Revitalisasi Al-Qur\'an', desc: 'Program peningkatan kualitas bacaan dan pemahaman Al-Qur\'an bagi seluruh santri secara sistematis.', color_gradient: 'from-blue-500 to-blue-700', link: '#' },
    { icon: '🛡️', title: 'Brigade Santri', desc: 'Wadah kedisiplinan dan kepanduan untuk membentuk mental yang kuat, tangkas, dan berjiwa kepemimpinan.', color_gradient: 'from-slate-700 to-slate-900', link: '#' },
    { icon: '🏥', title: 'Poskestren', desc: 'Pos Kesehatan Pesantren yang melayani kesehatan santri sekaligus edukasi pola hidup bersih dan sehat.', color_gradient: 'from-red-500 to-red-700', link: '#' },
    { icon: '✍️', title: 'Jurnalistik', desc: 'Pelatihan literasi, kepenulisan, dan media untuk mengasah kemampuan dakwah santri di era digital.', color_gradient: 'from-orange-500 to-orange-700', link: '#' },
    { icon: '✨', title: 'Program Lainnya', desc: 'Berbagai kegiatan ekstrakurikuler dan pengembangan bakat yang akan terus bertambah sesuai kebutuhan santri.', color_gradient: 'from-purple-500 to-purple-700', link: '#' }
  ];

  const activeGalleryItems = gallery && gallery.length > 0 ? gallery : [
    { image: '', title: 'KBM Kelas Tafsir', desc: 'Kegiatan belajar mengajar pendalaman kitab tafsir.' },
    { image: '', title: 'Latihan Brigade Santri', desc: 'Latihan kedisiplinan dan kepanduan rutin.' },
    { image: '', title: 'Pembiasaan Dzikir Pagi', desc: 'Dzikir pagi bersama di asrama.' }
  ];

  const activeHistoryTimeline = historyTimeline.length > 0 ? historyTimeline : [
    { year: 'Fase Awal', description: 'Perintisan halaqah pengajian kecil oleh para sesepuh.' },
    { year: 'MDT', description: 'Pendirian Madrasah Diniyah Takmiliyah secara formal.' },
    { year: 'Filial MTs', description: 'Pembukaan kelas filial MTs.' },
    { year: 'Kini', description: 'Menyelenggarakan jenjang lengkap terakreditasi.' }
  ];

  // Auto transition for slide
  useEffect(() => {
    if (activeSliderImages.length <= 1) return;
    const timer = setInterval(() => {
      setSlide((prev) => (prev === activeSliderImages.length - 1 ? 0 : prev + 1));
    }, 5000);
    return () => clearInterval(timer);
  }, [activeSliderImages.length]);

  // Navbar glassmorphism effect
  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Filter news counts
  const newsLimit = parseInt(settings?.landing_news_count) || 4;
  const filteredNews = news ? news.slice(0, newsLimit) : [];

  const welcomeVideoEmbed = getYoutubeEmbedUrl(settings?.landing_welcome_video);

  const logoHeight = parseInt(settings?.logo_height) || 80;
  const logoHeightMobile = Math.round(logoHeight * 0.8);

  const footerLogo = settings?.footer_logo || settings?.logo_website || null;
  const footerLogoHeight = parseInt(settings?.footer_logo_height) || 60;

  return (
    <div className="font-sans antialiased bg-[#FDFDFD] text-slate-700 flex flex-col min-h-screen w-full overflow-x-hidden">
      <style>{`
        .logo-custom-size {
          height: ${logoHeightMobile}px !important;
        }
        @media (min-width: 768px) {
          .logo-custom-size {
            height: ${logoHeight}px !important;
          }
        }
        .scrollbar-none::-webkit-scrollbar {
          display: none;
        }
        .scrollbar-none {
          -ms-overflow-style: none;
          scrollbar-width: none;
        }
      `}</style>

      {/* --- NAVBAR --- */}
      <nav 
        className={`fixed w-full top-0 bg-white shadow-xl border-b-[6px] border-emerald-700 transition-all duration-300 ${isScrolled ? 'bg-opacity-95 backdrop-blur-md' : ''}`}
        style={{ position: 'fixed !important', top: 0, width: '100%', zIndex: 99999 }}
      >
        <div className="max-w-7xl mx-auto px-4 md:px-6 h-28 flex justify-between items-center">
          
          {/* Logo Branding */}
          <div className="flex items-center gap-4 shrink-0">
            {settings?.logo_website ? (
              <img src={resolveImage(settings.logo_website, null)} alt="Logo" className="logo-custom-size w-auto object-contain" />
            ) : (
              <>
                <div className="bg-emerald-800 text-white w-16 h-16 flex items-center justify-center rounded-2xl font-black text-3xl shadow-lg border-2 border-emerald-500">
                  104
                </div>
                <div className="flex flex-col text-left border-l-2 border-slate-200 pl-4">
                  <span className="text-[11px] font-black tracking-[0.2em] text-emerald-800 leading-tight uppercase">{settings?.header_title || 'Pesantren Persatuan Islam 104'}</span>
                  <span className="text-2xl font-black text-slate-800 leading-none uppercase tracking-tighter">{settings?.header_subtitle || 'Al-Ittihad Cikajang'}</span>
                  <span className="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest italic">{settings?.header_tagline || 'Melayani Masyarakat Menuju Ridho Allah'}</span>
                </div>
              </>
            )}
          </div>

          {/* Menus */}
          <div className="hidden lg:flex items-center gap-6">
            {[
              { n: 'Beranda', link: '/' },
              { n: 'Profil', drop: ['Sejarah', 'Tokoh Pendiri', 'Visi & Misi', 'Struktur', 'Sarana'] },
              { n: 'Program', drop: ['KOBER', 'RA', 'SDIT', 'MDT', 'MTS', 'MA'] },
              { n: 'Program Pesantren', drop: ['Wakaf Pendidikan', 'Pembangunan Sarana', 'Beasiswa Santri', 'Tabungan Umroh', 'Tabungan Kurban', 'Kopontren'] },
              { n: 'Berita', link: '/berita' },
              { n: 'Kontak', link: '/kontak' }
            ].map((item) => {
              const innerContent = (
                <div className="flex items-center gap-1.5 py-4">
                  <span className="text-[13px] font-black uppercase tracking-wider text-slate-700 group-hover:text-emerald-700 transition-colors">{item.n}</span>
                  {item.drop && (
                    <svg className="w-3.5 h-3.5 text-slate-400 group-hover:text-emerald-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                  )}
                </div>
              );

              if (item.link) {
                return (
                  <a href={item.link} key={item.n} className="relative group transition-all cursor-pointer">
                    {innerContent}
                  </a>
                );
              }

              return (
                <div 
                  key={item.n} 
                  className="relative group transition-all cursor-pointer"
                  onClick={() => item.drop && setActiveDropdown(activeDropdown === item.n ? null : item.n)}
                  onMouseEnter={() => item.drop && setActiveDropdown(item.n)}
                  onMouseLeave={() => setActiveDropdown(null)}
                >
                  {innerContent}

                  {item.drop && (
                    <div 
                      className={`absolute left-0 right-0 top-full pt-1 ${activeDropdown === item.n ? 'block' : 'hidden'}`}
                      style={{ position: 'absolute', zIndex: 99999 }}
                      onClick={(e) => e.stopPropagation()}
                    >
                      <div className="absolute left-1/2 -translate-x-1/2 w-56">
                        <div className="bg-white shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border-t-4 border-emerald-700 overflow-hidden flex flex-col p-2">
                          {item.drop.map((sub) => (
                            <a
                              key={sub}
                              href={sub === 'Sejarah' ? '/profil/sejarah' : sub === 'Visi & Misi' ? '/profil/visi-misi' : sub === 'Struktur' ? '/profil/struktur' : sub === 'Tokoh Pendiri' ? '/profil/tokoh-pendiri' : sub === 'Sarana' || sub === 'Sarana & Prasarana' ? '/profil/sarana' : sub === 'KOBER' ? '/program/kober' : sub === 'RA' ? '/program/ra' : sub === 'SDIT' ? '/program/sdit' : sub === 'MDT' ? '/program/mdt' : sub === 'MTS' ? '/program/mts' : sub === 'MA' ? '/program/ma' : sub === 'Berita & Pengumuman' || sub === 'Berita' ? '/berita' : sub === 'Wakaf Pendidikan' ? '/dukungan' : sub === 'Pembangunan Sarana' ? '/dukungan/pembangunan' : sub === 'Beasiswa Santri' ? '/dukungan/beasiswa' : sub === 'Tabungan Umroh' ? '/program/tabungan-umroh' : sub === 'Tabungan Kurban' ? '/program/tabungan-kurban' : sub === 'Kopontren' ? '/program/kopontren' : '#'}
                              className="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto"
                            >
                              {sub}
                            </a>
                          ))}
                        </div>
                      </div>
                    </div>
                  )}
                </div>
              );
            })}

            {/* PSB Link & Contact Icon */}
            <div className="ml-4 flex items-center gap-4 border-l border-slate-200 pl-6">
              <a href="/kontak" className="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 px-4.5 py-2 rounded-xl text-[12px] font-black uppercase tracking-wider transition-all border border-emerald-100 flex items-center justify-center">
                PSB 26/27
              </a>
              
              <a href={`https://wa.me/${(settings?.landing_contact_phone || '083822099034').replace(/[^0-9]/g, '')}`} target="_blank" rel="noopener noreferrer" className="bg-[#25D366] text-white p-3 rounded-xl shadow-md transition-all hover:scale-105">
                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
              </a>
            </div>
          </div>
        </div>
      </nav>
      
      <div className="h-28"></div>

      {/* ── 1. HERO & SLIDER SECTION ── */}
      <section className="relative h-screen min-h-700px w-full flex items-center justify-center overflow-hidden">
        {/* Background images that slide */}
        <div className="absolute inset-0">
          {activeSliderImages.map((img, index) => {
            const bgImg = resolveImage(img, index === 0 ? hero1 : index === 1 ? hero2 : hero3);
            return (
              <div
                key={index}
                className={`absolute inset-0 transition-opacity duration-1000 ease-in-out ${
                  slide === index ? "opacity-100" : "opacity-0"
                }`}
              >
                <img 
                  src={bgImg} 
                  className="w-full h-full object-cover" 
                  alt={`Slide ${index + 1}`} 
                  onError={(e) => { e.target.src = "https://picsum.photos/1920/1080"; }}
                />
                <div className={`absolute inset-0 ${settings?.overlay_opacity || 'bg-black/60'} backdrop-blur-[1px]`}></div>
              </div>
            );
          })}
        </div>

        {/* Content on top */}
        {(() => {
          const positionClass = settings?.text_position || 'items-center text-center';
          const isLeft = positionClass.includes('text-left');
          const isRight = positionClass.includes('text-right');
          const fontSizeClass = settings?.title_font_size || 'text-4xl md:text-6xl';

          let contentContainerClass = "max-w-7xl mx-auto px-6 h-full flex flex-col justify-center relative z-10 w-full ";
          if (isLeft) {
            contentContainerClass += "items-start text-left md:pl-16 lg:pl-28";
          } else if (isRight) {
            contentContainerClass += "items-end text-right md:pr-16 lg:pr-28";
          } else {
            contentContainerClass += "items-center text-center";
          }

          return (
            <div className={contentContainerClass}>
              {/* Tulisan Kecil */}
              {settings?.slider_small_text && (
                <span className="text-emerald-400 font-bold tracking-[0.2em] text-[10px] md:text-xs uppercase bg-emerald-950/60 border border-emerald-500/30 px-5 py-1.5 rounded-full mb-6 block animate-fade-in w-fit">
                  {settings.slider_small_text}
                </span>
              )}

              {/* Judul Besar */}
              <h1 className={`${fontSizeClass} font-black tracking-tight uppercase leading-tight mb-6 max-w-4xl text-white drop-shadow-md animate-fade-in`}>
                {settings?.slider_title || 'Membentuk Generasi Robbani, Beradab, dan Berprestasi'}
              </h1>

              {/* Sedikit Keterangan */}
              {settings?.slider_description && (
                <p className="text-xs md:text-base text-emerald-50/90 max-w-3xl font-medium leading-relaxed border-t border-b border-white/20 py-4 mb-10 animate-fade-in">
                  {settings.slider_description}
                </p>
              )}
              
              {/* CTA Button */}
              {settings?.slider_button_text && (
                <div className="flex animate-fade-in">
                  <a 
                    href={settings?.slider_button_link || '/profil/sejarah'}
                    className="bg-emerald-600 hover:bg-emerald-500 text-white px-10 py-3.5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-emerald-800 inline-block"
                  >
                    {settings.slider_button_text}
                  </a>
                </div>
              )}
            </div>
          );
        })()}

        {/* Dots indicators */}
        {activeSliderImages.length > 1 && (
          <div className="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            {activeSliderImages.map((_, i) => (
              <button 
                key={i} 
                onClick={() => setSlide(i)}
                className={`h-2.5 transition-all duration-500 rounded-full ${slide === i ? "w-10 bg-emerald-500" : "w-2.5 bg-white/40"}`}
              />
            ))}
          </div>
        )}
      </section>

      {/* ── 2. AHLAN WA SAHLAN (SAMBUTAN & MENGENAL KAMI - 2 KOLOM VIDEO + TEKS) ── */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full grid md:grid-cols-2 gap-12 items-center">
          {/* Kolom Kiri: Video Sambutan YouTube */}
          <div className="rounded-[2rem] overflow-hidden shadow-2xl aspect-video w-full border-4 border-emerald-50 bg-slate-900 flex items-center justify-center relative">
            {welcomeVideoEmbed ? (
              <iframe 
                className="w-full h-full" 
                src={welcomeVideoEmbed} 
                title="Video Sambutan Mudirul 'Am" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowFullScreen
                frameBorder="0"
              ></iframe>
            ) : (
              <div className="w-full h-full bg-gradient-to-br from-emerald-800 to-emerald-950 flex flex-col items-center justify-center text-white p-8 text-center">
                <span className="text-5xl mb-4">🕌</span>
                <h4 className="text-xl font-bold mb-2">Sambutan Mudirul 'Am</h4>
                <p className="text-xs text-emerald-100/70 max-w-xs leading-relaxed">
                  Video sambutan hangat Mudirul 'Am belum dikonfigurasi di panel admin.
                </p>
              </div>
            )}
          </div>

          {/* Kolom Kanan: Teks & Sambutan */}
          <div className="flex flex-col items-start text-left space-y-6">
            <div className="space-y-2">
              <span className="text-xs font-bold text-emerald-600 tracking-widest uppercase block">
                {settings?.landing_welcome_subtitle || 'Sambutan Mudirul \'Am Pesantren'}
              </span>
              <h2 className="text-3xl md:text-4xl font-black text-slate-800 uppercase tracking-tight">
                {settings?.landing_welcome_title || 'Ahlan Wa Sahlan'}
              </h2>
            </div>
            
            <div 
              className="text-slate-600 leading-relaxed font-medium text-justify text-sm md:text-base"
              dangerouslySetInnerHTML={{ __html: settings?.landing_welcome_narrative || 'Pesantren Persatuan Islam 104 Al-Ittihad Cikajang didirikan dengan tekad yang kuat untuk melahirkan kader ulama yang mutafaqqih fiddin.' }}
            />

            {settings?.landing_welcome_quote && (
              <div className="bg-emerald-50/50 border-l-4 border-emerald-600 p-5 rounded-r-2xl italic text-slate-700 font-medium text-sm w-full shadow-sm">
                "{settings.landing_welcome_quote}"
              </div>
            )}

            {settings?.landing_welcome_cta_text && (
              <a 
                href={settings?.landing_welcome_cta_link || '/profil/sejarah'}
                className="bg-emerald-600 text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-all shadow-md inline-block"
              >
                {settings.landing_welcome_cta_text}
              </a>
            )}
          </div>
        </div>
      </section>

      {/* ── 3. STATISTIK PESANTREN ── */}
      <section className="py-16 bg-gradient-to-br from-emerald-800 to-emerald-950 text-white relative overflow-hidden">
        <div className="absolute inset-0 bg-grid-white/[0.05] pointer-events-none"></div>
        <div className="max-w-7xl mx-auto px-6 relative z-10">
          <div className="text-center max-w-2xl mx-auto mb-12">
            <h2 className="text-3xl font-black uppercase tracking-tight mb-4">
              {settings?.landing_stats_title || 'Statistik Pesantren'}
            </h2>
            <p className="text-emerald-100/80 font-medium">
              {settings?.landing_stats_desc || 'Gambaran umum perkembangan jumlah santri dan sarana pendidikan pesantren.'}
            </p>
          </div>

          <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
            {activeStatsCards.map((card, idx) => (
              <div key={idx} className="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 text-center hover:bg-white/10 transition-all duration-300">
                <div className="text-4xl mb-4">{card.icon}</div>
                <div className="text-3xl md:text-5xl font-black tracking-tight mb-2 text-emerald-300">{card.number}</div>
                <div className="text-xs md:text-sm font-bold uppercase tracking-wider text-emerald-100/90">{card.label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── 4. DUKUNGAN PENDIDIKAN ── */}
      <section className="py-24 px-6 bg-gradient-to-b from-[#F8FAFC] to-emerald-50/30 flex justify-center w-full relative overflow-hidden">
        <div className="absolute top-0 right-0 w-96 h-96 bg-amber-100/50 rounded-full blur-3xl -mr-40 -mt-20 pointer-events-none"></div>
        <div className="absolute bottom-0 left-0 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl -ml-40 -mb-20 pointer-events-none"></div>

        <div className="max-w-7xl w-full relative z-10">
          <div className="text-center max-w-3xl mx-auto mb-16">
            <span className="text-emerald-600 font-bold tracking-[0.2em] text-xs uppercase bg-emerald-50 px-4 py-1.5 rounded-full inline-block mb-4 border border-emerald-100">
              Bersama Membersamai Pendidikan
            </span>
            <h2 className="text-3xl md:text-5xl font-black text-slate-800 leading-tight mb-6">
              {settings?.landing_support_title || 'Menjadi Bagian dari Perjuangan Pendidikan Islam'}
            </h2>
            <p className="text-slate-600 text-lg leading-relaxed font-medium">
              {settings?.landing_support_desc || 'Pesantren ini tumbuh dari semangat dakwah, keikhlasan, dan gotong royong. Mari bersama merajut amal jariyah.'}
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            {activeSupportCards.map((card, i) => (
              <a 
                href={card.link || '#'} 
                key={i} 
                className="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col relative overflow-hidden"
              >
                <div className="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-bl-full transition-transform duration-500 group-hover:scale-150"></div>
                <div className="relative z-10 flex-1">
                  <div className="w-16 h-16 bg-emerald-50 text-emerald-600 text-3xl flex items-center justify-center rounded-2xl mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                    {card.icon}
                  </div>
                  <h3 className="text-2xl font-bold text-slate-800 mb-3">{card.title}</h3>
                  <p className="text-slate-500 leading-relaxed">{card.desc}</p>
                </div>
              </a>
            ))}
          </div>

          <div className="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="/dukungan" className="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold tracking-wide shadow-lg hover:bg-emerald-700 hover:shadow-emerald-600/30 hover:-translate-y-1 transition-all flex items-center gap-2">
              <span>💖</span> Jelajahi Dukungan Pendidikan
            </a>
            <a href="/dukungan/pembangunan" className="bg-white text-slate-700 px-8 py-4 rounded-2xl font-bold tracking-wide shadow-sm border border-slate-200 hover:bg-slate-50 hover:shadow-md transition-all flex items-center gap-2">
              Lihat Pembangunan <span>→</span>
            </a>
          </div>
        </div>
      </section>

      {/* ── 5. JENJANG PENDIDIKAN ── */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6">
          <div className="mb-20 text-center flex flex-col items-center">
            <div className="flex items-center gap-3 mb-4 justify-center">
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
              <h2 className="text-3xl md:text-4xl font-black text-slate-800 uppercase tracking-tight">
                {settings?.landing_levels_title || 'Jenjang Pendidikan'}
              </h2>
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
            </div>
            <p className="text-slate-600 max-w-3xl leading-relaxed font-medium text-base md:text-lg mt-4">
              {settings?.landing_levels_desc || 'Kami menyelenggarakan sistem pendidikan berjenjang yang memadukan kurikulum nasional dengan kepesantrenan.'}
            </p>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            {activeLevelCards.map((item, i) => {
              const defaultImgs = [hero1, hero2, hero3];
              const levelImg = resolveImage(item.image, defaultImgs[i % 3]);
              return (
                <a href={item.link || '#'} key={i} className="group relative h-320px rounded-2rem overflow-hidden shadow-2xl cursor-pointer block">
                  <img 
                    src={levelImg} 
                    className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                    alt={item.title} 
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-900/40 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>

                  <div className="absolute inset-0 p-10 flex flex-col justify-end items-center text-center">
                    <h3 className="text-white font-black text-2xl mb-2 transform transition-transform duration-500 group-hover:-translate-y-2 uppercase tracking-tight">
                      {item.title}
                    </h3>
                    <div className="w-16 h-1 bg-emerald-400 mb-4 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    <p className="text-white/0 group-hover:text-white/95 text-[11px] leading-relaxed transition-all duration-500 opacity-0 group-hover:opacity-100 line-clamp-3 font-medium">
                      {item.desc}
                    </p>
                    <div className="mt-6 overflow-hidden h-0 group-hover:h-10 transition-all duration-500">
                      <button className="bg-white text-emerald-900 text-[10px] font-black px-6 py-2.5 rounded-xl uppercase tracking-widest shadow-xl">
                        Selengkapnya
                      </button>
                    </div>
                  </div>
                </a>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── 6. PROGRAM UNGGULAN ── */}
      <section id="program-pesantren" className="py-24 bg-slate-50">
        <div className="max-w-7xl mx-auto px-6">
          <div className="mb-16 text-center flex flex-col items-center">
            <div className="flex items-center gap-3 mb-4 justify-center">
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
              <h2 className="text-3xl md:text-4xl font-black text-slate-800 uppercase tracking-tight">
                {settings?.landing_programs_title || 'Program Pesantren'}
              </h2>
              <div className="bg-emerald-600 w-12 h-1.5 rounded-full"></div>
            </div>
            <p className="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
              {settings?.landing_programs_desc || 'Kami membekali santri dengan program unggulan untuk mengasah spiritual, kemandirian, dan kreativitas.'}
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {activeProgramCards.map((prog, i) => (
              <div key={i} className="bg-white rounded-2rem p-8 shadow-xl shadow-slate-200 border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group">
                <div className={`absolute top-0 right-0 w-24 h-24 bg-gradient-to-br ${prog.color_gradient || 'from-emerald-500 to-emerald-700'} opacity-10 rounded-bl-[5rem] transition-all group-hover:scale-150`}></div>
                
                <div className="relative z-10">
                  <div className={`w-14 h-14 bg-gradient-to-br ${prog.color_gradient || 'from-emerald-500 to-emerald-700'} rounded-2xl flex items-center justify-center text-3xl shadow-lg mb-6`}>
                    {prog.icon}
                  </div>
                  <h3 className="text-xl font-black text-slate-800 mb-3 uppercase tracking-tight leading-tight">
                    {prog.title}
                  </h3>
                  <p className="text-sm text-slate-500 leading-relaxed font-medium">
                    {prog.desc}
                  </p>
                </div>

                <div className="mt-8 pt-6 border-t border-slate-50 flex justify-between items-center">
                  <span className="text-[10px] font-black text-slate-300 uppercase tracking-widest">PPI 104 Unit</span>
                  <a href={prog.link || '#'} className={`w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors`}>
                    →
                  </a>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── EKSTRAKURIKULER ── */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full text-center">
          <div className="mb-16 space-y-4">
            <span className="text-emerald-600 font-bold tracking-[0.2em] text-xs uppercase">Aktivitas Santri</span>
            <h2 className="text-4xl font-bold text-slate-900">Ekstrakurikuler Terpadu</h2>
            <p className="text-slate-500 max-w-2xl mx-auto">
              Kegiatan pengembangan bakat dan minat santri di seluruh jenjang pendidikan.
            </p>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {(extracurriculars && extracurriculars.length > 0 ? extracurriculars.map((eskul) => ({
              nama: eskul.name,
              jenjang: eskul.stages,
              icon: eskul.icon,
              color: eskul.color_classes || "bg-emerald-50 text-emerald-700 border-emerald-100"
            })) : [
              { nama: "Pramuka", jenjang: "SDIT, MTS, MA", icon: "🏕️", color: "bg-orange-50 text-orange-700 border-orange-100" },
              { nama: "Olahraga", jenjang: "Semua Jenjang", icon: "⚽", color: "bg-blue-50 text-blue-700 border-blue-100" },
              { nama: "Seni & Kaligrafi", jenjang: "MDT, MTS, MA", icon: "🎨", color: "bg-purple-50 text-purple-700 border-purple-100" },
              { nama: "Hadroh", jenjang: "MTS, MA", icon: "🥁", color: "bg-emerald-50 text-emerald-700 border-emerald-100" }
            ]).map((eskul, i) => {
              const isImagePath = eskul.icon && (eskul.icon.includes('/') || eskul.icon.includes('.'));
              let bgClass = 'bg-[#064e3b]';
              if (eskul.color && eskul.color.includes('orange')) {
                bgClass = 'bg-[#ea580c]';
              } else if (eskul.color && eskul.color.includes('blue')) {
                bgClass = 'bg-[#1d4ed8]';
              } else if (eskul.color && eskul.color.includes('purple')) {
                bgClass = 'bg-[#6d28d9]';
              } else if (eskul.color && eskul.color.includes('emerald')) {
                bgClass = 'bg-[#047857]';
              }
              return (
                <div key={i} className="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                  {isImagePath ? (
                    <>
                      <img src={`/storage/${eskul.icon}`} alt={eskul.nama} className="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 z-0" />
                      <div className="absolute inset-0 bg-gradient-to-t from-black/95 via-black/45 to-transparent z-10"></div>
                    </>
                  ) : (
                    <>
                      <div className={`absolute inset-0 ${bgClass} z-0 opacity-90`}></div>
                      <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                    </>
                  )}
                  <div className="relative z-20 flex flex-col items-center">
                    {!isImagePath && (
                      <div className="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">
                        {eskul.icon || "🏆"}
                      </div>
                    )}
                    <h4 className="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug drop-shadow-md">
                      {eskul.nama}
                    </h4>
                    <p className="text-[10px] font-black uppercase tracking-widest text-emerald-100 drop-shadow-sm opacity-90">
                      {eskul.jenjang}
                    </p>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── FASILITAS ── */}
      <section className="py-24 px-6 bg-[#F8FAFC] flex justify-center w-full">
        <div className="max-w-7xl w-full text-center">
          <div className="mb-16 space-y-4">
            <span className="text-emerald-600 font-bold tracking-[0.2em] text-xs uppercase">Kenyamanan Santri</span>
            <h2 className="text-4xl font-bold text-slate-900">Fasilitas Pesantren</h2>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {(facilities && facilities.length > 0 ? facilities.map((fasil) => ({
              nama: fasil.name,
              icon: fasil.icon,
              desc: fasil.description
            })) : [
              { nama: "Masjid Putra & Putri", icon: "🕌", desc: "Sarana ibadah luas dan terpisah." },
              { nama: "Asrama Nyaman", icon: "🏠", desc: "Hunian bersih dengan pengawasan asatidz." },
              { nama: "Ruang Kelas", icon: "🏫", desc: "Ruang belajar representatif & modern." }
            ]).map((fasil, i) => {
              const isImagePath = fasil.icon && (fasil.icon.includes('/') || fasil.icon.includes('.'));
              return (
                <div key={i} className="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-8 text-center cursor-pointer shadow-md border border-slate-100">
                  {isImagePath ? (
                    <>
                      <img src={`/storage/${fasil.icon}`} alt={fasil.nama} className="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 z-0" />
                      <div className="absolute inset-0 bg-gradient-to-t from-black/95 via-black/45 to-transparent z-10"></div>
                    </>
                  ) : (
                    <>
                      <div className="absolute inset-0 bg-[#064e3b] z-0 opacity-90"></div>
                      <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                    </>
                  )}
                  <div className="relative z-20 flex flex-col items-center">
                    {!isImagePath && (
                      <div className="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-6 border border-white/20 text-3xl group-hover:scale-110 transition-transform">
                        {fasil.icon || "🏢"}
                      </div>
                    )}
                    <h4 className="text-xl font-black uppercase tracking-tight text-white mb-2 leading-snug drop-shadow-md">
                      {fasil.nama}
                    </h4>
                    <p className="text-xs text-emerald-50/90 drop-shadow-sm opacity-90 leading-relaxed font-medium">
                      {fasil.desc}
                    </p>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── 7. BERITA LANDING ── */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full">
          <div className="mb-12 text-left">
            <h2 className="text-3xl font-bold text-slate-800 mb-4">
              {settings?.landing_news_title || 'Berita Terbaru'}
            </h2>
            <p className="text-slate-500 font-medium">
              {settings?.landing_news_desc || 'Kumpulan kabar, agenda, dan artikel informatif seputar kegiatan pesantren.'}
            </p>
          </div>
          
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {filteredNews && filteredNews.length > 0 ? (
              <>
                {/* Berita Utama */}
                <a href={`/berita/${filteredNews[0].slug}`} className="lg:col-span-2 text-left space-y-6 group cursor-pointer block">
                  <div className="rounded-2rem overflow-hidden aspect-video bg-slate-300">
                    <img 
                      src={resolveImage(filteredNews[0].thumbnail, "https://picsum.photos/1000/600?nature")} 
                      className="w-full h-full object-cover group-hover:scale-105 transition-all" 
                      alt="Berita Utama" 
                    />
                  </div>
                  <h3 className="text-3xl font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">{filteredNews[0].title}</h3>
                  <p className="text-slate-500 text-lg leading-relaxed line-clamp-3">{filteredNews[0].excerpt || filteredNews[0].content?.replace(/<[^>]*>?/gm, '')}</p>
                </a>

                {/* Berita Kecil */}
                <div className="flex flex-col gap-8">
                  {filteredNews.slice(1).map((b, i) => (
                    <a href={`/berita/${b.slug}`} key={b.id || i} className="flex gap-4 items-start group cursor-pointer text-left block">
                      <div className="w-24 h-24 bg-slate-200 rounded-2xl overflow-hidden shrink-0">
                        <img 
                          src={resolveImage(b.thumbnail, `https://picsum.photos/200/200?random=${i}`)} 
                          className="w-full h-full object-cover group-hover:scale-110 transition-all" 
                          alt="Thumbnail" 
                        />
                      </div>
                      <div className="space-y-1">
                        <p className="text-xs text-emerald-600 font-bold uppercase">{new Date(b.published_at || b.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</p>
                        <h4 className="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors leading-snug line-clamp-2">{b.title}</h4>
                      </div>
                    </a>
                  ))}
                </div>
              </>
            ) : (
              <div className="col-span-3 text-center py-12 text-slate-400 font-medium">
                Belum ada berita yang diterbitkan.
              </div>
            )}
          </div>
        </div>
      </section>

      {/* ── 8. GALERI LANDING ── */}
      <section className="py-24 px-6 bg-slate-50 flex justify-center w-full">
        <div className="max-w-7xl w-full text-center">
          <div className="mb-16 space-y-4">
            <h2 className="text-4xl font-bold text-slate-900 uppercase tracking-tight">
              {settings?.landing_gallery_title || 'Galeri Dokumentasi'}
            </h2>
            <p className="text-slate-500 max-w-2xl mx-auto">
              {settings?.landing_gallery_desc || 'Dokumentasi visual kehidupan, sarana prasarana, dan kegiatan belajar mengajar santri.'}
            </p>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            {activeGalleryItems.slice(0, 6).map((item, idx) => {
              const defaultImgs = [hero1, hero2, hero3];
              const galleryImg = resolveImage(item.image, defaultImgs[idx % 3]);
              return (
                <div key={idx} className="group relative h-280px rounded-2rem overflow-hidden shadow-lg border border-slate-100 bg-white">
                  <img 
                    src={galleryImg} 
                    className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                    alt={item.title || 'Galeri'} 
                    onError={(e) => { e.target.src = "https://picsum.photos/600/600?nature"; }}
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-left">
                    <h4 className="text-white font-bold text-lg mb-1">{item.title}</h4>
                    <p className="text-white/80 text-xs line-clamp-2">{item.desc}</p>
                  </div>
                </div>
              );
            })}
          </div>

          {/* Button Lihat Galeri Lainnya */}
          <div className="mt-12 flex justify-center">
            <a 
              href="/galeri"
              className="bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-3.5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-emerald-800"
            >
              <span>Lihat Galeri Lainnya</span>
              <svg className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="3" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </a>
          </div>
        </div>
      </section>

      {/* ── 9. SEJARAH SINGKAT PESANTREN ── */}
      <section className="py-24 px-6 bg-white flex justify-center w-full">
        <div className="max-w-7xl w-full">
          {/* Header Sejarah */}
          <div className="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <span className="text-emerald-600 font-bold tracking-[0.2em] text-xs uppercase bg-emerald-50 px-4 py-1.5 rounded-full inline-block border border-emerald-100">
              Jejak Tarbiyah & Dakwah
            </span>
            <h2 className="text-3xl md:text-5xl font-black text-slate-800 leading-tight">
              {settings?.landing_history_title || 'Sejarah Singkat Pesantren'}
            </h2>
            <p className="text-slate-500 font-medium">
              {settings?.landing_history_subtitle || 'Menelusuri jejak perjuangan dakwah dan tarbiyah.'}
            </p>
          </div>

          <div className="grid md:grid-cols-2 gap-12 items-start">
            {/* Sisi Kiri: Paragraf Narasi */}
            <div className="space-y-6 text-slate-600 leading-relaxed font-medium text-justify">
              <p>
                {settings?.landing_history_p1 || 'Pesantren Persatuan Islam 104 Al-Ittihad Cikajang berawal dari sebuah pengajian halaqah kecil yang dirintis oleh para asatidz setempat.'}
              </p>
              <p>
                {settings?.landing_history_p2 || 'Seiring bertambahnya jumlah jamaah dan santri, pengajian ini berkembang menjadi Madrasah Diniyah Takmiliyah (MDT).'}
              </p>
              <p>
                {settings?.landing_history_p3 || 'Tuntutan pendidikan formal tingkat menengah melahirkan gagasan penyelenggaraan Madrasah Tsanawiyah (MTs) kelas filial (menumpang).'}
              </p>
            </div>

            {/* Sisi Kanan: Timeline Desain Ringan */}
            <div className="relative pl-8 border-l-2 border-dashed border-emerald-200 space-y-8 py-2 md:pl-12">
              {activeHistoryTimeline.map((item, idx) => (
                <div key={idx} className="relative text-left">
                  {/* Bullet Marker */}
                  <div className="absolute -left-[41px] md:-left-[57px] top-1 w-6 h-6 rounded-full bg-emerald-600 border-4 border-white flex items-center justify-center shadow-md">
                    <div className="w-1.5 h-1.5 rounded-full bg-white"></div>
                  </div>
                  <div>
                    <span className="inline-block bg-emerald-50 text-emerald-800 text-xs font-black px-3 py-1 rounded-full border border-emerald-100 mb-2 uppercase tracking-wide">
                      {item.year}
                    </span>
                    <p className="text-slate-600 text-sm font-medium leading-relaxed">
                      {item.description}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Tombol CTA di Bawah Tengah */}
          <div className="mt-16 flex justify-center">
            <a 
              href={settings?.landing_history_cta_link || '/profil/sejarah'}
              className="bg-emerald-600 hover:bg-emerald-500 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl transition-all hover:scale-105 active:scale-95 inline-block border-b-4 border-emerald-800"
            >
              {settings?.landing_history_cta_text || 'Lihat Sejarah Lengkap'}
            </a>
          </div>
        </div>
      </section>

      {/* ── TESTIMONI & ALUMNI (GAYA EGS) ── */}
      <section className="py-24 bg-slate-50 relative overflow-hidden border-t border-slate-100">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/5 blur-[100px] rounded-full -mr-64 -mt-64"></div>
        <div className="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-500/5 blur-[100px] rounded-full -ml-64 -mb-64"></div>

        <div className="max-w-7xl mx-auto px-6 relative z-10">
          <div className="flex flex-col items-center text-center mb-16">
            <span className="text-emerald-700 font-black tracking-[0.3em] uppercase text-[10px] mb-4">Bukti Nyata</span>
            <h2 className="text-3xl md:text-5xl font-black text-slate-800 uppercase tracking-tight font-sans">Apa Kata Mereka?</h2>
            <div className="w-20 h-1.5 bg-emerald-700 mt-6 rounded-full"></div>
            <p className="text-slate-600 mt-6 max-w-2xl mx-auto font-medium leading-relaxed">
              Dari orang tua yang mempercayakan amanahnya, hingga alumni yang kini berkiprah di tengah umat.
            </p>
          </div>

          {/* ACTIVE TESTIMONIAL DISPLAY (2-PANEL GRID) */}
          {activeTestimonial && (
            <div className="grid lg:grid-cols-12 gap-8 items-stretch mb-20">
              {/* Left Column: Graphic Card (4 cols) */}
              <div className="lg:col-span-4 flex justify-center items-center">
                <div className="w-full max-w-[320px] min-h-[420px] bg-gradient-to-br from-emerald-800 to-teal-950 text-white rounded-3xl p-8 shadow-2xl relative overflow-hidden flex flex-col items-center justify-between text-center border-4 border-white transition-all duration-300">
                  {/* Badge */}
                  <div className="bg-white text-emerald-900 px-4.5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest shadow-md">
                    TESTIMONI {activeTestimonial.type === 'Orang Tua' ? 'WALI SANTRI' : 'ALUMNI'}
                  </div>
                  <span className="text-[10px] text-emerald-300 font-bold tracking-[0.2em] uppercase mt-2">PPI 104 AL-ITTIHAAD</span>

                  {/* Profile Image Frame */}
                  <div className="w-32 h-32 rounded-full border-4 border-white overflow-hidden shadow-2xl my-6 bg-white shrink-0">
                    <img 
                      src={resolveImage(activeTestimonial.avatar, `https://ui-avatars.com/api/?name=${encodeURIComponent(activeTestimonial.name)}&background=047857&color=fff&size=150&bold=true`)} 
                      alt={activeTestimonial.name} 
                      className="w-full h-full object-cover"
                    />
                  </div>

                  {/* Info */}
                  <div className="mt-2">
                    <h3 className="text-white font-black text-base leading-tight uppercase tracking-tight">{activeTestimonial.name}</h3>
                    <div className="w-8 h-1 bg-emerald-400 mx-auto my-3 rounded-full"></div>
                    <p className="text-emerald-200 text-[10px] font-bold uppercase tracking-wider leading-relaxed">{activeTestimonial.status}</p>
                  </div>
                  
                  <div className="mt-4 bg-white/10 w-8 h-8 rounded-full flex items-center justify-center text-xs">
                    ✨
                  </div>
                </div>
              </div>

              {/* Right Column: Quote Text (8 cols) */}
              <div className="lg:col-span-8 flex">
                <div className="w-full bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-slate-100 relative flex flex-col justify-center min-h-[360px] md:min-h-full">
                  <div className="absolute top-6 left-6 text-emerald-500/10 text-9xl font-serif select-none pointer-events-none">“</div>
                  
                  <p className="text-slate-700 text-lg md:text-xl font-medium italic leading-relaxed relative z-10 pl-6 border-l-4 border-emerald-700">
                    "{activeTestimonial.quote}"
                  </p>
                  
                  <div className="mt-8 border-t border-slate-100 pt-6 flex items-center gap-4 relative z-10">
                    <div className="w-12 h-12 rounded-full border-2 border-emerald-500 overflow-hidden bg-white shrink-0">
                      <img 
                        src={resolveImage(activeTestimonial.avatar, `https://ui-avatars.com/api/?name=${encodeURIComponent(activeTestimonial.name)}&background=047857&color=fff&size=100&bold=true`)} 
                        alt={activeTestimonial.name}
                        className="w-full h-full object-cover" 
                      />
                    </div>
                    <div>
                      <h4 className="text-slate-900 font-bold text-base leading-snug">{activeTestimonial.name}</h4>
                      <p className="text-emerald-700 text-[10px] font-black uppercase tracking-wider mt-0.5">{activeTestimonial.status}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          )}

          {/* SLIDER/CAROUSEL HEADER & NAVIGATION */}
          <div className="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
            <h3 className="text-base md:text-lg font-black text-slate-800 uppercase tracking-wider">
              Jejak Perjalanan Alumni & Wali Santri
            </h3>
            <div className="flex gap-2">
              <button 
                onClick={() => {
                  if (sliderRef.current) {
                    sliderRef.current.scrollBy({ left: -300, behavior: 'smooth' });
                  }
                }}
                className="bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 p-2.5 rounded-full border border-slate-200 hover:border-emerald-300 transition-all shadow-md focus:outline-none cursor-pointer"
              >
                <svg className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="3" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
              </button>
              <button 
                onClick={() => {
                  if (sliderRef.current) {
                    sliderRef.current.scrollBy({ left: 300, behavior: 'smooth' });
                  }
                }}
                className="bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 p-2.5 rounded-full border border-slate-200 hover:border-emerald-300 transition-all shadow-md focus:outline-none cursor-pointer"
              >
                <svg className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="3" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7" />
                </svg>
              </button>
            </div>
          </div>

          {/* SLIDER CARDS CONTAINER */}
          <div 
            ref={sliderRef}
            className="flex gap-6 overflow-x-auto pb-8 snap-x snap-mandatory scrollbar-none"
            style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}
          >
            {listTestimonials.map((t, idx) => {
              const isActive = activeTestimonial && activeTestimonial.id === t.id;
              return (
                <div 
                  key={t.id || idx}
                  onClick={() => setActiveTestimonial(t)}
                  className={`w-72 shrink-0 snap-center rounded-3xl p-6 bg-gradient-to-br from-emerald-700 to-teal-950 text-white shadow-lg border-2 transition-all duration-300 cursor-pointer flex flex-col justify-between items-center text-center relative overflow-hidden ${
                    isActive 
                      ? 'scale-105 border-white ring-4 ring-emerald-500/30' 
                      : 'border-white/10 opacity-70 hover:opacity-100 hover:scale-[1.02]'
                  }`}
                >
                  <div className="bg-white text-emerald-950 px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-wider mb-2">
                    {t.type === 'Orang Tua' ? 'WALI SANTRI' : 'ALUMNI'}
                  </div>
                  
                  {/* Photo inside circle */}
                  <div className="w-20 h-20 rounded-full border-2 border-white overflow-hidden my-4 bg-white shadow-md shrink-0">
                    <img 
                      src={resolveImage(t.avatar, `https://ui-avatars.com/api/?name=${encodeURIComponent(t.name)}&background=047857&color=fff&size=100&bold=true`)} 
                      alt={t.name}
                      className="w-full h-full object-cover" 
                    />
                  </div>
                  
                  <div>
                    <h4 className="font-bold text-sm text-white truncate w-56">{t.name}</h4>
                    <p className="text-emerald-300 text-[9px] uppercase tracking-wider truncate w-56 mt-1">{t.status}</p>
                  </div>

                  {/* Arrow Indicator on active */}
                  {isActive && (
                    <div className="absolute bottom-2 right-2 bg-white/20 w-6 h-6 rounded-full flex items-center justify-center text-[10px]">
                      ✓
                    </div>
                  )}
                </div>
              );
            })}
          </div>

          {/* Button Lihat Alumni */}
          <div className="mt-12 flex justify-center">
            <a 
              href="/program/alumni"
              className="bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-3.5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-emerald-800"
            >
              <span>Lihat Alumni Selengkapnya</span>
              <svg className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="3" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </a>
          </div>
        </div>
      </section>

      {/* ── 10. CTA PENDAFTARAN ── */}
      <section className="relative py-28 px-6 bg-slate-900 overflow-hidden text-center text-white">
        {settings?.landing_cta_bg ? (
          <div className="absolute inset-0">
            <img 
              src={resolveImage(settings.landing_cta_bg, hero3)} 
              className="w-full h-full object-cover" 
              alt="CTA Background" 
            />
            <div className="absolute inset-0 bg-black/75"></div>
          </div>
        ) : (
          <div className="absolute inset-0 bg-gradient-to-br from-emerald-900 to-slate-950 opacity-90"></div>
        )}
        
        <div className="relative z-10 max-w-4xl mx-auto space-y-8">
          <h2 className="text-3xl md:text-5xl font-black tracking-tight leading-tight">
            {settings?.landing_cta_title || 'Penerimaan Santri Baru (PSB) Tahun Ajaran 2026/2027'}
          </h2>
          <p className="text-slate-200 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
            {settings?.landing_cta_desc || 'Mari bergabung bersama kami, membentuk generasi yang bertafaqquh fiddin dan berakhlak mulia. Pendaftaran online telah dibuka.'}
          </p>
          <div className="pt-4">
            <a 
              href={settings?.landing_cta_btn_link || '/kontak'}
              className="bg-emerald-600 hover:bg-emerald-500 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl transition-all hover:scale-105 active:scale-95 inline-block border-b-4 border-emerald-800"
            >
              {settings?.landing_cta_btn_text || 'Daftar Online Sekarang'}
            </a>
          </div>
        </div>
      </section>

      {/* ── 11. KONTAK LANDING ── */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6">
          <div className="grid lg:grid-cols-2 gap-12 items-center bg-slate-50 p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm">
            
            {/* Alamat & Kontak */}
            <div className="space-y-8 text-left">
              <div>
                <span className="text-emerald-600 font-black tracking-[0.3em] uppercase text-[10px] mb-3 block">Informasi Lokasi</span>
                <h2 className="text-3xl md:text-5xl font-black text-slate-800 uppercase tracking-tighter mb-6">
                  {settings?.landing_contact_title || 'PPI 104 Cikajang'}
                </h2>
                <div className="w-20 h-1.5 bg-emerald-600 rounded-full mb-8"></div>
                
                <p className="text-slate-600 leading-relaxed font-medium whitespace-pre-line mb-6">
                  {settings?.landing_contact_desc || 'Punya pertanyaan mengenai program pendidikan, pendaftaran santri, atau kerjasama? Silakan hubungi kami.'}
                </p>

                <h3 className="text-xl font-bold text-slate-800 mb-2">Alamat Lengkap</h3>
                <p className="text-slate-500 leading-relaxed font-medium whitespace-pre-line">
                  {settings?.landing_contact_address || 'Pesantren Persatuan Islam 104 Cikajang\nKp. Rancapandan, Ds. Mekarjaya, Kec. Cikajang,\nKabupaten Garut, Jawa Barat 44171.'}
                </p>
              </div>

              <div className="space-y-4">
                <div className="flex items-center gap-4 text-slate-700">
                  <div className="bg-white p-3 rounded-2xl shadow-sm text-emerald-600">📞</div>
                  <span className="font-bold">{settings?.landing_contact_phone || '+6283822099034'}</span>
                </div>
                <div className="flex items-center gap-4 text-slate-700">
                  <div className="bg-white p-3 rounded-2xl shadow-sm text-emerald-600">📧</div>
                  <span className="font-bold">{settings?.landing_contact_email || 'info@alittihad104.sch.id'}</span>
                </div>
              </div>

              <a 
                href="https://www.google.com/maps/dir//Pesantren+Persatuan+Islam+104+Cikajang,+Kp.+Rancapandan,+Mekarjaya,+Cikajang,+Garut+Regency,+West+Java+44171/@-7.447544,107.789125,17z" 
                target="_blank" 
                rel="noopener noreferrer"
                className="inline-flex items-center justify-center bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20"
              >
                Petunjuk Arah (Maps)
              </a>
            </div>

            {/* Google Maps Peta */}
            <div className="w-full h-[500px] rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white bg-white">
              <iframe 
                src={settings?.landing_contact_maps || "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.128711311545!2d107.75626247395026!3d-7.45097457342898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e669da7cfc90421%3A0x68c60abeabbaca8c!2sPesantren%20Persatuan%20Islam%20104%20Cikajang!5e0!3m2!1sid!2sid!4v1713686000000!5m2!1sid!2sid"}
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

      {/* --- FOOTER --- */}
      <footer className="bg-[#0f172a] text-slate-400 py-20 px-6">
        <div className="max-w-7xl mx-auto">
          <div className="grid md:grid-cols-3 gap-16 text-left">
            {/* Branding */}
            <div>
              <div className="flex items-center gap-3 mb-6">
                {footerLogo ? (
                  <img 
                    src={resolveImage(footerLogo, null)} 
                    alt="Logo" 
                    style={{ height: `${footerLogoHeight}px` }} 
                    className="w-auto object-contain" 
                  />
                ) : (
                  <>
                    <span className="bg-emerald-600 text-white font-bold p-2 rounded-lg text-[10px]">104</span>
                    <div className="flex flex-col text-left">
                      <h3 className="text-white text-base font-black uppercase tracking-tighter leading-none">
                        {settings?.header_title || 'Pesantren Persatuan Islam 104'}
                      </h3>
                      <span className="text-[11px] text-slate-400 uppercase tracking-wider mt-1 font-bold">
                        {settings?.header_subtitle || 'Al-Ittihad Cikajang'}
                      </span>
                    </div>
                  </>
                )}
              </div>
              <p className="text-sm leading-relaxed font-medium">
                {settings?.footer_desc || "Membangun generasi Tafaqquh Fiddin yang unggul, beradab, dan berwawasan luas sesuai Al-Qur'an dan Sunnah."}
              </p>
            </div>
            
            {/* Navigasi */}
            <div className="flex flex-col gap-4">
              <h4 className="text-white font-bold text-sm uppercase tracking-widest mb-2">Navigasi</h4>
              {['Beranda', 'Program Pendidikan', 'Pendaftaran (PSB)', 'Profil Pesantren'].map((item) => (
                <a key={item} href="#" className="hover:text-emerald-400 transition-colors text-sm font-medium w-fit">{item}</a>
              ))}
            </div>

            {/* Kontak */}
            <div>
              <h4 className="text-white font-bold text-sm uppercase tracking-widest mb-6">Kontak Kami</h4>
              <div className="space-y-4">
                <p className="text-sm flex flex-col">
                  <span className="text-xs text-slate-500 uppercase font-bold tracking-tighter mb-1">Alamat:</span>
                  {settings?.landing_contact_address || 'Jl. Raya Cikajang No. 104, Garut'}
                </p>
                <p className="text-emerald-400 font-black text-xl">{settings?.landing_contact_phone || '0838-2209-9034'}</p>
              </div>
            </div>
          </div>

          <div className="mt-20 pt-8 border-t border-slate-800 text-center text-[10px] font-bold uppercase tracking-[0.3em] text-slate-600">
            © {new Date().getFullYear()} PPI 104 Al-Ittihad Cikajang. All Rights Reserved.
          </div>
        </div>
      </footer>

    </div>
  );
}