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
        'youtube_link',
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
    ];
    
    protected $casts = [
        'program_unggulan' => 'array',
        'keunggulan' => 'array',
        'galeri' => 'array',
        'alur_pendaftaran' => 'array',
        'faq' => 'array',
    ];
}
