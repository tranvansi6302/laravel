<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // $groupId = DB::table('groups')->insertGetId([
        //     'name' => 'Administrator',
        //     'user_id' => 0,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // if ($groupId > 0) {
        //     $userId = DB::table('users')->insertGetId([
        //         'name' => 'Văn Sĩ',
        //         'email' => 'it.sitranvan@gmail.com',
        //         'password' => Hash::make('123456'),
        //         'group_id' => $groupId,
        //         'user_id' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        //     if ($userId > 0) {
        //         $posts = [
        //             [
        //                 'title' => '[IFA 2023] JBL Authentics ra mắt: Dòng loa thông minh dạng cổ điển, hỗ trợ đồng thời hai trợ lý ảo',
        //                 'content' => 'JBL, nhà sản xuất phụ kiện âm thanh hàng đầu thế giới, vừa mới trình làng dòng loa thông minh JBL Authentics hoàn toàn mới, đây là dòng sản phẩm đầu tiên của Harman có khả năng hỗ trợ đồng thời hai trợ lý ảo là Alexa và Google Assistant. Hãy cùng 24h Công nghệ khám phá những tính năng thú vị của những chiếc loa thông minh này nhé!
        //                 JBL vừa công bố một loạt loa thông minh kiểu retro tuyệt đẹp tại sự kiện IFA 2023 Berlin. Bao gồm JBL Authentics 200, Authentics 300 di động và Authentics 500, những chiếc loa này có mức giá từ 329.99 đến 699.99 USD (khoảng 7.9 - 16.9 triệu đồng).',
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ],
        //             [
        //                 'title' => 'Lộ diện thiết bị lưu trữ SSD PCIe 6.0 đầu tiên của Samsung',
        //                 'content' => 'Samsung vừa hé lộ hình ảnh và thông tin về ổ cứng SSD PCIe 6.0 đầu tiên của hãng. Đây là sản phẩm có tên gọi PM1731a, hứa hẹn mang đến hiệu suất đáng kinh ngạc cho các thiết bị lưu trữ dữ liệu.',
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ],
        //             [
        //                 'title' => 'Apple Watch Series 7 sẽ có màn hình lớn hơn và viên pin lớn hơn',
        //                 'content' => 'Theo những thông tin mới nhất, Apple đang chuẩn bị ra mắt phiên bản mới của dòng đồng hồ thông minh Apple Watch Series 7 với nhiều cải tiến đáng chú ý. Một trong những điểm đáng kể là màn hình lớn hơn và viên pin có dung lượng tốt hơn.',
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ],
        //             [
        //                 'title' => 'Instagram ra mắt tính năng mới cho phép chia sẻ link trong Stories',
        //                 'content' => 'Instagram vừa cho ra mắt tính năng mới cho phép người dùng chia sẻ các liên kết trực tiếp trong phần Stories. Điều này sẽ giúp các người dùng có thể chia sẻ nhanh chóng các trang web, sản phẩm, hoặc nội dung khác mà họ muốn.',
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ],
        //             [
        //                 'title' => 'Microsoft công bố Windows 11 chính thức: Giao diện mới, tích hợp Microsoft Teams',
        //                 'content' => 'Sau nhiều tin đồn và chờ đợi, Microsoft đã chính thức công bố hệ điều hành mới của họ là Windows 11. Phiên bản này đem đến nhiều cải tiến về giao diện người dùng, tích hợp sâu với Microsoft Teams, và nhiều tính năng mới khác.',
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ],
        //         ];
        //         DB::table('posts')->insert($posts);
        //     }
        // }
        DB::table('modules')->insert(
            [
                'name' => 'users',
                'title' => 'Quản lý người dùng',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );
        DB::table('modules')->insert([
            'name' => 'groups',
            'title' => 'Quản lý nhóm',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name' => 'posts',
            'title' => 'Quản lý bài viết',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
