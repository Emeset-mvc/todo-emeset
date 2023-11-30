<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="main.css">

  <title>Todo APP</title>
</head>

<body class="overflow-y-scroll">

  <?php include "navbar.php"; ?>

  <div class="container mt-2 mx-auto">
    <div class="grid grid-cols-12 p-2">
      <div class="col-start-3 col-span-6">
        <div class="text-sm font-medium text-gray-900 bg-white  border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          <div class="block py-2 px-4 w-full text-white   border-b border-gray-200 cursor-pointer">
            <label for="task" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Afegir</label>
            <form action="/" method="post" id="task-add">
              <div class="relative">
                <input type="text" id="task" name="task" class="block w-full p-3 pl-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tasca..." required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-2 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir</button>
              </div>
            </form>
          </div>
          <ul id="tasks">

          </ul>

        </div>
      </div>
    </div>

    <div class="grid grid-cols-12 p-2">
      <div class="col-start-3 col-span-6">
        <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
          <h2 id="accordion-flush-heading-3">
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
              <span>Tasques fetes</span>
              <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
              </svg>
            </button>
          </h2>
          <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
              <div class="text-sm font-medium text-gray-900 bg-white  border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <ul id="finished-tasks">
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/js/bundle.js"></script>
  <div class="hidden" id="task-template">
    <li>
      <div class="relative h-16 block py-4 px-4 w-full border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white flex">
        <div class="block pr-5 task-text"></div>
        <a href="" class="task-link absolute right-2.5 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">Feta!</a>
      </div>
    </li>
  </div>
</body>

</html>