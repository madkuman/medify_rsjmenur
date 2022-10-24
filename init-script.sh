#composer update;
#cp _env.txt .env;
#php artisan config:cache;

#install and elasticsearch
#apt-get install apt-transport-https
#wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
#add-apt-repository "deb https://artifacts.elastic.co/packages/7.x/apt stable main"
#apt-get update
#apt-get install elasticsearch
#/bin/systemctl enable elasticsearch.service
#systemctl enable elasticsearch.service
#systemctl start elasticsearch.service

#create and import index ES
php artisan elastic:drop-index "App\IndexConfig\UserHospital";
php artisan elastic:create-index "App\IndexConfig\UserHospital";
php artisan scout:import "App\User";

php artisan elastic:drop-index "App\IndexConfig\Pasien";
php artisan elastic:create-index "App\IndexConfig\Pasien";
php artisan scout:import "App\Models\Pasien\Pasien";

php artisan elastic:drop-index "App\IndexConfig\Grup";
php artisan elastic:create-index "App\IndexConfig\Grup";
php artisan scout:import "App\Models\Hospital\Grup";

php artisan elastic:drop-index "App\IndexConfig\FarmasiItems";
php artisan elastic:create-index "App\IndexConfig\FarmasiItems";
php artisan scout:import "App\Models\Farmasi\ItemsTemplate";

php artisan elastic:drop-index "App\IndexConfig\Icd9";
php artisan elastic:create-index "App\IndexConfig\Icd9";
php artisan scout:import "App\Models\Kasus\ICD9";

php artisan elastic:drop-index "App\IndexConfig\Icd10";
php artisan elastic:create-index "App\IndexConfig\Icd10";
php artisan scout:import "App\Models\Kasus\ICD10";

php artisan elastic:drop-index "App\IndexConfig\Pegawai";
php artisan elastic:create-index "App\IndexConfig\Pegawai";
php artisan scout:import "App\Models\Kepegawaian\Pegawai";

php artisan elastic:drop-index "App\IndexConfig\KeuanganTarif";
php artisan elastic:create-index "App\IndexConfig\KeuanganTarif";
php artisan scout:import "App\Models\Keuangan\TarifMaster";

php artisan elastic:drop-index "App\IndexConfig\Alkes";
php artisan elastic:create-index "App\IndexConfig\Alkes";
php artisan scout:import "App\Models\CSSD\Alkes";

php artisan elastic:drop-index "App\IndexConfig\Kasus";
php artisan elastic:create-index "App\IndexConfig\Kasus";
php artisan scout:import "App\Models\Kasus\Kasus";

php artisan elastic:drop-index "App\IndexConfig\EusulanAkunRekening";
php artisan elastic:create-index "App\IndexConfig\EusulanAkunRekening";
php artisan scout:import "App\Models\Eusulan\AkunRekening";

#permission
chown -R www-data settings;
chmod 775 -R settings;

chown -R www-data public;
chmod 775 -R public;

chown -R www-data storage;
chmod 775 -R storage;

chown -R www-data bootstrap;
chmod 775 -R bootstrap;
