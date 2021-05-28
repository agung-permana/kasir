<?php

namespace App\Http\Controllers;

use App\Models\Temporder;
use Illuminate\Http\Request;

class TemporderController extends Controller
{
    public function addProduct(Request $request)
    {
        Temporder::create([
            'product_id' => $request->id,
            'product_name' => $request->menu,
            'product_price' => $request->price,
            'qty' => $request->qty,
            'subtotal' => $request->price * $request->qty
        ]);

        return redirect()->back();
    }

    public function destroy(Temporder $temporder)
    {
        $temporder->delete();

        return redirect()->back();
    }
}
