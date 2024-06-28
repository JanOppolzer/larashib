<tr x-data class="hover:bg-blue-50 cursor-pointer" role="button"
    @click="items = $el.querySelectorAll('a'); if(items.length) { window.location = items[items.length-1].href }">
    {{ $slot }}
</tr>
