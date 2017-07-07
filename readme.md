BLOB FREEZER -  Nick Freese 2017 -
------------------------------------------------------------------------------------------------------------------

what:  Blob Freezer is a nifty piece of web software which aids image performance optimization.  It combines dynamic image optimization, image blobs, sprite sheets and aggressive caching to deliver faster page loads. 

------------------------------------------------------------------------------------------------------------------

How:  Blob Freezer allows you to bundle groups of images which will all be used together. It turns them to plain text, and sends them back in a single request response.  This response is then cached to ensure speedy responses after the first one for any given group.

Blob Freezer also checks for webp support, if it exists, it will convert your images to webp, save them, and cache their plain text response as well.

------------------------------------------------------------------------------------------------------------------

Why: Page speed performance is widely considered to be a very important part of keeping users on your site.  A lot of best practices can be very time consuming and difficult for a small team or website to maintain.  Blob Freezer helps you optimize file format and acts as a spriting sytem for reducing requests.  Blob Freezer combines these concepts in the easiest possible way.

------------------------------------------------------------------------------------------------------------------

When:  The future looks bright for Blob Freezer. here is a quick list of planned additions.

- Dynamic sizing optimization
    - size by request per image.
    - size by max width requested.
    - auto size and format by device width and type.
 
- Support for sub folders
- Resource includes.  including css and content.  options for minification.
- Custom routing configuration for serving web app content.
- JS packaged as module, will be usable as node module as well.

------------------------------------------------------------------------------------------------------------------

Usage:

Backend--------------

In the public folder, add a folder with the images you would like in a request.
Add the folder's name to the 'registry' array in config.php

The request format looks like the following <your domain>/<path/to/blob-freezer>/folder/<foldername>

example: nickfreese.com/blob-freezer-example/folder/images

Frontend--------------

Please refer to the following markup:

```
<img data-freezer-name="photo-1.jpg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />
<img data-freezer-name="photo-2.jpg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />
<script src='https://<your website>.com/<blob-freezer>/scripts/blob-freezer.js'></script>
<script>
freezer.run('https://<your website>.com/<blob-freezer>/folder/images');
</script>

```

Things to note: 
- The src is set to a 1x1 transparent data image to prevent broken image icons
- data-freezer-name should be set to the name of the image including the extension.


Thats it!  Happy Coding!
