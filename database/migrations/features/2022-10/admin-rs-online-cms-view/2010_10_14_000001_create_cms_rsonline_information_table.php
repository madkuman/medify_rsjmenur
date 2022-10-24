<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsRsonlineInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('online')->create('cms_information_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::connection('online')->table('cms_information_page')->insert([
            ['name' => 'Halaman Panduan',
             'slug' => 'halaman-panduan',
             'content' => null
            ],
            ['name' => 'Halaman Kebijakan Privasi',
             'slug' => 'halaman-kebijakan-privasi',
             'content' => null
            ],
            ['name' => 'Halaman Tentang Aplikasi',
             'slug' => 'halaman-tentang-aplikasi',
             'content' => null
            ],
            ['name' => 'Halaman Call Center',
             'slug' => 'halaman-call-center',
             'content' => null
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('online')->dropIfExists('cms_information_page');
    }
}
