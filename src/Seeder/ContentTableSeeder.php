<?php

namespace Uasoft\Badaso\Module\Content\Seeder;

use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @throws Exception
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();

        try {
            \DB::table('content')->delete();

            \DB::table('content')->insert([
                0 => [
                    'id' => 3,
                    'slug' => 'home',
                    'label' => 'Home',
                    'value' => '{"background":{"name":"background","label":"Background","type":"image","data":{}},"title":{"name":"title","label":"Title","type":"text","data":""},"description":{"name":"description","label":"Description","type":"text","data":""}}',
                    'created_at' => '2021-05-25 01:50:52',
                    'updated_at' => '2021-05-25 01:50:52',
                ],
                1 => [
                    'id' => 4,
                    'slug' => 'feature',
                    'label' => 'Feature',
                    'value' => '{"name":{"name":"name","label":"Name","type":"text","data":""},"price":{"name":"price","label":"Price","type":"text","data":""}}',
                    'created_at' => '2021-05-25 01:51:45',
                    'updated_at' => '2021-05-25 01:51:45',
                ],
                2 => [
                    'id' => 5,
                    'slug' => 'sponsor',
                    'label' => 'Sponsor',
                    'value' => '{"badaso_sponsor":{"name":"badaso_sponsor","label":"Badaso Sponsor","type":"image","data":{}},"facebook_sponsor":{"name":"facebook_sponsor","label":"Facebook Sponsor","type":"image","data":{}},"google_sponsor":{"name":"google_sponsor","label":"Google Sponsor","type":"image","data":{}},"windows_sponsor":{"name":"windows_sponsor","label":"Windows Sponsor","type":"image","data":{}}}',
                    'created_at' => '2021-05-25 01:55:52',
                    'updated_at' => '2021-05-25 01:55:52',
                ],
                3 => [
                    'id' => 6,
                    'slug' => 'about',
                    'label' => 'About',
                    'value' => '{"address":{"name":"address","label":"Address","type":"text","data":""},"company_name":{"name":"company_name","label":"Company Name","type":"text","data":""},"privasi_and_cookies":{"name":"privasi_and_cookies","label":"Privasi And Cookies","type":"url","data":{"url":"","text":""}}}',
                    'created_at' => '2021-05-25 01:59:21',
                    'updated_at' => '2021-05-25 01:59:21',
                ],
                4 => [
                    'id' => 7,
                    'slug' => 'sosial-media',
                    'label' => 'Sosial Media',
                    'value' => '{"whatsapp":{"name":"whatsapp","label":"Whatsapp","type":"image","data":{}},"facebook":{"name":"facebook","label":"Facebook","type":"image","data":{}},"instagram":{"name":"instagram","label":"Instagram","type":"image","data":{}},"twitter":{"name":"twitter","label":"Twitter","type":"image","data":{}}}',
                    'created_at' => '2021-05-25 02:00:38',
                    'updated_at' => '2021-05-25 02:00:38',
                ],
                5 => [
                    'id' => 8,
                    'slug' => 'carousel',
                    'label' => 'Carousel',
                    'value' => '{"image_1":{"name":"image_1","label":"Image 1","type":"image","data":{}},"image_2":{"name":"image_2","label":"Image 2","type":"image","data":{}},"image_3":{"name":"image_3","label":"Image 3","type":"image","data":{}},"image_4":{"name":"image_4","label":"Image 4","type":"image","data":{}}}',
                    'created_at' => '2021-05-25 02:01:49',
                    'updated_at' => '2021-05-25 02:01:49',
                ],
            ]);

            \DB::commit();
        } catch (Exception $e) {
            \DB::rollBack();
        }
    }
}
