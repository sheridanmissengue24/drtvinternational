@props(['category'])
<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"
      style="background: {{ $category->color ?? 'var(--accent)' }}; color:#fff;">
  {{ $category->name }}
</span>
