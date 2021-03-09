<?php

namespace App\Http\Livewire\Pengembalian;

use App\Models\LoanReturn;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
  public $loan = [];
  public $header = [];

  public $tgl_kembali = null;
  public $user = [];
  
  public $denda = 0;
  public $diff = 0;
  public $denda_lainnya = 0;
  public $keterangan = null;

  protected $listeners = [
    'do-pengembalian-edit' => 'doPengembalianEdit',
    'clear-attr-edit' => 'clearAttrEdit',
    'cancel-edit' => 'cancelEdit',
  ];

  public function render()
  {
    return view('livewire.pengembalian.edit');
  }

  public function updatedTglKembali($value)
  {
    // dd($value);
    $tgl_pinjam = new DateTime($this->header->tanggal_pinjam);
    $tgl_kembali = new DateTime($this->tgl_kembali);
    $diff = $tgl_pinjam->diff($tgl_kembali);

    $int_diff = (int) $diff->format('%r%a');
    $int_diff > 3 ? $int_diff -= 3 : $int_diff = 0;

    $this->diff = $int_diff;
  }

  public function doPengembalianEdit($id)
  {
    try {
      $this->emit('closePengembalianDetail');

      $loan = LoanReturn::findOrFail($id);
      $this->loan = $loan;
      $this->header = $loan->header;
      $this->user = auth()->user()->toArray();
      
      $this->tgl_kembali = $loan->tgl_kembali;
      $this->diff = $loan->keterlambatan;
      if ($loan->denda != 0) {
        $this->denda = $loan->denda / $loan->keterlambatan;
      } else {
        $this->denda = 500;
      }
      $this->denda_lainnya = $loan->denda_lainnya;
      $this->keterangan = $loan->keterangan;


      $this->emit('openPengembalianEdit');
      // dd($loan->header);
    } catch (\Exception $e) {
      dd($e);
      $this->emit('error', 'Tejadi Kesalahan !');
    }
  }

  public function clearAttrEdit()
  {
    $this->reset(['loan', 'header']);
  } 

  public function cancelEdit()
  {
    $this->emit('closePengembalianEdit');
    $this->emit('get-pengembalian', $this->header->id);
  }

  public function buatEdit()
  { 
    try {
      $loan = LoanReturn::findOrFail($this->loan->id);

      DB::beginTransaction();

      $loan->delete();
      $new = LoanReturn::firstOrCreate([
        'header_id' => $this->header->id,
        'tgl_kembali' => $this->tgl_kembali,
        'keterlambatan' => $this->diff,
        'denda' => $this->denda * $this->diff,
        'denda_lainnya' => $this->denda_lainnya,
        'keterangan' => $this->keterangan,
        'user_id' => $this->user['id'],
        'edit_id' => $this->loan->id,
      ]);

      $loan->update([
        'new_id' => $new->id
      ]);
      
      DB::commit();

      $this->emit('warning', 'Data Pengembalian di-Ubah !');
      $this->cancelEdit();
    } catch (\Exception $e) {
      DB::rollback();
      $this->emit('error', 'Terjadi Kesalahan !');
    }
  }
}
