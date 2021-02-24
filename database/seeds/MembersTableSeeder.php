<?php

use App\Models\Member;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $members = [
        [
          'nama_anggota' => 'Anggota A',
          'alamat_anggota' => 'Alamat A',
          'telp_anggota' => '85712345671',
        ],
        [
          'nama_anggota' => 'Anggota B',
          'alamat_anggota' => 'Alamat B',
          'telp_anggota' => '85712345672',
        ],
        [
          'nama_anggota' => 'Anggota C',
          'alamat_anggota' => 'Alamat C',
          'telp_anggota' => '85712345673',
        ],
      ];

      foreach ($members as $key => $value) {
        try {
          $member = Member::firstOrCreate($value);
        } catch (\Exception $e) {
          echo $e;
        }
      }
    }
}
