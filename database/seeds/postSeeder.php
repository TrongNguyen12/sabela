<?php

use Illuminate\Database\Seeder;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name' => 'Sahana - Mỹ phẩm từ thiên nhiên',
                'slug' => str_slug('Sahana - Mỹ phẩm từ thiên nhiên'),
                'image' => 70,
                'content_short' => 'Hoạt động trong lĩnh vực làm đẹp và chăm sóc sức khỏe, Công ty  Sahana luôn chú trọng đến việc xây dựng hình ảnh Tin Cậy – An Toàn – Chất Lượng trong mắt khách hàng.',
                'content_main' => '
                    <div class="text-center"><img src="storage/app/public/assets/images/banner2.jpg" title="" alt=""></div>
                    <h2 class="s18 medium about-stit">Sứ mệnh</h2>
                    <p>Với bản chất là một công ty chuyên phân phối các giao thức làm đẹp hiện đại và tiện dụng từ các cường quốc trên thế giới như Nhật, Pháp… BEHE luôn hướng tới một sứ mệnh rõ ràng “Đem đến những phương pháp làm đẹp phối hợp giữa khoa học tân tiến và thành phần tự nhiên tinh khiết tới tay những khách hàng yêu làm đẹp”. Không xâm lấn – Không dao kéo – Không gây hại nhưng đảm bảo chất lượng và hiệu quả rõ rệt là những tiêu chí mà BEHE Việt Nam muốn hướng tới</p>
                    <h2 class="s18 medium about-stit">Tầm nhìn</h2>
                    <p>“Trở thành một công ty hàng đầu phân phối, cung cấp các phương thức làm đẹp tin cậy nhất, hiệu quả nhất đến tay khách hàng Việt Nam và châu Á. Đồng thời, BEHE Việt Nam cũng muốn trở thành một người bạn đồng hành cũng phái đẹp trên con đường duy trì và chinh phục hạnh phúc”</p>
                       
                ',
                'type' => 'about',
                'status' => 1,
                'parent_id'=>null,
            ],

            [
                'name' => 'BEAUTY',
                'content_main' => 'BEHE đặt vẻ đẹp của khách hàng lên đầu tiên, mọi sản phẩm hay phương thức được đưa tới tay khách hàng đều có hiệu quả làm đẹp rõ rệt.',
                'parent_id'=>1,
                'type' => 'about_value',

                'slug' => null,
                'image' => null,
                'content_short' => null,
                'status' => 1,
            ],
            [
                'name' => 'HEALTHY',
                'content_main' => 'BEHE đặt vẻ đẹp của khách hàng lên đầu tiên, mọi sản phẩm hay phương thức được đưa tới tay khách hàng đều có hiệu quả làm đẹp rõ rệt.',
                 'parent_id'=>1,
                'type' => 'about_value',

                'slug' => null,
                'image' => null,
                'content_short' => null,
                'status' => 1,
            ],
            [
                'name' => 'NATURE',
                'content_main' => 'BEHE đặt vẻ đẹp của khách hàng lên đầu tiên, mọi sản phẩm hay phương thức được đưa tới tay khách hàng đều có hiệu quả làm đẹp rõ rệt.',
                 'parent_id'=>1,
                'type' => 'about_value',

                'slug' => null,
                'image' => null,
                'content_short' => null,
                'status' => 1,
            ],
            [
                'name' => 'VIRTUE',
                'content_main' => 'BEHE đặt vẻ đẹp của khách hàng lên đầu tiên, mọi sản phẩm hay phương thức được đưa tới tay khách hàng đều có hiệu quả làm đẹp rõ rệt.',
                 'parent_id'=>1,
                'type' => 'about_value',

                'slug' => null,
                'image' => null,
                'content_short' => null,
                'status' => 1,
            ],
            

        ];

        for ($i = 7; $i < 20; $i++) {
            $data[$i]['name'] = 'Đừng chỉ chú tâm trang điểm mà quên làm đẹp từ bên trong ' . $i;
            $data[$i]['slug'] = str_slug($data[$i]['name']);
            $data[$i]['image'] = 13;
            $data[$i]['content_short'] = 'Là phụ nữ, ai cũng muốn đẹp và giữ mãi vẻ đẹp ấy bất chấp thời gian, nhưng không phải ai cũng biết cách chăm sóc sắc đẹp để hiện thực hóa điều đó.';
            $data[$i]['content_main'] = '
                                <p>Thuộc thế hệ “hot girl” đời đầu, Tâm Tít được biết đến với hình tượng nữ tính, ngoan hiền và cuộc sống đời tư nói không với thị phi. Cô nhờ thế vẫn được người hâm mộ nhắc đến bằng sự yêu mến chân thành dù đã không còn tham gia hoạt động nghệ thuật một cách mạnh mẽ nữa. </p>
								<div class="text-center">
									<img src="http://localhost:88/sahana-code/public/storage/assets/images/blog10.jpg" alt="" title="">
								</div>
								<p class="s18 bold">"Hot girl" một thời sở hữu vẻ đẹp không tuổi</p>
								<p>Đến thời điểm hiện tại, rời xa hình ảnh “hot girl” trẻ trung, nhí nhảnh, Tâm Tít lại được nhắc đến như hình mẫu lý tưởng của người phụ nữ hiện đại chăm lo cho tổ ấm nhưng không quên chăm sóc và giữ gìn nhan sắc.  </p>

								<p>Theo dõi trang cá nhân của Tâm Tít, người hâm mộ không khỏi bất ngờ về thân hình chuẩn cùng gương mặt không hề có dấu hiệu lão hoá. Vẻ đẹp của phụ nữ tuổi 30 quả nhiên đánh dấu mốc của sự viên mãn chứ hoàn toàn không phải chạm đến ranh giới của sự già nua.</p>

								<div class="text-center">
									<img src="http://localhost:88/sahana-code/public/storage/assets/images/blog11.jpg" alt="" title="">
								</div>
								<p class="text-center italic">Bước sang tuổi 30 và đã là mẹ hai con, Tâm Tít vẫn giữ được vóc dáng khoẻ mạnh và làn da không tì vết</p>

								<p>Tâm Tít cho rằng ai cũng yêu thích và mong muốn có được vẻ đẹp tự nhiên nhưng không phải cứ tự nhiên mà đẹp. Giống như bao phụ nữ khác, Tâm Tít cũng phải đối mặt với những vấn đề tâm sinh lý thường gặp ở độ tuổi 30, đặc biệt là vấn đề rối loạn nội tiết tố. Tuy nhiên, Tâm luôn có bí quyết của riêng mình để giữ gìn sức khoẻ và nhan sắc. </p>
            ';
            $data[$i]['type'] = 'blog';
            $data[$i]['status'] = 1;
            $data[$i]['parent_id'] = null;
        }

        DB::table('post')->insert($data);
    }
}
