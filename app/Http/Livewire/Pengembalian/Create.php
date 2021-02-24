<?php

namespace App\Http\Livewire\Pengembalian;

use App\Models\BorrowHeader;
use App\Models\LoanReturn;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class Create extends Component
{
  public $header = [];
  
  public $tgl_kembali = null;
  public $user = [];

  public $denda = 500;
  public $diff = 0;

  public $denda_lainnya = 0;
  public $keterangan = null;
  

  protected $listeners = [
    'do-pengembalian' => 'doPengembalian',
    'clear-attr' => 'clearAttr',
  ];

  public function hydrate()
  {
    $this->tgl_kembali = date('Y-m-d');
    $this->user = auth()->user()->toArray();
  }

  public function mount()
  {
    $this->tgl_kembali = date('Y-m-d');
    $this->user = auth()->user()->toArray();
  }

  public function render()
  {
    return view('livewire.pengembalian.create');
  }

  public function doPengembalian($id)
  {
    try {
      $header = BorrowHeader::findOrFail($id);
      $this->header = $header;

      $tgl_pinjam = new DateTime($header->tanggal_pinjam);
      $tgl_kembali = new DateTime($this->tgl_kembali);
      $diff = $tgl_pinjam->diff($tgl_kembali);

      $int_diff = (int) $diff->format('%r%a');
      $int_diff > 3 ? $int_diff -= 3 : $int_diff = 0;

      $this->diff = $int_diff;

      $this->emit('openPengembalian');
    } catch (\Exception $e) {
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }

  public function clearAttr()
  {
    $this->reset(['header', 'tgl_kembali', 'user', 'diff', 'denda_lainnya', 'keterangan']);
  }

  public function buatPengembalian()
  {
    try {
      $simpan = LoanReturn::firstOrCreate([
        'header_id' => $this->header->id,
        'tgl_kembali' => $this->tgl_kembali,
        'keterlambatan' => $this->diff,
        'denda' => $this->denda * $this->diff,
        'denda_lainnya' => $this->denda_lainnya,
        'keterangan' => $this->keterangan,
        'user_id' => $this->user['id']
      ]);
  
      $this->emit('success', 'Data Pengembalian di-Buat !');
      $this->emit('closePengembalian');
      $this->emit('reloadPage');
    } catch (\Exception $e) {
      $this->emit('error', 'Terjadi Kesalahan ! (buatPengembalian())');
    }
  }
}
