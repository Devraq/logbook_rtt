<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LogbookMockSeeder extends Seeder
{
    public function run()
    {
        // Clear existing (optional)
        DB::table('logs')->delete();
        DB::table('activities')->delete();
        DB::table('jobs')->delete();
        DB::table('users')->delete();

        // Users
        $users = [
            ['id' => 10, 'name' => 'Ketua', 'email' => 'ketua@example.local', 'password' => bcrypt('password')],
            ['id' => 11, 'name' => 'Peneliti 1', 'email' => 'peneliti1@example.local', 'password' => bcrypt('password')],
            ['id' => 12, 'name' => 'Peneliti 2', 'email' => 'peneliti2@example.local', 'password' => bcrypt('password')],
            ['id' => 13, 'name' => 'Peneliti 3', 'email' => 'peneliti3@example.local', 'password' => bcrypt('password')],
            ['id' => 14, 'name' => 'Mahasiswa 1', 'email' => 'mhs1@example.local', 'password' => bcrypt('password')],
        ];
        DB::table('users')->insert($users);

        // Jobs
        $now = Carbon::now()->toDateString();
        $jobs = [
            [
                'id' => 1,
                'title' => 'Pembuatan Artikel 1',
                'description' => 'About user research',
                'start_date' => '2025-05-01',
                'end_date' => '2025-06-21',
                'weight' => 11,
                'created_by' => 10,
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Pembuatan HKI',
                'description' => 'HKI deliverable',
                'start_date' => '2025-05-10',
                'end_date' => '2025-07-01',
                'weight' => 12,
                'created_by' => 10,
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('jobs')->insert($jobs);

        // Activities
        $activities = [
            ['id'=>1001,'job_id'=>1,'parent_id'=>null,'title'=>'Pelajari tentang user','description'=>'Survey and interviews','start_date'=>'2025-05-01','end_date'=>'2025-06-21','assignee_id'=>11,'weight'=>1,'status'=>'ongoing','created_at'=>now(),'updated_at'=>now()],
            ['id'=>1002,'job_id'=>1,'parent_id'=>null,'title'=>'Menulis artikel','description'=>'Draft article','start_date'=>'2025-06-01','end_date'=>'2025-06-10','assignee_id'=>12,'weight'=>1,'status'=>'ongoing','created_at'=>now(),'updated_at'=>now()],
            ['id'=>1003,'job_id'=>1,'parent_id'=>null,'title'=>'Submit & revisi','description'=>'Submission and revision','start_date'=>'2025-06-11','end_date'=>'2025-06-21','assignee_id'=>13,'weight'=>1,'status'=>'ongoing','created_at'=>now(),'updated_at'=>now()],
            ['id'=>2001,'job_id'=>2,'parent_id'=>null,'title'=>'Riset HKI','description'=>'Research HKI','start_date'=>'2025-05-10','end_date'=>'2025-06-01','assignee_id'=>13,'weight'=>1,'status'=>'ongoing','created_at'=>now(),'updated_at'=>now()],
        ];
        DB::table('activities')->insert($activities);

        // Logs (sample)
        $logs = [
            ['id'=>5001,'job_id'=>1,'activity_id'=>1001,'user_id'=>11,'date'=>'2025-05-25','hours'=>3,'percent'=>47.0,'description'=>'Interview 2 users','evidence_url'=>'https://drive.example/file1','created_at'=>now(),'updated_at'=>now()],
            ['id'=>5002,'job_id'=>1,'activity_id'=>1001,'user_id'=>11,'date'=>'2025-05-30','hours'=>4,'percent'=>57.0,'description'=>'Analysis','evidence_url'=>'','created_at'=>now(),'updated_at'=>now()],
        ];
        DB::table('logs')->insert($logs);

        // (Optional) job assignees pivot if you use it
        if (DB::getSchemaBuilder()->hasTable('job_assignees')) {
            DB::table('job_assignees')->delete();
            $jobAssignees = [
                ['job_id'=>1,'user_id'=>10,'role'=>'Ketua','created_at'=>now(),'updated_at'=>now()],
                ['job_id'=>1,'user_id'=>11,'role'=>'Peneliti','created_at'=>now(),'updated_at'=>now()],
                ['job_id'=>2,'user_id'=>13,'role'=>'Peneliti','created_at'=>now(),'updated_at'=>now()],
            ];
            DB::table('job_assignees')->insert($jobAssignees);
        }

        $this->command->info('Logbook mock data seeded.');
    }
}
