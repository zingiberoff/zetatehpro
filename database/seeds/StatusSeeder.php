<?php

use App\ProjectStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $statusList = [
            [
                'code' => 'new',
                'name' => 'Создан',
                'action_name' => '',
                'description' => 'Созданный проект который можно редактировать',
                'next_statuses' => ['user'=>['checked']]
            ],
            [
                'code' => 'checked',
                'name' => 'На проверке',
                'action_name' => 'Отправить на проверку',
                'description' => 'Отправленный на проверку менеджеру проект, пользователь не может более вносить в него изменения, после проверки менеджер подтверждает проект',
                'next_statuses' => ['moderator'=>['confirm']]
            ],

            [
                'code' => 'confirm',
                'name' => 'Подтвержден',
                'action_name' => 'Подтвердить',
                'description' => 'Проект подтвержден',
                'next_statuses' => ['moderator'=>['realize']]
            ],
            [
                'code' => 'realize',
                'name' => 'Реализован',
                'action_name' => 'Подтвердить реализацию проекта',
                'description' => 'Проект реализацию',
                'next_statuses' => ['moderator'=>['paid']]
            ],

            [
                'code' => 'paid',
                'name' => 'Оплачен',
                'action_name' => 'Подтвердить оплату проекта',
                'description' => 'Проект оплачен',
                'next_statuses' => []
            ],
        ];

        foreach ($statusList as $statusData) {
            $statusData['next_statuses']=json_encode($statusData['next_statuses']);
            ProjectStatus::create($statusData);

        }

    }

}
