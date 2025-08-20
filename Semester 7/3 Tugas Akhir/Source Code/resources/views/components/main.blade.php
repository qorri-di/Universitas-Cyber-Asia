<!-- resources/views/components/main.blade.php -->
<!--<main class="ml-64 mt-16 mb-16 p-6 bg-gray-100 bottom-0 right-0 min-h-[calc(100vh-4rem)]">-->
@php
$segments = explode('.', $content);
$breadcrumb = '';

if (count($segments) === 1) {
    $breadcrumb = ucfirst($segments[0]);
} elseif (count($segments) === 2) {
    if ($segments[1] == 'index'){
        $breadcrumb = ucfirst($segments[0]);
    } else {
        $breadcrumb = ucfirst($segments[0]) . ' / ' . ucwords(str_replace('-', ' ', $segments[1]));
    }
} else {
    $breadcrumb = ucwords(str_replace('.', ' / ', $content));
}
@endphp

<main class="bg-gray-100 min-h-[calc(100vh-4rem)] px-4 py-6 pt-20 sm:pt-24 sm:ml-64 overflow-hidden">
    <div class="mb-4 border-b pb-2">
        <h2 class="text-2xl font-semibold text-gray-700">Dashboard /  {{ $breadcrumb }}</h2>
    </div>

    <!-- Dynamic Content -->
    @includeIf('components.content.' . $content)
</main>
