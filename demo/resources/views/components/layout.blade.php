<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0"
  >
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home Page</title>
</head>
<body>
<nav>
  <x-nav-link href="/">Home</x-nav-link>
  <x-nav-link href="/about" style="color: green">About</x-nav-link>
  <x-nav-link href="/contact">Contact</x-nav-link>
</nav>

{{-- per mostrare ciò che verrà incluso nel tag "x-layout" --}}
{{-- non abbiamo bisogno di scrivere tutta le sintassi perché stiamo usando blade--}}
<!-- <?php echo $slot ?> -->

{{-- la sintassi sotto si traduce come <?php echo [variabile] ?>--}}
{{ $slot }}

</body>
</html>
