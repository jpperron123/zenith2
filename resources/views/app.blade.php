<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
(function () {
  const root = document.documentElement;

  function setTheme(theme, persist = true, animate = false) {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (animate && !reduce) {
      root.classList.add('theme-anim');
      // on déclenche la transition avant de changer la classe
      requestAnimationFrame(() => {
        root.classList.toggle('dark', theme === 'dark');
        if (persist) localStorage.setItem('theme', theme);
        setTimeout(() => root.classList.remove('theme-anim'), 260);
      });
    } else {
      root.classList.toggle('dark', theme === 'dark');
      if (persist) localStorage.setItem('theme', theme);
    }
  }

  // on expose la fonction pour ton composant Vue
  window.__setTheme = setTheme;

  const appearance = '{{ $appearance ?? "system" }}';
  const saved = localStorage.getItem('theme');

  if (saved) {
    setTheme(saved, false, false); // pas d’anim au premier paint
  } else if (appearance === 'system') {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    setTheme(prefersDark ? 'dark' : 'light', false, false);

    // suivre le changement système si l’utilisateur n’a pas choisi
    const mq = window.matchMedia('(prefers-color-scheme: dark)');
    mq.addEventListener?.('change', (e) => {
      if (!localStorage.getItem('theme')) {
        setTheme(e.matches ? 'dark' : 'light', false, false);
      }
    });
  }
})();
</script>


        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
