<?php
namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class FormController extends Controller
{
    protected $questions = [
        1 => 'Apa nama Anda?',
        2 => 'Berapa umur Anda?',
        3 => 'Apa hobi Anda?',
    ];

    public function showForm(Request $request, $page)
    {
        if (!isset($this->questions[$page])) {
            abort(404);
        }

        return view('form', [
            'question' => $this->questions[$page],
            'page' => $page,
        ]);
    }

    public function submitForm(Request $request, $page)
    {
        $request->validate([
            'answer' => 'required|string|max:255',
        ]);

        // Ambil data jawaban dari session atau buat array kosong
        $answers = $request->session()->get('answers', []);
        $answers[$page] = $request->input('answer');

        // Simpan data jawaban ke session
        $request->session()->put('answers', $answers);

        $nextPage = $page + 1;

        if (isset($this->questions[$nextPage])) {
            return redirect()->route('form.show', ['page' => $nextPage])->with('success', 'Jawaban Anda telah diterima.');
        } else {
            // Tampilkan hasil jawaban dengan dd()
            dd($answers);

            // Untuk menyimpan jawaban ke database, gunakan kode berikut:
            // $response = Response::create(['answers' => $answers]);
            // $request->session()->forget('answers');
            // return redirect()->route('form.results')->with('success', 'Terima kasih, Anda telah menyelesaikan semua pertanyaan.');
        }
    }
}
