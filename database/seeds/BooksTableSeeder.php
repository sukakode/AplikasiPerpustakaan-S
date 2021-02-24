<?php

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $books = [
        [
          'judul' => 'Buku A',
          'penerbit' => 'Penerbit A',
          'pengarang' => 'Pengarang A',
          'tahun' => date('Y'),
        ],
        [
          'judul' => 'Buku B',
          'penerbit' => 'Penerbit B',
          'pengarang' => 'Pengarang B',
          'tahun' => date('Y'),
        ],
        [
          'judul' => 'Buku C',
          'penerbit' => 'Penerbit C',
          'pengarang' => 'Pengarang C',
          'tahun' => date('Y'),
        ],
      ];
      
      foreach ($books as $key => $value) {
        try {
          $book = Book::firstOrCreate($value);
        } catch (\Exception $e) {
          echo $e;
        }
      }
    }
}
