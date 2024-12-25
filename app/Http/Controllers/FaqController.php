<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('status', 'pending')->with('user')->orderBy('category')->get();
        return view('faq.faq', compact('faqs'));
    }
    public function showAddQuestionForm()
    {
        $categories = Faq::select('category')->distinct()->pluck('category');
        return view('faq.addQuestionForm',compact('categories')); 
    }
    public function storeQuestion(Request $request)
    {    
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'answer' => 'nullable|string'
        ]);
        if (!auth()->user()->isAdmin) {
            $validated['answer'] = null;
        }    
        Faq::create([
            'category' => $validated['category'],
            'question' => $validated['title'],
            'description' => $validated['description'],
            'answer' => $validated['answer'],
            'user_id' => auth()->id(), 
            'status' => auth()->user()->isAdmin ? 'approved' : 'pending'
        ]);    
        return redirect()->route('faq')->with('success', 'Question submitted successfully!');
    }
    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('faq')->with('success', 'Question deleted successfully!');
    }
}
