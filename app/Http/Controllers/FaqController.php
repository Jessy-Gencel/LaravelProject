<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            $faqs = Faq::orderBy('category')->get();
            $categories = Faq::select('category')->distinct()->pluck('category');
            return view('faq.adminFaq', compact('faqs', 'categories'));
        }else{
            $faqs = Faq::where('status', 'approved')->with('user')->orderBy('category')->get();
            $categories = Faq::select('category')->distinct()->pluck('category');
            return view('faq.adminFaq', compact('faqs', 'categories'));
        }
    }
    public function showAddQuestionForm()
    {
        $categories = Faq::select('category')->distinct()->pluck('category');
        return view('faq.addQuestionForm',compact('categories')); 
    }
    public function storeQuestion(Request $request)
    {    
        Log::info($request->all());
        if ($request->category == null) {
            $request['category'] = "General";
        }
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'answer' => 'nullable|string'
        ]);

        if (auth()->user()->is_admin) {
            $validated['description'] = "admin added the question";
        }

        Faq::create([
            'category' => $validated['category'],
            'question' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'answer' => $validated['answer'] ?? null,
            'user_id' => auth()->id(),
            'status' => auth()->user()->is_admin ? 'approved' : 'pending'
        ]);

        return redirect()->route('faq.main')->with([
            'status' => auth()->user()->is_admin ? 'FAQ creation successful, article created successfully!' : 'FAQ creation successful, your question is pending approval!',
            'status_type' => 'bg-green-500'
        ]);;
    }
    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('faq.main')->with([
            'status' => 'FAQ deleted successfully!',
            'status_type' => 'bg-green-500'
        ]);;
    }
    public function updateFaq(Request $request, $id)
    {
        Log::info("test");
        Log::info($request->all());
        $faq = Faq::findOrFail($id);
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer
        ]);
        return redirect()->route('faq.main')->with([
            'status' => 'FAQ updated successfully!',
            'status_type' => 'bg-green-500'
        ]);;
    }
    public function updateCategory(Request $request)
    {
        $request->validate([
            'oldCategory' => 'required|string',
            'newCategory' => 'required|string|max:255',
        ]);
        Faq::where('category', $request->oldCategory)->update(['category' => $request->newCategory]);
        Log::info("yey");
        return redirect()->route('faq.main')->with([
            'status' => 'Question category updated successfully!',
            'status_type' => 'bg-green-500'
        ]);;
    }
    public function showDetailsFaq($id)
    {
        $faq = Faq::findOrFail($id);
        return view('faq.detailPage', compact('faq'));
    }
    public function approveFaq(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'status' => 'approved'
        ]);

        return redirect()->route('faq.main')->with([
            'status' => 'FAQ approved successfully!',
            'status_type' => 'bg-green-500'
        ]);;
    }
}
