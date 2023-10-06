@if (session()->has('message'))
    <div x-data="{ isVisible: true }" x-init="setTimeout(() => {
        isVisible = false
    }, 4000)" x-show="isVisible">
        <div class="alert-toast fixed bottom-12 right-0 m-8 w-5/6 md:w-full max-w-sm">
            <input type="checkbox" class="hidden" id="footertoast">

            <label
                class="close cursor-pointer flex items-start justify-between w-full p-2 bg-verde-200 h-24 rounded shadow-lg text-verde-900"
                title="close" for="footertoast">
                {{ session()->get('message') }}

                <svg class="fill-current text-verde-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
            </label>
        </div>
    </div>
@elseif (session()->has('error'))
    <div x-data="{ isVisible: true }" x-init="setTimeout(() => {
        isVisible = false
    }, 4000)" x-show="isVisible">
        <div class="alert-toast fixed bottom-12 right-0 m-8 w-5/6 md:w-full max-w-sm">
            <input type="checkbox" class="hidden" id="footertoast">

            <label
                class="close cursor-pointer flex items-start justify-between w-full p-2 bg-red-200 h-24 rounded shadow-lg text-red-800"
                title="close" for="footertoast">
                {{ session()->get('error') }}

                <svg class="fill-current text-red-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
            </label>
        </div>
    </div>
@elseif (session()->has('warning'))
    <div class="container" x-data="{ isVisible: true }" x-init="setTimeout(() => {
        isVisible = false
    }, 4000)" x-show="isVisible">
        <div class="alert-toast fixed bottom-12 right-0 m-8 w-5/6 md:w-full max-w-sm">
            <input type="checkbox" class="hidden" id="footertoast">

            <label
                class="close cursor-pointer flex items-start justify-between w-full p-2 bg-ocre-200 h-24 rounded shadow-lg text-ocre-800"
                title="close" for="footertoast">
                {{ session()->get('warning') }}

                <svg class="fill-current text-ocre-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
            </label>
        </div>
    </div>
@endif
