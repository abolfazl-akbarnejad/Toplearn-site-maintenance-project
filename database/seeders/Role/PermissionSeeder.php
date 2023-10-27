<?php

namespace Database\Seeders\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisios = [
            'نمایش پست ها' => 'میتواند پست هایی که بر روی سایت هستند را ببیند',
            'ایجاد پست جدید' => 'میتواند پست هایی برای قرار گیری روی سایت بارگزاری کند',
            'ویرایش پست ها' => 'میتواند پست هایی که بر روی سایت هستند را ویرایش کند',
            'حذف پست ها' => 'میتواند پست هایی که بر روی سایت هستند را حذف کند',
            'تغیر وضعیت پست  ها' => 'میتواند وضعیت پست ها را فعال یا غیر فعال کند',
            'نمایش نظر  ها' => 'میتواند نظر های قرار گرفته در پست ها را ببیند',
            'تغیر وضعیت نظر ها' => 'میتواند وضعیت پست ها را فعال یا غیر فعال کند'
        ];
        foreach ($permisios as $key => $permision) {


            DB::table('permissions')->insert([
                'name' => $key,
                'desctiption' => $permision,
                'status' => 1,

            ]);
        }
    }
}
