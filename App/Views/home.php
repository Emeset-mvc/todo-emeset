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

<body>

  <nav class="bg-red-500 border-gray-200 px-1 sm:px-2 py-1  dark:bg-gray-900">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <a href="/" class="flex items-center">
        <span class="self-center text-lg text-white font-semibold whitespace-nowrap dark:text-white">Todo APP</span>
      </a>
      <div class="md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-1 mt-2   md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="/logout" class=" py-2 pr-4 pl-3 text-white md:p-0 dark:text-white" aria-current="page">Tancar sessió (<?= $user["user"]; ?>)</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-2">
    <div class="grid grid-cols-12 p-2">
      <div class="col-start-5 col-span-4">
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
      <div class="col-start-5 col-span-4">
        <div class="text-sm font-medium text-gray-900 bg-white  border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

          <ul id="finished_tasks">


          </ul>



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