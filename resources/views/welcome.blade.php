<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        :host,
        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-feature-settings: normal;
            font-variation-settings: normal;
            -webkit-tap-highlight-color: transparent
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-feature-settings: normal;
            font-variation-settings: normal;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-feature-settings: inherit;
            font-variation-settings: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        dialog {
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .absolute {
            position: absolute
        }

        .relative {
            position: relative
        }

        .-left-20 {
            left: -5rem
        }

        .top-0 {
            top: 0px
        }

        .-bottom-16 {
            bottom: -4rem
        }

        .-left-16 {
            left: -4rem
        }

        .-mx-3 {
            margin-left: -0.75rem;
            margin-right: -0.75rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .aspect-video {
            aspect-ratio: 16 / 9
        }

        .size-12 {
            width: 3rem;
            height: 3rem
        }

        .size-5 {
            width: 1.25rem;
            height: 1.25rem
        }

        .size-6 {
            width: 1.5rem;
            height: 1.5rem
        }

        .h-12 {
            height: 3rem
        }

        .h-40 {
            height: 10rem
        }

        .h-full {
            height: 100%
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-full {
            width: 100%
        }

        .w-\[calc\(100\%\+8rem\)\] {
            width: calc(100% + 8rem)
        }

        .w-auto {
            width: auto
        }

        .max-w-\[300px\] {
            max-width: 300px
        }

        .max-w-2xl {
            max-width: 42rem
        }

        .flex-1 {
            flex: 1 1 0%
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr))
        }

        .flex-col {
            flex-direction: column
        }

        .items-start {
            align-items: flex-start
        }

        .items-center {
            align-items: center
        }

        .items-stretch {
            align-items: stretch
        }

        .justify-end {
            justify-content: flex-end
        }

        .justify-center {
            justify-content: center
        }

        .gap-2 {
            gap: 0.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .gap-6 {
            gap: 1.5rem
        }

        .self-center {
            align-self: center
        }

        .overflow-hidden {
            overflow: hidden
        }

        .rounded-\[10px\] {
            border-radius: 10px
        }

        .rounded-full {
            border-radius: 9999px
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-md {
            border-radius: 0.375rem
        }

        .rounded-sm {
            border-radius: 0.125rem
        }

        .bg-\[\#FF2D20\]\/10 {
            background-color: rgb(255 45 32 / 0.1)
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-gradient-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
        }

        .from-transparent {
            --tw-gradient-from: transparent var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-white {
            --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
        }

        .to-white {
            --tw-gradient-to: #fff var(--tw-gradient-to-position)
        }

        .stroke-\[\#FF2D20\] {
            stroke: #FF2D20
        }

        .object-cover {
            object-fit: cover
        }

        .object-contain {
            object-fit: contain;
        }

        .object-top {
            object-position: top
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem
        }

        .pt-3 {
            padding-top: 0.75rem
        }

        .text-center {
            text-align: center
        }

        .font-sans {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .text-sm\/relaxed {
            font-size: 0.875rem;
            line-height: 1.625
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .font-semibold {
            font-weight: 600
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\] {
            --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
            --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .ring-transparent {
            --tw-ring-color: transparent
        }

        .ring-white\/\[0\.05\] {
            --tw-ring-color: rgb(255 255 255 / 0.05)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .transition {
            transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .duration-300 {
            transition-duration: 300ms
        }

        .selection\:bg-\[\#FF2D20\] *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-\[\#FF2D20\]::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-black:hover {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .hover\:text-black\/70:hover {
            color: rgb(0 0 0 / 0.7)
        }

        .hover\:ring-black\/20:hover {
            --tw-ring-color: rgb(0 0 0 / 0.2)
        }

        .focus\:outline-none:focus {
            outline: 2px solid transparent;
            outline-offset: 2px
        }

        .focus-visible\:ring-1:focus-visible {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
        }

        @media (min-width: 640px) {
            .sm\:size-16 {
                width: 4rem;
                height: 4rem
            }

            .sm\:size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .sm\:pt-5 {
                padding-top: 1.25rem
            }
        }

        @media (min-width: 768px) {
            .md\:row-span-3 {
                grid-row: span 3 / span 3
            }
        }

        @media (min-width: 1024px) {
            .lg\:col-start-2 {
                grid-column-start: 2
            }

            .lg\:h-9 {
                height: 3rem
            }

            .lg\:w-9 {
                width: 3rem
            }

            .lg\:h-16 {
                height: 4rem
            }

            .lg\:max-w-7xl {
                max-width: 80rem
            }

            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .lg\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .lg\:flex-col {
                flex-direction: column
            }

            .lg\:items-end {
                align-items: flex-end
            }

            .lg\:justify-center {
                justify-content: center
            }

            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-10 {
                padding: 2.5rem
            }

            .lg\:pb-10 {
                padding-bottom: 2.5rem
            }

            .lg\:pt-0 {
                padding-top: 0px
            }

            .lg\:text-\[\#FF2D20\] {
                --tw-text-opacity: 1;
                color: rgb(255 45 32 / var(--tw-text-opacity))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:block {
                display: block
            }

            .dark\:hidden {
                display: none
            }

            .dark\:bg-black {
                --tw-bg-opacity: 1;
                background-color: rgb(20 20 20 / var(--tw-bg-opacity))
            }

            .dark\:bg-zinc-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(24 24 27 / var(--tw-bg-opacity))
            }

            .dark\:via-zinc-900 {
                --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .dark\:to-zinc-900 {
                --tw-gradient-to: #18181b var(--tw-gradient-to-position)
            }

            .dark\:text-white\/50 {
                color: rgb(255 255 255 / 0.5)
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:text-white\/70 {
                color: rgb(255 255 255 / 0.7)
            }

            .dark\:ring-zinc-800 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity))
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:hover\:text-white\/70:hover {
                color: rgb(255 255 255 / 0.7)
            }

            .dark\:hover\:text-white\/80:hover {
                color: rgb(255 255 255 / 0.8)
            }

            .dark\:hover\:ring-zinc-700:hover {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity))
            }

            .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
            }

            .dark\:focus-visible\:ring-white:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity))
            }
        }

        .arrow {
            display: inline-block;
            margin-left: 0.5rem;
            transition: transform 0.3s;
        }

        .view-more:hover .arrow {
            transform: translateX(5px);
        }
    </style>
</head>

<body class="font-sans antialiased ">
    <div style="background-color: #111827; color: rgba(255, 255, 255, 0.5);">
        <div class="relative min-h-screen  ">
            <div class="relative w-full max-w-7xl ">
                <div class="flex items-center p-6"
                    style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border-bottom: 1px solid #fff;">

                    <img style="height: 3rem; width: 3rem;" src="{{ asset('img/group21.jpg') }}" alt="Human Shop">



                    <span class="px-6 text-2xl font-bold text-white lg:text-8xl">HumanShop</span>
                    <!-- Right: Login & Register -->
                    @if (Route::has('login'))
                        <nav class="flex flex-1 justify-end gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    style=" border: 1px solid #fff;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-radius: 8px;"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    style=" border: 1px solid #fff;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-radius: 8px;"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        style=" border: 1px solid #fff;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            border-radius: 8px;"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
            <!-- display  news about our shop-->
            <div class="container mx-auto p-6">
                <div class="text-3xl font-bold  text-white mt-2">WELCOME to HumanShop</div>

                <div class="flex flex-wrap  gap-4 mt-6 p-6"
                    style="width: auto; overflow-x: auto; border: 1px solid #9ca3af;">
                    <div class="text-2xl font-bold  text-white ">Our Product</div>
                    <!-- Product 1 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/heart.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Heart</h2>
                            <p class="text-sm">หัวใจมือ 2 สภาพดี,สวย พึ่งได้มาสดๆร้อนๆ</p>
                        </div>
                    </div>
                    <!-- Product 2 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/kidney.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Kidney</h2>
                            <p class="text-sm" style="overflow-y:auto;">ไตสะอาด ปราศจากของเหลวจำพวกปัสสาวะ</p>
                        </div>
                    </div>
                    <!-- Product 3 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff ; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/lung.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Lung</h2>
                            <p class="text-sm" style="overflow-y-auto;">
                                ปอดหมู สีสวย ชมพูอมเขียว
                            </p>
                        </div>
                    </div>
                    <!-- Product 4 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff ; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/liver.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Liver</h2>
                            <p class="text-sm" style="overflow-y-auto;">
                                ตับ ตับ ตับ ตับ ตัวพี่ชอบกินตับเด็ก
                            </p>
                        </div>
                    </div>
                    <!-- Product 5 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff ; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/bladder.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Bladder</h2>
                            <p class="text-sm" style="overflow-y-auto;">
                                กระเพาะปัสสาวะ เหมาะสำหรับคนที่ชอบอั้นฉี่เป็นเวลานานๆ
                            </p>
                        </div>
                    </div>
                    <!-- Product 6 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff ; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/intestine.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Intestine</h2>
                            <p class="text-sm" style=" overflow-y: auto ;">
                                ไส้ย่าง สันป่าข่อย
                            </p>
                        </div>
                    </div>
                    <!-- Product 7 -->
                    <div
                        style="background-color: #1F2937; color: rgba(255, 255, 255, 0.5); border: 1px solid #fff ; border-radius: 3px;">
                        <div style="height: auto; width: 10rem; max-height: 20rem; overflow-y: hidden;"
                            class="flex flex-col items-center p-6 bg-gray-800 rounded shadow">
                            <div class="mb-2">
                                <img style="height: 10rem; width: 10rem;" src="{{ asset('img/bone marrow.jpg') }}"
                                    alt="Product 1" class="h-full w-full object-cover rounded-lg">
                            </div>
                            <h2 class="text-lg font-semibold">Bone marrow</h2>
                            <p class="text-sm" style="overflow-y-auto;">
                                ไขกระดูก สำหรับปรุงอาหาร
                            </p>
                        </div>
                    </div>

                    <!-- View more -->
                    <div class="flex justify-center items-center">
                        <a href="{{ route('humanShop.shoplist') }}" class="mt-2 text-blue-400 hover:underline">View
                            More <span class="arrow">➔</span></a>
                    </div>

                </div>
            </div>


            <!-- other detail for our company -->
            <div class="flex items-center justify-center px-6 py-16"> " . . . Lorem ipsum dolor sit amet consectetur
                adipisicing
                elit.
                Quod
                numquam facilis fugit veritatis tempora
                maxime voluptates dolor, molestias labore vitae incidunt tenetur commodi est impedit eaque magnam sit
                omnis consequuntur
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe perspiciatis laudantium eaque distinctio
                eos voluptate quaerat ullam eveniet cum molestiae ducimus porro, excepturi rem quo a dolores impedit
                quibusdam esse! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima doloremque, ullam
                corrupti fuga accusantium fugiat. Iure eum sed magni? Consectetur libero adipisci cumque. Et in pariatur
                quidem porro natus similique.
                Dicta eum ipsa dolores fuga veniam. Ullam illo, doloremque nisi, architecto ab libero cumque aperiam
                inventore assumenda quam quibusdam nam doloribus ipsam illum rem eveniet praesentium dolore reiciendis.
                Corporis, autem.
                Eligendi debitis doloribus tempore, autem voluptatibus quod in dignissimos ut similique delectus magnam
                pariatur placeat quo quisquam iste eos, architecto excepturi nulla hic corporis doloremque dolorem
                laborum sed. Eos, quibusdam.
                Et aperiam praesentium soluta, quo corrupti incidunt similique laborum explicabo, ea nobis at commodi!
                Suscipit quia pariatur corrupti repellat accusantium dolorum, dolore illum ipsum, facere voluptatem
                sunt, sequi eligendi nostrum?</div>
            <div class="text-2xl font-bold  text-white  p-6 text-center"
                style=" background-color: #FF2D20; width: 30rem; border: 3px solid white;">
                Promotion
                เด็ดสำหรับลูกค้าใหม่ทุกท่าน</div>
            <div class="flex flex-col items-start justify-center px-6 py-10">
                <li>10%</li>
                <li>20%</li>
                <li>30%</li>
                <li>40%</li>
                <li>90%</li>
            </div>

            <footer class=" text-center text-sm text-black dark:text-white/70 items-end  justify-end p-6">
                Human_shop Project Database • 2567 :: group21

            </footer>
        </div>
    </div>
    </div>
</body>