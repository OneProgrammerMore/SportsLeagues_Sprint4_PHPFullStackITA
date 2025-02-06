<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link href="{{ URL::asset("css/app.css") }}" rel="stylesheet" />
        <title>CupApp</title>
        @vite("resources/css/app.css")
        @vite("resources/css/legal.css")
        <link rel="stylesheet" href="{{ asset("css/iconStyles.css") }}" />
        <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        <link rel="stylesheet" href="{{ asset("resources/css/legal.css") }}" />
    </head>

    <body>

        <x-web.header />

        <main>
            <div class="to-do main-section">
                This section must be done in the future with information about
                the web.
            </div>

            <div class="notes-todo-web main-section">
                <h3>
                    Some sources to check in order to do the "about us" part of
                    the web:
                </h3>

                <ul class="to-do-list">
                    <li class="to-do-list-item">
                        <h4>About Us Page How To</h4>
                        <a
                            href="https://www.shopify.com/blog/how-to-write-an-about-us-page"
                        >
                            How to Write an About Us page - shopify.com
                        </a>
                    </li>

                    <li class="to-do-list-item">
                        <h4>
                            30 Examples of Stellar About Us Pages for
                            Inspiration
                        </h4>
                        <a href="https://kinsta.com/blog/about-us-page/">
                            30 Examples of Stellar About Us Pages for
                            Inspiration - Kinsta.com
                        </a>
                    </li>
                    <li class="to-do-list-item">
                        <h4>Best "About Us" Pages</h4>
                        <a
                            href="https://www.canva.com/learn/unique-inspiring-about-page/"
                        >
                            50 Best About Us Pages - canva.com
                        </a>
                    </li>
                </ul>
            </div>
        </main>

        <x-footer />
    </body>
</html>
