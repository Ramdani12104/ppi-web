<?php

namespace App\Helpers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Get;
use Illuminate\Support\HtmlString;

class MediaHelper
{
    /**
     * Standardized file upload for images.
     */
    public static function imageUpload(string $name, string $label = null, string $directory = 'website', string $preset = 'content'): FileUpload
    {
        $label = $label ?? ucwords(str_replace('_', ' ', $name));
        
        $width = 1200;
        $height = 800;
        
        if ($preset === 'banner') {
            $width = 1920;
            $height = 1080;
        } elseif ($preset === 'avatar' || $preset === 'logo') {
            $width = 400;
            $height = 400;
        }
        
        $upload = FileUpload::make($name)
            ->label($label)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->visibility('public')
            ->preserveFilenames(false)
            ->maxSize(5120); // 5MB limit

        if ($preset === 'logo' || $preset === 'avatar') {
            // For logos and avatars, support SVG, and DO NOT apply resizing/editor
            // because resizing/editing will crop logos or fail for SVGs.
            $upload->acceptedFileTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/svg+xml'
            ])
            ->helperText('Format: SVG, PNG, JPG, JPEG, WEBP. Max: 5MB.');
        } else {
            // For general content/banners, do not accept SVG to prevent vector scaling issues,
            // and only resize/edit if GD or Imagick is loaded.
            $upload->acceptedFileTypes([
                'image/jpeg',
                'image/png',
                'image/webp'
            ])
            ->helperText('Format: PNG, JPG, JPEG, WEBP. Max: 5MB.');

            if (extension_loaded('gd') || extension_loaded('imagick')) {
                $upload->imageEditor()
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth($width)
                    ->imageResizeTargetHeight($height);
            }
        }
        
        return $upload;
    }

    /**
     * Standardized YouTube field with live preview.
     */
    public static function youtubeFields(string $name = 'youtube_link'): array
    {
        return [
            TextInput::make($name)
                ->label('Link Video YouTube')
                ->url()
                ->placeholder('https://www.youtube.com/watch?v=...')
                ->live(onBlur: true),
            Placeholder::make($name . '_preview')
                ->label('Preview Video YouTube')
                ->content(function (Get $get) use ($name) {
                    $link = $get($name);
                    if (empty($link)) {
                        return new HtmlString('<p class="text-sm text-gray-500">Masukkan link YouTube untuk melihat preview.</p>');
                    }
                    $embedUrl = self::getYoutubeEmbedUrl($link);
                    if (!$embedUrl) {
                        return new HtmlString('<p class="text-sm text-red-500">Link YouTube tidak valid.</p>');
                    }
                    return new HtmlString('
                        <div class="aspect-video w-full max-w-md rounded-xl overflow-hidden shadow-md">
                            <iframe class="w-full h-full" src="' . e($embedUrl) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    ');
                })
        ];
    }

    /**
     * Parses YouTube video ID from any standard URL format and returns the embed URL.
     */
    public static function getYoutubeEmbedUrl(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/';
        
        if (preg_match($pattern, $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
