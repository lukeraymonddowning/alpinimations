# Alpinimations

Clean up your Alpine JS animations.

# Table of Contents
- [About Alpinimations](#about-alpinimations)
- [Installation](#installation)
- [Usage](#usage)
- [Available animations](#available-animations)
    * [Tailwind UI](#tailwind-ui)
        * [Dropdowns](#dropdowns)
        * [Menus](#menus)
        * [Modals](#modals)
        * [Notifications](#notifications)
        * [Slideovers](#slideovers)
- [Contributing](#contributing)
- [Code of conduct](#code-of-conduct)
- [License](#license)

## About Alpinimations

Alpinimations helps you clean up your Laravel blade files when using Alpine JS. Alpine has a super powerful animation system, but it can often bloat your HTML. This package bundles common animations into
small blade files that you can include in your HTML.

We currently support all Tailwind UI animations and will be adding animations from more places over time.

## Installation

To install the package, simply run `composer require lukeraymonddowning/alpinimations` in the terminal from the root of your Laravel project. 

If you'd like to edit the animation files, you can publish the views by running `php artisan vendor:publish --provider=Lukeraymonddowning\Alpinimations\AlpinationServiceProvider`.

## Usage

Using Alpinimations couldn't be simpler. Let's take a super awesome Tailwind UI component, the slideover. After copying over the HTML from the Tailwind UI component library, you'll have something like this:

```html
<div class="fixed inset-0 overflow-hidden">
  <div class="absolute inset-0 overflow-hidden">
    <!--
      Background overlay, show/hide based on slide-over state.

      Entering: "ease-in-out duration-500"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in-out duration-500"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
      <!--
        Slide-over panel, show/hide based on slide-over state.

        Entering: "transform transition ease-in-out duration-500 sm:duration-700"
          From: "translate-x-full"
          To: "translate-x-0"
        Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
          From: "translate-x-0"
          To: "translate-x-full"
      -->
      <div class="w-screen max-w-md">
        <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
          <header class="px-4 sm:px-6">
            <div class="flex items-start justify-between space-x-3">
              <h2 class="text-lg leading-7 font-medium text-gray-900">
                Panel title
              </h2>
              <div class="h-7 flex items-center">
                <button aria-label="Close panel" class="text-gray-400 hover:text-gray-500 transition ease-in-out duration-150">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </div>
            </div>
          </header>
          <div class="relative flex-1 px-4 sm:px-6">
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
```

Note that Tailwind UI includes the animations we should apply. These animations are included out of the box with Alpinimations. Let's sweeten up our component with Alpine:

```html
<div x-data="{ showSlideover: false }" class="fixed inset-0 overflow-hidden">
  <div class="absolute inset-0 overflow-hidden">
    <div x-show="showSlideover" @anim('tailwindui.slideover.overlay') class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
      <div x-show="showSlideover" @anim('tailwindui.slideover.overlay') class="w-screen max-w-md">
        <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
          <header class="px-4 sm:px-6">
            <div class="flex items-start justify-between space-x-3">
              <h2 class="text-lg leading-7 font-medium text-gray-900">
                Panel title
              </h2>
              <div class="h-7 flex items-center">
                <button @click="showSlideover = false" aria-label="Close panel" class="text-gray-400 hover:text-gray-500 transition ease-in-out duration-150">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </div>
            </div>
          </header>
          <div class="relative flex-1 px-4 sm:px-6">
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
```
Note how we can use the `@anim` blade directive to include all the necessary alpine animation directives. A list of all Tailwind UI animations available can be found below.

We can go even further here. As most animations are coupled with `x-show`, Alpinimations includes an `@xshow` blade directive. Check it out:

```html
<div x-data="{ showSlideover: false }" class="fixed inset-0 overflow-hidden">
  <div class="absolute inset-0 overflow-hidden">
    <div @xshow('showSlideover', 'tailwindui.slideover.overlay') class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
      <div @xshow('showSlideover', 'tailwindui.slideover.overlay') class="w-screen max-w-md">
        <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
          <header class="px-4 sm:px-6">
            <div class="flex items-start justify-between space-x-3">
              <h2 class="text-lg leading-7 font-medium text-gray-900">
                Panel title
              </h2>
              <div class="h-7 flex items-center">
                <button @click="showSlideover = false" aria-label="Close panel" class="text-gray-400 hover:text-gray-500 transition ease-in-out duration-150">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </div>
            </div>
          </header>
          <div class="relative flex-1 px-4 sm:px-6">
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
```

Suuuuuper clean.

## Available animations
### Tailwind UI

#### Dropdowns
- `tailwindui.dropdown.panel` - Can apply to all dropdown components. [Tailwind UI docs](https://tailwindui.com/components/application-ui/elements/dropdowns)

#### Menus
- `tailwindui.menu.card` - Can apply to mobile menus such as seen in Tailwind UI hero mobile menus. [Tailwind UI docs](https://tailwindui.com/components/marketing/sections/heroes)
- `tailwindui.menu.flyout` - Works with all flyout menus. [Tailwind UI docs](https://tailwindui.com/components/marketing/elements/flyout-menus)
- `tailwindui.menu.off-canvas` - For those swanky mobile sidebar menus. [Tailwind UI docs](https://tailwindui.com/components/application-ui/application-shells/sidebar)
- `tailwindui.menu.overlay` - For any overlay backgrounds needed when menus are displayed, especially in mobile. [Tailwind UI docs](https://tailwindui.com/components/application-ui/application-shells/sidebar#component-ba754bf465a594eb075045eb9e940b60)

#### Modals
- `tailwindui.modal.overlay` - The overlay that shows behind a modal when it is displayed. [Tailwind UI docs](https://tailwindui.com/components/application-ui/overlays/modals)
- `tailwindui.modal.panel` - The actual panel/card that shows the modal content. [Tailwind UI docs](https://tailwindui.com/components/application-ui/overlays/modals)

#### Notifications
- `tailwindui.notification.panel` - The container for the notification. [Tailwind UI docs](https://tailwindui.com/components/application-ui/overlays/notifications)

#### Slideovers
- `tailwindui.slideover.close-button` - The close button for a slideover. This could apply to any close button. [Tailwind UI docs](https://tailwindui.com/components/application-ui/overlays/slide-overs)
- `tailwindui.slideover.overlay` - The background overlay that applies to certain slideovers. [Tailwind UI docs](https://tailwindui.com/components/application-ui/overlays/slide-overs#component-3e8348c3c183bd14fceb018d4cca1942)
- `tailwindui.slideover.panel` - The actual slideover panel/card that will contain your content. [Tailwind UI docs](https://tailwindui.com/components/application-ui/overlays/slide-overs)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
