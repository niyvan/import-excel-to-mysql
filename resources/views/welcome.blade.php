<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

</head>

<body class="w-full mx-auto">

    <div class="flex flex-1 w-full flex-col items-center justify-center text-center px-4 mt-4 sm:mb-0  border-2 m-8">
        <h1 class="mx-auto max-w-4xl font-display text-3xl font-bold tracking-normal text-slate-900 sm:text-6xl mb-5">
            Excel file to mysql
        </h1>


        @if ($message = Session::get('success'))
            <div id="alert-1"
                class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    {{ $message }}
                </div>
            </div>
        @endif
        <form class="flex items-center space-x-6" id="form--import" enctype="multipart/form-data"method="post"
            action="{{ url('import') }}">
            @csrf
            <label class="block flex flex-col">
                <span class="sr-only">Import a file</span>
                <input type="file"
                    class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-lg file:border-0
                file:text-sm file:font-semibold
                file:bg-black-50
                hover:file:bg-violet-100
              "
                    name="import_excel" />
                @if ($errors->has('import_excel'))
                    <div id="alert-1"
                        class="flex p-4 mb-2 mt-2 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-40"
                        role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ml-3 text-sm font-medium">
                            {{ $errors->first('import_excel') }}
                        </div>
                    </div>
                @endif
                <button
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 mt-4"
                    type="submit" name="btn--import" id="btn--import">Import</button>
            </label>
        </form>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>
