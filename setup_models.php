<?php
$models = ['News', 'Testimonial', 'Program', 'Extracurricular', 'Setting'];
foreach($models as $m){
    file_put_contents(__DIR__.'/app/Models/'.$m.'.php', "<?php\nnamespace App\Models;\nuse Illuminate\Database\Eloquent\Model;\nclass $m extends Model {\n    protected \$guarded = [];\n}\n");
}
