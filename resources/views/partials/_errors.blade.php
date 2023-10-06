@if ($errors->count())
    <div x-data="{ isVisible: true }" x-init="setTimeout(() => {
        isVisible = false
    }, 4000)" x-show="isVisible">
        <div class="alert-footer w-full fixed bottom-0">
            <input type="checkbox" class="hidden" id="footeralert">

            <div class="flex flex-col p-6 justify-start w-full h-auto bg-ocre-200 shadow text-ocre-900">
                <div class="inline-flex justify-end">
                     <label class="close cursor-pointer" title="close" for="footeralert">
                    <svg class="fill-current text-ocre-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </label>
                </div>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        </div>
    </div>
@endif
