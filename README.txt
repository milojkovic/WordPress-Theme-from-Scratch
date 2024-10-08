Creating a WordPress Theme from Scratch

- I set up the entire WordPress structure from scratch.
- I created an asset folder where I placed all the necessary styles.
- I added a gulp folder and initiated Sass, then wrote a gulpfile.js to specify which files to watch. I installed npm and gulp, and configured gulp to minify the files.
- I built the basic pages: header, footer, page, front-page, etc. I styled the menu and pages to have a decent appearance.
- I created a custom template for testing purposes and applied some page styling to it.
- I developed a simple blog page, including archive, single-archive, and single pages.
- I implemented a sidebar and search functionality.
- Naturally, I created the functions.php file where I included all the necessary functions.
- I created a custom post type and custom post fields. I initially developed the CPF from scratch, then recreated it using a plugin to demonstrate the differences.
- I developed custom forms from scratch using Ajax, including nonce protection.
- I implemented SMTP functionality instead of the basic PHP mailer to avoid emails going to spam, as WordPress uses a server that is not properly configured.
- I created a small shortcode to pull the latest CPT (Custom Post Types) and demonstrated how it works.
- Finally, I developed a custom search feature for CPT cars.
- Create form and connect to the API. If the correct user and pass are entered, the token will be stored into the cookies
- Created Gutenberg block 'Favorite movie quote' with one text field using WordPress components who is saved in a block attribute. Block is set as a dynamic block (output is handled from callback function / server side).
- The 'Movie Review' plugin was created, a custom post type and taxonomy were added, and a custom post field was added using the ACF plugin.
The single-movie_review page was added to be displayed on the front end. After activating the plugin, a page is automatically created.
- The 'Movies' plugin was created from scratch. It was done this way to demonstrate the difference in code between working with helper
plugins and without them. A custom post type was created that can also be used for REST API. Three custom post fields and three meta boxes for input were created.
Two options for input were made, one through the Gutenberg panel and the other through WordPress components. Everything is displayed on the front end.
---------------------------------------------------------------------

Creating a WordPress theme from scratch can be divided into several key steps. Here’s how the process might look:

1.Creating the Basic Theme Structure:
    - Create a directory for your theme in the wp-content/themes folder.
    - Within that directory, create the basic files such as style.css, index.php, functions.php, and screenshot.png (to display the theme in the WordPress admin panel).

2.Adding Basic Styles and Scripts:
    - In the style.css file, define the basic styles for your theme.
    - In the functions.php file, register and enqueue the necessary styles and scripts using functions like wp_enqueue_style() and wp_enqueue_script().

3.Creating Basic Templates:
    - Create basic page templates such as header.php, footer.php, sidebar.php, page.php, single.php, and archive.php.
    - Use WordPress functions in the templates, such as get_header(), get_footer(), get_sidebar(), and the_content() to generate content.

4. Adding Functionality via functions.php:
    - In the functions.php file, add custom functions, widgets, menus, and other elements needed for your theme.
    - Create custom post types (CPT) and custom fields if your theme requires specific functionalities.

5. Styling and Responsiveness:
    - Style your theme using SCSS or CSS preprocessors like Sass, and then automatically generate styles using tools like Gulp.
    - Ensure that your theme is responsive and adapts to different devices.

6. Testing and Optimization:
    - Test your theme on different devices and browsers to ensure consistent display.
    - Optimize resource loading (minifying CSS and JS, optimizing images, etc.).

7. Creating Additional Functionalities:
    - Add custom shortcodes, AJAX functionalities, custom forms, and other advanced functionalities specific to your theme.

8. Preparing for Distribution:
    - Make sure the theme is ready for distribution, including code review, documentation, and testing on different versions of WordPress.
    - If you plan to distribute the theme, prepare user documentation to help users properly use and customize your theme.

---------------------------------------------------------------------
Git commands:
git init
git add .
git status
git commit -m "Add existing project files to Git"
git branch -M main
git remote add origin https://github.com/yourname/example-website.git
git push -u -f origin main

When change files:
git add .
git commit -m "Your comment"
git push
