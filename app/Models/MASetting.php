<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MASetting extends Model
{
    protected $table = 'ma_settings';

    protected $fillable = [
        'logo',
        'hero_banner',
        'hero_heading',
        'hero_subheading',
        'hero_title',
        'youtube_link',
        'jurusan',
        'sejarah_ma',
        'sejarah_button_text',
        'fasilitas',
        'eskul',
        'instagram_link',
        'facebook_link',
        'youtube_channel_link',
        'tiktok_link',
        'whatsapp_link',
        'keunggulan',
        'kurikulum_detail',
        'galeri',
        'alur_pendaftaran',
        'faq',
        'whatsapp_admin',
    ];

    protected $casts = [
        'jurusan' => 'array',
        'fasilitas' => 'array',
        'eskul' => 'array',
        'keunggulan' => 'array',
        'galeri' => 'array',
        'alur_pendaftaran' => 'array',
        'faq' => 'array',
    ];
}
