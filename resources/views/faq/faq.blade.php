@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div id="faq_page" class="container mx-auto py-8" hidden>
    <h1 class="text-2xl font-bold mb-6">Frequently Asked Questions</h1>
    @if(auth()->check() && auth()->user()->is_admin)
        @include('faq.adminFaq')
    @else
        @include('faq.regularFaq')
    @endif
</div>
@vite('resources/js/alpineLoadingWorkarounds/loadFAQS.js')
@endsection
