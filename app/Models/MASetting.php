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
        'hero_image_1',
        'hero_image_2',
        'hero_image_3',
        'hero_small_text',
        'hero_button_text',
        'hero_button_link',
        'hero_font_size',
        'hero_text_position',
        'hero_overlay_opacity',
        'hero_stats',
        'primary_color',
        'accent_color',
        'hero_small_text_color',
        'hero_heading_color',
        'hero_subheading_color',
        'hero_stats_color',
        'hero_small_font_size',
        'hero_subheading_font_size',
        'hero_stats_font_size',
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
        'hero_stats' => 'array',
        'jurusan' => 'array',
        'fasilitas' => 'array',
        'eskul' => 'array',
        'keunggulan' => 'array',
        'galeri' => 'array',
        'alur_pendaftaran' => 'array',
        'faq' => 'array',
    ];
}
