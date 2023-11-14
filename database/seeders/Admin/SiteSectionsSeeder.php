<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\SiteSections;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Constants\SiteSectionConst;
use Illuminate\Support\Str;

class SiteSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'key'       => 'site_cookie',
            'value'     => ['status' => true, 'link' => 'https://www.appdevs.net/policy', 'desc' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
            'status'    => true,
        ];
        SiteSections::firstOrCreate($data);

        $items = [];
        for($i = 0; $i < 5;$i++) {
            $unique_id = uniqid();
            $items["items"][$unique_id] = [
                "image" => "",
                "id"    => $unique_id,
            ];
        }
        $data = [
            'key'   => Str::slug(SiteSectionConst::GLANCE_SECTION),
            'value' => $items,
        ];
        SiteSections::updateOrCreate(['key' => $data['key']],$data);
    }
}
