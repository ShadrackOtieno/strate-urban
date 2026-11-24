@extends('layouts.site')
@section('title', $title)

@section('content')
@include('partials.page-header', ['title' => $title])
<div class="mx-auto max-w-3xl space-y-5 px-6 py-20 text-lg leading-relaxed text-ink/80">
    <p class="bg-sand p-4 text-sm">This is a starting template, not legal advice. Have a lawyer review and adapt it for {{ $site['company_name'] ?? 'your company' }} before you rely on it.</p>
    @if ($kind === 'privacy')
        <h2 class="font-serif-d text-xl font-semibold text-ink">What we collect</h2>
        <p>When you send an enquiry, subscribe to our newsletter or contact us, we collect the details you give us, such as your name, email address, phone number and message.</p>
        <h2 class="font-serif-d text-xl font-semibold text-ink">How we use it</h2>
        <p>We use your details to respond to your enquiry, arrange viewings, send the updates you asked for and improve our service. We do not sell your personal data.</p>
        <h2 class="font-serif-d text-xl font-semibold text-ink">Sharing and storage</h2>
        <p>We share information only with people who help us serve you (for example a property owner, lawyer or developer you have asked about) or where the law requires it. We keep your information only as long as needed for these purposes.</p>
        <h2 class="font-serif-d text-xl font-semibold text-ink">Your rights</h2>
        <p>You can ask to see, correct or delete your personal data, or to stop receiving emails, by writing to {{ $site['email'] ?? 'us' }}. We handle personal data in line with the Kenya Data Protection Act, 2019.</p>
    @else
        <h2 class="font-serif-d text-xl font-semibold text-ink">Using this website</h2>
        <p>The information on this website is provided in good faith and may change without notice. Photographs and illustrations are indicative and listings may sell or let before they are updated.</p>
        <h2 class="font-serif-d text-xl font-semibold text-ink">Prices and availability</h2>
        <p>Prices, sizes and payment plans are subject to confirmation in writing. A listing is not an offer until a sale agreement or lease is signed.</p>
        <h2 class="font-serif-d text-xl font-semibold text-ink">Investment information</h2>
        <p>Any figures about rental or hotel income are estimates based on assumptions and are not guaranteed. Property values can fall as well as rise. Seek independent legal and financial advice before you commit.</p>
        <h2 class="font-serif-d text-xl font-semibold text-ink">Contact</h2>
        <p>Questions about these terms can be sent to {{ $site['email'] ?? 'us' }}.</p>
    @endif
</div>
@endsection
