<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MTsSetting extends Model
{
    protected $table = 'mts_settings';
    
    protected $fillable = [
        'hero_heading',
        'hero_subheading',
        'hero_banner',
        'logo',
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
        'youtube_kegiatan_link',
        'program_unggulan',
        'sejarah_mts',
        'cta_text',
        'cta_link',
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
        'ekstrakurikuler',
        'sambutan_title',
        'sambutan_desc',
        'sambutan_quote',
        'sambutan_media_type',
        'sambutan_video_url',
        'kegiatan_media_type',
        'kegiatan_embed_code',
        'kegiatan_video_file',
    ];
    
    protected $casts = [
        'hero_stats' => 'array',
        'program_unggulan' => 'array',
        'keunggulan' => 'array',
        'galeri' => 'array',
        'alur_pendaftaran' => 'array',
        'faq' => 'array',
        'ekstrakurikuler' => 'array',
    ];
}
