<?php

use Illuminate\Database\Seeder;


class configSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
            [
                'type' => 'ads',
                'content' => json_encode([
                    ['name' => '', 'image' => 'public/assets/images/bn1.jpg', 'url' => '#'],
                    ['name' => '', 'image' => 'public/assets/images/bn2.jpg', 'url' => '#'],
                ])
            ],
            [
                'type' => 'site_info',
                'content' => json_encode([
                    'site_logo' => 'public/assets/images/logo.png',
                    'site_favicon' => 'public/assets/images/logo.png',
                    'site_title' => 'Sahana',
                    'site_description' => 'Chúng tôi chuyên cung cấp các sản phẩm thực phẩm sạch an toàn cho sức khỏe con người',
                    'site_keyword' => 'mỹ phẩm, cosmetic',
                    'site_address' => 'Tầng 8, Tòa nhà TOYOTA Thanh Xuân',
                    'site_email' => 'info@gco.vn',
                    'site_phone' => '(023)7 309 885',
                    'site_hotline' => '0923 444 567',
                    'site_robot' => 0,
                    'site_google_analytics' => '',
                    'site_map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.763406855395!2d105.82140931444484!3d21.002118994064183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac869b414285%3A0x85c855baed80dd14!2zMzE1IFRyxrDhu51uZyBDaGluaCwgS2jGsMahbmcgVGjGsOG7o25nLCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1550402000049" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
                ])
            ],
            [
                'type' => 'social',
                'content' => json_encode([
                    'zalo' => ['name' => 'Zalo', 'url' => '#'],
                    'facebook' => ['name' => 'Facebook', 'url' => '#'],
                    'instagram' => ['name' => 'Instagram', 'url' => '#'],
                    'youtube' => ['name' => 'Youtube', 'url' => '#'],
                    'google_plus' => ['name' => 'Google Plus', 'url' => '#'],
                ])
            ],

            [
                'type' => 'other',

                'content' => json_encode([
                    'header_recruitment' => [
                        'content' => 'https://drive.google.com/open?id=1nUZ1XtQ6xlKJ1pEvNMaisz5UQ61poxQFpqqmOV4tK6M'
                    ]
                ])

            ],

        ];
        DB::table('confighome')->insert($data);
    }
}
