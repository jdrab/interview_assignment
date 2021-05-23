<?php


use Phinx\Seed\AbstractSeed;

class Comments extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $data = [];
        $manual = [];
        $manual[0] = [
            'created_at' => '2021-04-26 03:42:46',
            'ref_to_comment_id' => null,
            'thread_id' => 1,
        ];
        $manual[1] = [
            'created_at' => '2021-04-27 11:47:41',
            'ref_to_comment_id' => null,
            'thread_id' => 2,
        ];
        $manual[2] = [
            'created_at' => '2021-04-29 19:49:35',
            'ref_to_comment_id' => 2,
            'thread_id' => 2,
        ];
        $manual[3] = [
            'created_at' => '2021-05-05 14:59:39',
            'ref_to_comment_id' => 3,
            'thread_id' => 2,
        ];
        $manual[4] = [
            'created_at' => '2021-05-07 04:26:22',
            'ref_to_comment_id' => null,
            'thread_id' => 4,
        ];
        $manual[5] = [
            'created_at' => '2021-05-08 15:45:01',
            'ref_to_comment_id' => null,
            'thread_id' => 5,
        ];
        $manual[6] = [
            'created_at' => '2021-05-14 02:27:53',
            'ref_to_comment_id' => 6,
            'thread_id' => 5,
        ];
        $manual[7] = [
            'created_at' => '2021-04-26 10:47:55',
            'ref_to_comment_id' => 6,
            'thread_id' => 5,
        ];
        $manual[8] = [
            'created_at' => '2021-04-26 10:47:55',
            'ref_to_comment_id' => 6,
            'thread_id' => 5,
        ];
        $manual[9] = [
            'created_at' => '2021-04-26 10:47:55',
            'ref_to_comment_id' => 8,
            'thread_id' => 5,
        ];
        $manual[10] = [
            'created_at' => '2021-04-26 10:47:55',
            'ref_to_comment_id' => null,
            'thread_id' => 6,

        ];

        for ($i = 1; $i < 12; $i++) {
            $data[] = [
                'created_at' => $manual[$i - 1]['created_at'],
                'author' => $faker->name,
                'body' => $faker->realText(200, 2),
                'article_id' => 1,
                'thread_id' => $manual[$i - 1]['thread_id'],
                'ref_to_comment_id' => $manual[$i - 1]['ref_to_comment_id']
            ];
        }

        $this->table('comments')->insert($data)->save();
    }
}
