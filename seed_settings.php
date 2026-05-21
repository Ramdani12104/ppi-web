<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;

$settings = [
    [ 'key' => 'header_title', 'value' => 'Pesantren Persatuan Islam 104', 'type' => 'text', 'group' => 'header' ],
    [ 'key' => 'header_subtitle', 'value' => 'Al-Ittihad Cikajang', 'type' => 'text', 'group' => 'header' ],
    [ 'key' => 'header_tagline', 'value' => 'Melayani Masyarakat Menuju Ridho Allah', 'type' => 'text', 'group' => 'header' ],
    
    [ 'key' => 'location_title', 'value' => 'PPI 104 Cikajang', 'type' => 'text', 'group' => 'general' ],
    [ 'key' => 'address_line_1', 'value' => 'Pesantren Persatuan Islam 104 Cikajang', 'type' => 'text', 'group' => 'general' ],
    [ 'key' => 'address_line_2', 'value' => 'Kp. Rancapandan, Ds. Mekarjaya, Kec. Cikajang,', 'type' => 'text', 'group' => 'general' ],
    [ 'key' => 'address_line_3', 'value' => 'Kabupaten Garut, Jawa Barat 44171.', 'type' => 'text', 'group' => 'general' ],
    [ 'key' => 'phone_number', 'value' => '+62 262 2579254', 'type' => 'text', 'group' => 'general' ],
    [ 'key' => 'email_address', 'value' => 'info@alittihad104.sch.id', 'type' => 'text', 'group' => 'general' ],
    
    [ 'key' => 'footer_address', 'value' => 'Jl. Raya Cikajang No. 104, Garut', 'type' => 'text', 'group' => 'footer' ],
    [ 'key' => 'footer_phone', 'value' => '0838-2209-9034', 'type' => 'text', 'group' => 'footer' ],
];

Setting::truncate();
foreach($settings as $s) {
    Setting::create($s);
}
echo "Settings seeded successfully\n";
