<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
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
                'name' => 'Khánh Ly',
                'job'=>'Diến viên',
                'image' => 10,
                'status'=>1,
                'type'=>'product_customer',
                'content' => 'Đây là sản phẩm có hàm lượng X5 nhiều nhất và cao cấp nhất trong dòng dược mỹ phẩm Lysedia. SOI GLOBAL ANTI-AGE là sản phẩm hoàn hảo cho việc nuôi dưỡng sự trẻ trung của làn da với việc cung cấp tổ hợp toàn diện giúp nuôi dưỡng hoàn hảo.',
            ],
            [
                'name' => 'Tường Vi',
                'job'=>'Diến viên',
                'image' => 10,
                'status'=>1,
                'type'=>'product_customer',
                'content' => 'Đây là sản phẩm có hàm lượng X5 nhiều nhất và cao cấp nhất trong dòng dược mỹ phẩm Lysedia. SOI GLOBAL ANTI-AGE là sản phẩm hoàn hảo cho việc nuôi dưỡng sự trẻ trung của làn da với việc cung cấp tổ hợp toàn diện giúp nuôi dưỡng hoàn hảo.',
            ],
            [
                'name' => 'Trang Cherry',
                'job'=>'Diến viên',
                'image' => 10,
                'status'=>1,
                'type'=>'product_customer',
                'content' => 'Đây là sản phẩm có hàm lượng X5 nhiều nhất và cao cấp nhất trong dòng dược mỹ phẩm Lysedia. SOI GLOBAL ANTI-AGE là sản phẩm hoàn hảo cho việc nuôi dưỡng sự trẻ trung của làn da với việc cung cấp tổ hợp toàn diện giúp nuôi dưỡng hoàn hảo.',
            ],
            [
                'name' => 'Quỳnh Lam',
                'job'=>'Diến viên',
                'image' => 10,
                'status'=>1,
                'type'=>'product_customer',
                'content' => 'Đây là sản phẩm có hàm lượng X5 nhiều nhất và cao cấp nhất trong dòng dược mỹ phẩm Lysedia. SOI GLOBAL ANTI-AGE là sản phẩm hoàn hảo cho việc nuôi dưỡng sự trẻ trung của làn da với việc cung cấp tổ hợp toàn diện giúp nuôi dưỡng hoàn hảo.',
            ],
            [
                'name' => 'Huyền Bé',
                'job'=>'Diến viên',
                'image' => 10,
                'status'=>1,
                'type'=>'product_customer',
                'content' => 'Đây là sản phẩm có hàm lượng X5 nhiều nhất và cao cấp nhất trong dòng dược mỹ phẩm Lysedia. SOI GLOBAL ANTI-AGE là sản phẩm hoàn hảo cho việc nuôi dưỡng sự trẻ trung của làn da với việc cung cấp tổ hợp toàn diện giúp nuôi dưỡng hoàn hảo.',
            ],
            [
                'name' => 'Linkka',
                'job'=>'Diến viên',
                'image' => 10,
                'status'=>1,
                'type'=>'product_customer',
                'content' => 'Đây là sản phẩm có hàm lượng X5 nhiều nhất và cao cấp nhất trong dòng dược mỹ phẩm Lysedia. SOI GLOBAL ANTI-AGE là sản phẩm hoàn hảo cho việc nuôi dưỡng sự trẻ trung của làn da với việc cung cấp tổ hợp toàn diện giúp nuôi dưỡng hoàn hảo.',
            ],



        ];
        DB::table('custommer')->insert($data);
    }
}
