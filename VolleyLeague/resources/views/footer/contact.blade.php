<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>CupApp</title>
        @vite("resources/css/app.css")
        @vite("resources/css/legal.css")
        <link rel="stylesheet" href="{{ asset("css/iconStyles.css") }}" />
    </head>

    <body>
        <x-web.header />

        <main>
            <div class="to-do main-section">
                This section must be done in the future with contact information
                and contact form to send an email.
            </div>

            <div class="notes-todo-web main-section">
                <h3>
                    Some sources to check in order to do the "contact" part of
                    the web:
                </h3>

                <ul class="to-do-list">
                    <li class="to-do-list-item">
                        <h4>Best Contact Pages Examples</h4>
                        <a
                            href="https://blog.hubspot.com/service/best-contact-us-pages"
                        >
                            45 Best Contact Us Pages You'll Want to Copy [+
                            Templates] - hubspot.com
                        </a>
                    </li>

                    <li class="to-do-list-item">
                        <h4>Contact Page Examples</h4>
                        <a href="https://yoast.com/contact-page-examples/">
                            Contact page examples: What makes a great contact
                            page? - yoast.com
                        </a>
                    </li>
                    <li class="to-do-list-item">
                        <h4>Best Practices for a contact page.</h4>
                        <a
                            href="https://www.helpscout.com/blog/contact-us-page-examples/"
                        >
                            The 18 Best Contact Us Page Examples + Best
                            Practices - helpscout.com
                        </a>
                    </li>
                </ul>
            </div>
        </main>

        <x-footer />
    </body>
</html>
