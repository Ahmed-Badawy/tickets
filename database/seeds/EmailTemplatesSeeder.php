<?php
use Illuminate\Database\Seeder;
class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->truncate();
/**
 * Cities
 */
        $emailTemps=
            [
                [
                    'id' => 1,
                    'name' => 'Add Admin User',
                    'content' => 'You have been added as an admin user at SUMED.',
                    'category' => 'Admin Activity',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 2,
                    'name' => 'Edit Admin User',
                    'content' => 'Your Email/Password has been changed to:',
                    'category' => 'Admin Activity',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 3,
                    'name' => 'Invite Supplier',
                    'content' => 'You have been added as a supplier at SUMED system. please use these credentials to complete your data.',
                    'category' => 'Supplier Activity',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 4,
                    'name' => 'Supplier Activity Update',
                    'content' => 'This Activity has been approved by SUMED admin.',
                    'category' => 'Supplier Activity Update',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 6,
                    'name' => 'Supplier Registration Alert 7 days',
                    'content' => 'You Are about to be deleted from the system in 7 days',
                    'category' => 'Supplier Registration Cycle Alerts',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ]
                ,                [
                    'id' => 7,
                    'name' => 'Supplier Registration Alert 14 days',
                    'content' => 'You Are about to be deleted from the system in 14 days',
                    'category' => 'Supplier Registration Cycle Alerts',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ]
                ,                [
                    'id' => 8,
                    'name' => 'Supplier Registration Alert 15 days',
                    'content' => 'You Are about to be deleted from the system in 15 days',
                    'category' => 'Supplier Registration Cycle Alerts',
                    'lang' => 'en',
                    'deletable'  => "1",
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ];


        DB::table('email_templates')->insert($emailTemps);
    }
}


