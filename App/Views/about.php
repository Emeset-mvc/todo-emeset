<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="main.css">

  <title>About</title>
</head>

<body>

  <nav class="bg-red-500 border-gray-200 px-1 sm:px-2 py-1  dark:bg-gray-900">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <a href="/" class="flex items-center">
        <span class="self-center text-lg text-white font-semibold whitespace-nowrap dark:text-white">Todo APP</span>
      </a>
      <div class="md:block md:w-auto" id="navbar-default">
        <?php if($logged){ ?>
        <ul class="flex flex-col p-1 mt-2   md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="/logout" class=" py-2 pr-4 pl-3 text-white md:p-0 dark:text-white" aria-current="page">Tancar sessió (<?= $user["user"]; ?>)</a>
          </li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </nav>

  <div class="container mt-2">
    <div class="grid grid-cols-12 p-2">
      <div class="col-start-5 col-span-4">
        <div class="text-sm font-medium text-gray-900 bg-white  border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          <div class="block py-2 px-4 w-full text-black border-b border-gray-200 cursor-pointer">
            About Page
          </div>
          
        </div>
      </div>
    </div>

    
  

  <script src="/js/bundle.js"></script>
</body>

</html>