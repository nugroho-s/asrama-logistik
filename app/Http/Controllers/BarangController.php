<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Redirect;
use App\Barang;

class BarangController extends Controller
{
  public function showAll(){
    $items = Barang::orderBy('nama')->get();
    return \View::make('items', compact("items"));
  }

  public function addForm(){
    return \View::make('addItem');
  }

  //location should be logistik/barang/tambah
  public function addItem(Request $req){
    $querySuccessMessage = "<script>alert('barang berhasil ditambahkan');window.location = '".URL::to('logistik/barang')."';</script>";
    $queryFailMessage = "<script>alert('terjadi kesalahan');window.location = '".URL::to('logistik/barang/tambah')."';</script>";
    try{
      $item = new Barang();
      $item->nama = $req->input('nama');
      $item->satuan = $req->input('satuan');
      $item->stok = $req->input('stok');
      $inserted = $item->save();
      if ($inserted)
        echo $querySuccessMessage;
      else {
        echo $queryFailMessage;
      }
    } catch (QueryException $e) {
      echo $queryFailMessage;
    }
  }
}
