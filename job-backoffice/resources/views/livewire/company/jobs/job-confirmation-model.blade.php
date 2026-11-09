<div>
    @if ($showConfirmation)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg" role="dialog" aria-modal="true"
                aria-labelledby="deadline-modal-title">
                <h3 id="deadline-modal-title" class="text-lg font-bold text-red-600">Invalid job deadline</h3>
                <p class="mt-2 text-sm text-gray-600">The deadline check failed. Choose a new date to continue.</p>

                <input type="date" wire:model="newDeadline" class="mt-4 w-full rounded border p-2"
                    aria-label="New job deadline">

                <div class="mt-4 flex justify-end">
                    <button type="button" wire:click="$set('showConfirmation', false)"
                        class="rounded bg-gray-200 px-4 py-2 text-sm text-gray-800">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
