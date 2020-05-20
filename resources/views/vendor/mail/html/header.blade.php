<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                {{-- {{ $slot }} --}}
                <img class="w-75" src="{{ asset('img/MMCYTech.png') }}" alt="logo">
            @endif
        </a>
    </td>
</tr>
