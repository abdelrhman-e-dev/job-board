@props(['message'])

<script>
    (function () {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();

            function playNote(freq, startTime, duration, gainVal) {
                const oscillator = ctx.createOscillator();
                const gainNode = ctx.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(ctx.destination);

                oscillator.type = 'sine';
                oscillator.frequency.setValueAtTime(freq, startTime);

                gainNode.gain.setValueAtTime(gainVal, startTime);
                gainNode.gain.exponentialRampToValueAtTime(0.001, startTime + duration);

                oscillator.start(startTime);
                oscillator.stop(startTime + duration);
            }

            const now = ctx.currentTime;
            playNote(660, now,        0.18, 0.25); // E5
            playNote(880, now + 0.18, 0.28, 0.20); // A5
        } catch (e) {
            // Silently fail if Audio API is not available
        }
    })();
</script>

<div id="toast-notification" class="fixed top-8 right-8 z-50 bg-white border border-green-200 p-4 rounded-lg shadow-lg flex items-start gap-4 max-w-sm w-full" dir="ltr">
    {{-- Icon --}}
    <div class="flex-shrink-0 mt-0.5">
        <div class="w-6 h-6 bg-success rounded-full flex items-center justify-center ring-4 ring-green-100">
            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>
    </div>
    {{-- Content --}}
    <div class="flex-1">
        <h3 class="text-sm font-semibold text-green-800">Success!</h3>
        <div class="mt-1 text-sm text-neutral-600">
            <p>{{ $message }}</p>
        </div>
    </div>
    {{-- Close Button --}}
    <div class="flex-shrink-0 ml-2">
        <button type="button" class="text-neutral-400 hover:text-neutral-600 focus:outline-none transition-colors"
            onclick="document.getElementById('toast-notification').remove()">
            <span class="sr-only">Close</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
        </button>
    </div>
</div>
