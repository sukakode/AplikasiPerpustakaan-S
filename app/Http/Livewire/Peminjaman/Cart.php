<?php

namespace App\Http\Livewire\Peminjaman;

use App\Models\Book;
use App\Models\BorrowHeader;
use Livewire\Component;

class Cart extends Component
{
  public $buku = [];
  public $id_buku = '';
  public $detail_buku = [];
  public $qty = 1;

  public $pinjam = [];

  // Editing var
  public $edit = [];

  protected $listeners = [
    'getBuku' => 'getBuku',
    'checkBuku' => 'checkBuku',
    'edit-data' => 'editData',
  ];

  public function mount()
  {
    $this->getBuku();
  }

  public function render()
  {
    return view('livewire.peminjaman.cart');
  }

  public function getBuku()
  {  
    $buku = Book::orderBy('judul', 'ASC')->get();
    $this->buku = $buku;
    $this->emit('refreshSelect2', $this->buku);
  }

  public function checkBuku($id)
  {
    try {
      if (empty($this->edit)) {
        $buku = Book::findOrFail($id);
      } else {
        $buku = Book::withTrashed()->where('id', '=', $id)->firstOrFail();
      }
      $this->id_buku = $buku->id;
      $this->detail_buku = $buku;
      return 1;
    } catch (\Exception $e) {
      $this->resetVar();
      $this->emit('error', 'Terjadi Kesalahan ! Silahkan Coba Lagi !');
      return 0;
    }
  }

  public function resetVar()
  {
    $this->reset(['id_buku', 'detail_buku', 'qty']);
    $this->getBuku();
  }

  public function addBuku()
  {
    $cek = $this->checkBuku($this->id_buku);
    if (!$cek) {
      $this->resetVar();
    } else {
      $this->detail_buku['qty'] = $this->qty;
      $this->pinjam[$this->id_buku] = $this->detail_buku->toArray();

      $this->resetVar();
      if (empty($this->edit)) {
        $this->emit('success', 'Data di-Tambahkan !');
      }
    }
  }

  public function delBuku($id)
  {
    if (isset($this->pinjam[$id])) {
      unset($this->pinjam[$id]);
      $this->emit('warning', 'Buku Yang Akan di-Pinjam di-Hapus !');
    } else {
      $this->resetVar();
      $this->emit('error', 'Terjadi Kesalahan ! Silahkan Coba Lagi !');
    }
  }

  public function editData($id)
  {
    try {
      $header = BorrowHeader::findOrFail($id);
      $this->edit = $header;
      
      foreach ($header->detail as $key => $value) {
        $this->id_buku = $value->buku_id;
        $this->addBuku();
      }

    } catch (\Exception $e) {
      $this->resetVar();
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }
}
